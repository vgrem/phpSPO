<?php


use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeFinder;
use PhpParser\NodeVisitorAbstract;

class PropertyBuilder extends NodeVisitorAbstract
{
    private $propertySchema;
    private $options;

    public function __construct($options,$propertySchema)
    {
        $this->options = $options;
        $this->propertySchema = $propertySchema;
    }

    public function build($template)
    {
        $commentBuilder = new DocCommentBuilder($this->options);
        if (is_null($this->propertySchema['template'])) {
            $factory = new BuilderFactory;
            $property = $factory->property($this->propertySchema['name'])->makePublic();
            $property->setDocComment($commentBuilder->createPropertyComment($this->propertySchema));
            return array($property->getNode());
        } else {
            $traverser = new NodeTraverser();
            $traverser->addVisitor($this);
            $node = clone $this->findNodeByName($template, $this->propertySchema['template']);
            if($this->propertySchema['template'] === 'getObjectProperty' || $this->propertySchema['template'] === 'getValueProperty') {
                $node->name = "get" . $this->propertySchema['name'];
                $node->setDocComment($commentBuilder->createPropertyComment($this->propertySchema, array('return')));
            }
            else {
                $node->name = "set" . $this->propertySchema['name'];
                $node->setDocComment($commentBuilder->createPropertyComment($this->propertySchema));
            }
            return $traverser->traverse(array($node));
        }
    }



    public function enterNode(Node $origNode)
    {
        $node = clone $origNode;
        if ($node instanceof Node\Name) {
            if($node->parts[0] === "ClientObject") {
                $node->parts[0] = $this->getTypeAlias($this->propertySchema['type']);
            }
        }
        elseif ($node instanceof Node\Scalar\String_){
            $node->value =  str_replace("{name}",$this->propertySchema['name'],$node->value);
        }
        return $node;
    }

    private function findNodeByName($ast, string  $name){
        $nodeFinder = new NodeFinder;
        $node = $nodeFinder->findFirst($ast, function(Node $node) use ($name) {
            return isset($node->name) && $node->name == $name;
        });
        return $node;
    }

    private function getTypeAlias($type){
        $parts = explode('\\', $type);
        return array_slice($parts, -1)[0];
    }
}
