<?php


use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;


class TypeBuilder extends NodeVisitorAbstract {

    private $typeSchema;
    private $options;
    private $typeNode;
    private $propertyNodes;

    public function __construct($options,$typeSchema)
    {
        $this->options = $options;
        $this->typeSchema = $typeSchema;
    }


    public function save($outputFile){
        $prettyPrinter = new PrettyPrinter\Standard();
        $code = $prettyPrinter->prettyPrintFile($this->typeNode);
        file_put_contents($outputFile, $code);
    }

    public function build(TemplateContext $template)
    {
        $saveChanges = $this->typeSchema['state'] === "detached" ||
            sizeof(array_filter($this->typeSchema['properties'], function($propertySchema)  {
            return $propertySchema['state'] === "detached";
        }));


        if ($saveChanges){
            $annotations = new AnnotationsResolver($this->options);
            $annotations->resolveTypeComment($this->typeSchema);
        }

        if ($this->typeSchema['state'] === "attached") {
            $code = file_get_contents($this->typeSchema['file']);
            $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);
            $this->typeNode = $parser->parse($code);
        }
        else {
            $this->typeNode = $template->build($this->typeSchema);
        }

        $this->propertyNodes = array();
        foreach($this->typeSchema['properties'] as $propertySchema){  //build missing properties
            if ($propertySchema['state'] === "detached"){
                $propertyBuilder = new PropertyBuilder($this->options,$propertySchema);
                $this->propertyNodes[] = $propertyBuilder->build($template);
            }
        }

        $traverser = new NodeTraverser();
        $traverser->addVisitor($this);
        $traverser->traverse($this->typeNode);
        return $saveChanges;
    }


    public function enterNode(Node $node) {
        if($node instanceof Node\Stmt\Namespace_){
            $node->setDocComment((new DocCommentBuilder($this->options))->createHeaderComment());
        }
        elseif ($node instanceof Node\Stmt\Class_) {
            if(isset($this->typeSchema['comment']))
                $node->setDocComment((new DocCommentBuilder($this->options))->createClassComment($this->typeSchema['comment']));
            foreach($this->propertyNodes as $property){  //insert missing properties
                $node->stmts[] = $property;
            }
        }
    }

}
