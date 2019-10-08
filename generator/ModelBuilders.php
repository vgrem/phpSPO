<?php


use PhpParser\BuilderFactory;
use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;


class ClientValueBuilder extends NodeVisitorAbstract {
    private $typeSchema;
    private $statistics;
    private $options;

    public function __construct($typeSchema,$options)
    {
        $this->typeSchema = $typeSchema;
        $this->options = $options;
        $this->statistics = array('created' => 0, 'updated' => 0);
    }


    /**
     * @return bool
     */
    public function updateTypeFile(){
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);
        $code = file_get_contents($this->typeSchema['file']);
        $ast = $parser->parse($code);
        $traverser = new NodeTraverser();
        $traverser->addVisitor($this);
        $generatedAst = $traverser->traverse($ast);
        if ($this->getStatistics()['created'] > 0) {
            $traverser->removeVisitor($this);
            $traverser->addVisitor(new DocCommentBuilder($this->options));
            $generatedAst = $traverser->traverse($generatedAst);
            $this->printFile($generatedAst,$this->typeSchema['file']);
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function createTypeFile()
    {
        $parts = explode('\\', $this->typeSchema['type']);
        $classShortName = array_slice($parts, -1)[0];
        $factory = new BuilderFactory;
        $node = $factory->namespace('Office365\PHP\Client\SharePoint')
            ->addStmt($factory->use('Office365\PHP\Client\Runtime\ClientValueObject'))
            ->setDocComment((new DocCommentBuilder($this->options))->createHeader())
            ->addStmt($factory->class($classShortName)
                ->extend('ClientValueObject')
                ->addStmts(array_map(function ($name, $prop) use ($factory) {
                    $propStmt = $factory->property($name)->makePublic();
                    if (!is_null($prop['type'])) {
                        $type = $prop['type'];
                        $propStmt->setDocComment((new DocCommentBuilder($this->options))->createPropertyTypeHint($type));
                    }
                    return $propStmt;
                }, array_keys($this->typeSchema['properties']), $this->typeSchema['properties']))
            )->getNode();

        $ast = array($node);
        return $this->printFile($ast,$this->typeSchema['file']);
    }


    /**
     * @param $ast array
     * @param $outputFile string
     */
    private function printFile($ast, $outputFile){
        $prettyPrinter = new PrettyPrinter\Standard();
        $code = $prettyPrinter->prettyPrintFile($ast);
        file_put_contents($outputFile, $code);
    }


    public function getStatistics(){
        return $this->statistics;
    }

    public function enterNode(Node $node) {
        $factory = new BuilderFactory;
        if ($node instanceof Node\Stmt\Class_) {
            foreach ($this->typeSchema as $prop){
                if($prop['state'] === 'detached'){
                    //$prop = $factory->property($prop['name'])->makePublic()->setType($prop['type']);
                    $prop = $factory->property($prop['name'])->makePublic();
                    $node->stmts[] = $prop->getNode();
                    $this->statistics['created']++;
                }
            }
        }
        elseif ($node instanceof Node\Stmt\Property){
           //todo
        }
    }
}


class DocCommentBuilder extends NodeVisitorAbstract
{
    private $options;


    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * @return Doc
     */
    function createHeader(){
        $commentText = $this->options['placeholder'] . ' ' .$this->options['timestamp'] . ' ' . $this->options['version'];
        return new Doc("/**\r\n * $commentText \r\n*/");
    }

    /**
     * @param $type string
     * @return Doc
     */
    function createPropertyTypeHint($type){
        return new Doc("/** \r\n * @var $type  \r\n */");
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Namespace_) {
            $comments = $node->getComments();
            $result = array_filter(
                $comments,
                function (Doc $comment) {
                    return strpos($comment->getText(), $this->options['placeholder']) === false;
                }
            );
            $result[] = DocCommentBuilder::createHeader();
            $node->setAttribute('comments', $result);
        }
    }
}

