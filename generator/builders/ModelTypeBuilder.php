<?php


use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;

class ModelTypeBuilder extends NodeVisitorAbstract {
    private $typeSchema;
    private $statistics;
    private $options;

    public function __construct($typeSchema,$options)
    {
        $this->typeSchema = $typeSchema;
        $this->options = $options;
        $this->statistics = array('created' => 0, 'updated' => 0,'deleted' => 0);
    }


    /**
     * @return bool
     */
    public function updateTypeFile()
    {
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);
        $code = file_get_contents($this->typeSchema['file']);
        $ast = $parser->parse($code);
        $traverser = new NodeTraverser();
        $traverser->addVisitor($this);
        $generatedAst = $traverser->traverse($ast);
        if ($this->getStatistics()['created'] > 0
            || $this->getStatistics()['updated'] > 0
            || $this->getStatistics()['deleted'] > 0) {
            $traverser->removeVisitor($this);
            $traverser->addVisitor(new DocCommentBuilder($this->options));
            $generatedAst = $traverser->traverse($generatedAst);
            $this->printFile($generatedAst, $this->typeSchema['file']);
            return true;
        }
        return false;
    }

    private function getClassName($type){
        $parts = explode('\\', $type);
        return array_slice($parts, -1)[0];
    }

    public function createTypeFile()
    {
        $baseType = $this->typeSchema['baseType'];
        $classShortName = $this->getClassName($this->typeSchema['type']);
        $baseClassShortName = $this->getClassName($baseType);
        $factory = new BuilderFactory;
        $nsName = str_replace("\\" . $classShortName ,"",$this->typeSchema['type']);
        $node = $factory->namespace($nsName)
            ->addStmt($factory->use($baseType))
            ->setDocComment((new DocCommentBuilder($this->options))->createHeaderComment())
            ->addStmt($factory->class($classShortName)
                ->extend($baseClassShortName)
                ->setDocComment(DocCommentBuilder::createClassComment($this->typeSchema))
                ->addStmts(array_map(function ($name, $prop) use ($factory) {
                    return $this->buildProperty($factory,$name,$prop);
                }, array_keys($this->typeSchema['properties']), $this->typeSchema['properties']))
            )->getNode();

        $ast = array($node);
        $this->printFile($ast,$this->typeSchema['file']);
    }


    /**
     * @param BuilderFactory $factory
     * @param $propName string
     * @param $prop array
     * @return Node
     */
    private function buildProperty(BuilderFactory $factory,$propName,$prop){
        if(is_null($prop['baseType'])){
            $propStmt = $factory->property($propName)->makePublic();
            $propStmt->setDocComment(DocCommentBuilder::createPropertyComment($prop));
            return $propStmt->getNode();
        }
        /*$templateBuilder = new TemplateBuilder();
        $propNode = $templateBuilder->create($prop);
        $propNode->setDocComment(DocCommentBuilder::createPropertyComment($prop));
        return $propNode;*/
    }


    public function enterNode(Node $node) {
        $factory = new BuilderFactory;
        if ($node instanceof Node\Stmt\Class_) {
            foreach ($this->typeSchema['properties'] as $prop){
                if($prop['state'] === 'detached'){
                    $prop = $this->buildProperty($factory,$prop['name'],$prop);
                    $node->stmts[] = $prop;
                    $this->statistics['created']++;
                }
            }
        }
        /*elseif ($node instanceof Node\Stmt\Property){
            //todo
        }*/
    }


    /**
     * @param $ast array
     * @param $outputFile string
     */
    private function printFile($ast, $outputFile){
        $prettyPrinter = new PrettyPrinter\Standard();
        $code = $prettyPrinter->prettyPrintFile($ast);
        $outputFolder = dirname($outputFile);
        $this->ensureFolder($outputFolder);
        file_put_contents($outputFile, $code);
    }

    private function  ensureFolder(&$path){
        if (!is_dir($path)) {
            mkdir($path,0777,true);
        }
    }


    public function getStatistics(){
        return $this->statistics;
    }
}
