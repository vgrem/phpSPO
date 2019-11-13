<?php


use PhpParser\Node;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;


class TypeBuilder extends NodeVisitorAbstract {
    private $typeSchema;
    private $changes;
    private $options;
    private $ast;

    public function __construct($options,$typeSchema)
    {
        $this->options = $options;
        $this->changes = array('created' => 0);
        $this->typeSchema = $typeSchema;
    }


    public function save($outputFile){
        $prettyPrinter = new PrettyPrinter\Standard();
        $code = $prettyPrinter->prettyPrintFile($this->ast);
        file_put_contents($outputFile, $code);
    }

    public function build()
    {
        $template = $this->loadTemplate();
        if ($this->typeSchema['state'] === "attached") {
            $code = file_get_contents($this->typeSchema['file']);
            $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);
            $this->ast = $parser->parse($code);
            $classNode = $this->findNodeByType($this->ast,Node\Stmt\Class_::class);
            foreach ($this->typeSchema['properties'] as $property){
                if($property['state'] === "detached"){
                    $node = $this->buildProperty($template,$property);
                    $classNode->stmts = array_merge($classNode->stmts,$node);
                    $this->changes['created']++;
                }
            }
        }
        else {
            $this->ast = $this->buildFromTemplate($template);
        }
        $traverser = new NodeTraverser();
        $traverser->addVisitor($this);
        $traverser->traverse($this->ast);
        return $this->changes['created'] > 0;
    }



    public function beforeTraverse(array $nodes)
    {
        return parent::beforeTraverse($nodes);
    }

    public function enterNode(Node $node) {
        if($node instanceof Node\Stmt\Namespace_){
            $node->setDocComment((new DocCommentBuilder($this->options))->createHeaderComment());
        }
        elseif ($node instanceof Node\Stmt\Class_) {
            $node->setDocComment((new DocCommentBuilder($this->options))->createClassComment($this->typeSchema));
        }
    }

    /**
     * @param $template
     * @param $propertySchema
     * @return Node[]
     */
    private function buildProperty($template, $propertySchema){
        $propertyBuilder = new PropertyBuilder($this->options,$propertySchema);
        return  $propertyBuilder->build($template);
    }


    private function buildFromTemplate($template)
    {
        $propertyNodes = array();
        foreach ($this->typeSchema['properties'] as $propertySchema) {
            $node = $this->buildProperty($template,$propertySchema);
            $propertyNodes = array_merge($propertyNodes, $node);
            $this->changes['created']++;
        }
        $classNode = $this->findNodeByType($template, Node\Stmt\Class_::class);
        $classNode->name = $this->typeSchema['name'];
        $classNode->stmts = $propertyNodes;
    }

    private function loadTemplate(){
        $fileName =  $this->getTypeAlias($this->typeSchema['baseType']) . 'Template.php';
        $fileName = $this->options['templatePath'] . $fileName;
        $template = file_get_contents($fileName);
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);
        return $parser->parse($template);
    }


    /**
     * @param $ast
     * @param $type
     * @return Node|null
     */
    private function findNodeByType($ast, $type){
        $nodeFinder = new NodeFinder;
        $node = $nodeFinder->findFirst($ast, function(Node $node) use($type) {
            return $node instanceof $type;
        });
        return $node;
    }

    private function getTypeAlias($type){
        $parts = explode('\\', $type);
        return array_slice($parts, -1)[0];
    }
}
