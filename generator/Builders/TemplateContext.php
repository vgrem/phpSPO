<?php

namespace Office365\Generator\Builders;

use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PhpVersion;

class TemplateContext extends NodeVisitorAbstract
{
    private $templatePath;
    private $values;

    public function __construct($templatePath)
    {
        $this->templatePath = $templatePath;
    }

    /**
     * @param array $typeSchema
     * @return Node[]
     */
    public function build($typeSchema)
    {
        $template = $this->loadTemplate();
        $this->values['class'] = $typeSchema['alias'];
        $this->values['namespace'] = $typeSchema['namespace'];
        $traverser = new NodeTraverser();
        $traverser->addVisitor($this);
        return $traverser->traverse($template);
    }


    public function buildProperty($propertySchema){
        $template = $this->loadTemplate($propertySchema['template']);
        $traverser = new NodeTraverser();
        $traverser->addVisitor($this);
        $this->values['function'] = $propertySchema['alias'];
        $this->values['property'] = $propertySchema['name'];
        $this->values['type'] = $propertySchema['typeAlias'];
        $traverser->traverse($template);
        return $template[0];
    }

    private function loadTemplate($name=null){
        $fileName = $this->templatePath;
        $template = $this->parseTemplate($fileName);

        if(!is_null($name)){
            $node = $this->findNodeByName($template,$name);
            return array($node);
        }
        $classNode = $this->findNodeByType($template,Node\Stmt\Class_::class);
        $classNode->stmts = [];
        return $template;
    }


    /**
     * @param array $nodes
     * @param string $type
     * @return Node|null
     */
    private function findNodeByType($nodes, $type){
        $nodeFinder = new NodeFinder;
        return $nodeFinder->findFirst($nodes, function(Node $node) use($type) {
            return $node instanceof $type;
        });
    }

    /**
     * @param array $nodes
     * @param string $name
     * @return Node|null
     */
    private function findNodeByName($nodes, $name){
        $nodeFinder = new NodeFinder;
        return $nodeFinder->findFirst($nodes, function(Node $node) use ($name) {
            return isset($node->name) && $node->name == $name;
        });
    }



    private function parseTemplate($fileName){
        $template = file_get_contents($fileName);
        $parser = (new ParserFactory)->createForVersion(PhpVersion::fromString("7.1"));
        return $parser->parse($template);
    }


    public function enterNode(Node $origNode)
    {
        $node = $origNode;
        if($node instanceof Node\Stmt\Namespace_){
            if($node->name instanceof Node\Name){
                //$node->name->parts = explode("\\",$this->values['namespace']);
                $node->name = new Node\Name($this->values['namespace']);
            }
        }
        elseif ($node instanceof Node\Stmt\Class_) {
            if(isset($this->values['class']))
                $node->name = new Identifier($this->values['class']);
        }
        elseif ($node instanceof Node\Stmt\ClassMethod) {
            $node->name = new Identifier($this->values['function']);
        }
        elseif ($node instanceof Node\Name) {
            /*if($node->parts[0] === "ClientObject" && count($node->parts) > 1) {
                $node->parts[0] = $this->values['property'];
            }*/
            if($node->getParts()[0] === "ClientObject" && isset($this->values['type'])) {
                //$node->parts[0] = $this->values['type'];
                $node->name = $this->values['type'];
            }
        }
        elseif ($node instanceof Node\Scalar\String_){
            $node->value =  str_replace("{name}",$this->values['property'],$node->value);
        }
        return $node;
    }

}
