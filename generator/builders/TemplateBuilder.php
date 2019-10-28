<?php


use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;

class TemplateBuilder extends NodeVisitorAbstract
{

    /**
     * @var array
     */
    private $propertySchema;

    /**
     * @var Node\Stmt[]
     */
    private $templateAst;


    public function __construct($options)
    {
        $this->templateAst = $this->parseTemplate($options['templatePath']);
    }

    /**
     * @param $typeSchema
     * @return array|Node[]
     */
    public function create($typeSchema)
    {
        $this->propertySchema = $typeSchema;
        $traverser = new NodeTraverser();
        $traverser->addVisitor($this);
        $ast = $traverser->traverse($this->templateAst);
        return $ast;
    }


    public function enterNode(Node $node)
    {
        /*if ($node instanceof Node\Stmt\ClassMethod) {
            if((string)$node->name === "getObjectProperty"){
                $node->name = "get" . $this->propertySchema['name'];
            }
        }
        elseif ($node instanceof Node\Name) {
           if($node->parts[0] === "ClientObject") {
               $node->parts[0] = $this->getClassName($this->propertySchema['type']);
           }
        }
        elseif ($node instanceof Node\Scalar\String_){
            $node->value =  str_replace("{name}",$this->propertySchema['name'],$node->value);
        }*/
    }


    private function getClassName($type){
        $parts = explode('\\', $type);
        return array_slice($parts, -1)[0];
    }

    private function parseTemplate($fileName){
        $code = file_get_contents($fileName);
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);
        return $parser->parse($code);
    }
}
