<?php


use PhpParser\BuilderFactory;
use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;


class ClientValueBuilder extends NodeVisitorAbstract {
    private $properties;
    private $statistics;
    private $typeName;
    private $fileName;

    public function __construct($typeName,$type)
    {
        $this->typeName = $typeName;
        $this->fileName = $type['file'];
        $this->properties = $type['properties'];
        $this->statistics = array('created' => 0, 'updated' => 0);
    }


    public function updateTypeFile(){
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);
        $code = file_get_contents($this->fileName);
        $ast = $parser->parse($code);
        $traverser = new NodeTraverser();
        $traverser->addVisitor($this);
        $generatedAst = $traverser->traverse($ast);
        if ($this->getStatistics()['created'] > 0) {
            $traverser->removeVisitor($this);
            $traverser->addVisitor(new DocCommentBuilder());
            $generatedAst = $traverser->traverse($generatedAst);
            $this->printFile($generatedAst,$this->fileName);
            return true;
        }
        return false;
    }

    public function createTypeFile($fileName)
    {
        $parts = explode('.', $this->typeName);
        $className = array_slice($parts, -1)[0];
        $factory = new BuilderFactory;
        $node = $factory->namespace('Office365\PHP\Client\SharePoint')
            ->addStmt($factory->use('Office365\PHP\Client\Runtime\ClientValueObject'))
            ->setDocComment(DocCommentBuilder::createDocComment())
            ->addStmt($factory->class($className)
                ->extend('ClientValueObject')
                ->addStmts(array_map(function ($name, $prop) use ($factory) {
                    $propStmt = $factory->property($name)->makePublic();
                    if (!is_null($prop['type'])) {
                        $type = $prop['type'];
                        $propStmt->setDocComment("/** \r\n * @var $type  \r\n */");
                    }

                    return $propStmt;
                }, array_keys($this->properties), $this->properties))
            )->getNode();

        $ast = array($node);
        $this->printFile($ast, $fileName);
    }


    private function printFile($ast,$path){
        $prettyPrinter = new PrettyPrinter\Standard();
        $code = $prettyPrinter->prettyPrintFile($ast);
        //$testPath = __DIR__ .  "/Test.php";
        //file_put_contents($testPath, $code);
        file_put_contents($path, $code);
    }


    public function getStatistics(){
        return $this->statistics;
    }

    public function enterNode(Node $node) {
        $factory = new BuilderFactory;
        if ($node instanceof Node\Stmt\Class_) {
            foreach ($this->properties as $prop){
                if($prop['state'] === 'detached'){
                    //$prop = $factory->property($prop['name'])->makePublic()->setType($prop['type']);
                    $prop = $factory->property($prop['name'])->makePublic();
                    $node->stmts[] = $prop->getNode();
                    $this->statistics['created']++;
                }
                /*if($prop['state'] === 'attached'){
                    //$this->statistics['updated']++;
                }*/
            }
        }
        /*elseif ($node instanceof Node\Stmt\Property){

        }*/
    }
}


class DocCommentBuilder extends NodeVisitorAbstract
{
    static $DefaultPlaceholder = "Updated By PHP Office365 Generator";

    /**
     * @return Doc
     */
    static function createDocComment(){
        $now = date('c');
        $commentText = self::$DefaultPlaceholder  . " " .  $now;
        return new Doc("/**\r\n * $commentText \r\n*/");
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Namespace_) {
            $comments = $node->getComments();
            $result = array_filter(
                $comments,
                function (Doc $comment) {
                    return strpos($comment->getText(), self::$DefaultPlaceholder) === false;
                }
            );
            $result[] = DocCommentBuilder::createDocComment();
            $node->setAttribute('comments', $result);
        }
    }
}

