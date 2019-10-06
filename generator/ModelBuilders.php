<?php


use PhpParser\BuilderFactory;
use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;




class ClientValueBuilder extends NodeVisitorAbstract {
    private $properties;
    private $statistics;
    public function __construct($properties)
    {
        $this->properties = $properties;
        $this->statistics = array('new' => 0, 'updated' => 0);

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
                    $this->statistics['new']++;
                }
            }
        }
    }
}


class DocsBuilder extends NodeVisitorAbstract
{
    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Namespace_) {
            $comments = $node->getComments();
            $placeholder = "Updated By PHP Office365 Generator";
            $result = array_filter(
                $comments,
                function (Doc $comment) use ($placeholder) {
                    return strpos($comment->getText(), $placeholder) === false;
                }
            );
            $now = date('c');
            $result[] = new Doc("/**\r\n * $placeholder $now \r\n*/");
            $node->setAttribute('comments', $result);
        }
    }
}

