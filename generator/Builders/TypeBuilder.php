<?php

namespace Office365\Generator\Builders;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;


class TypeBuilder extends NodeVisitorAbstract {

    /**
     * @var array
     */
    private $typeSchema;
    /**
     * @var array
     */
    private $options;

    /**
     * @var array
     */
    private $typeNode;
    /**
     * @var TemplateContext
     */
    private $template;


    /**
     * @param array $options
     * @param array $typeSchema
     */
    public function __construct(array $options, array $typeSchema)
    {
        $this->options = $options;
        $this->typeSchema = $typeSchema;
    }


    /**
     * Save generated model into a file
     * @param string $outputFile
     */
    public function save(string $outputFile){
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
            $this->ensureTypeAnnotations($this->typeSchema);
        }

        if ($this->typeSchema['state'] === "attached") {
            $code = file_get_contents($this->typeSchema['file']);
            $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);
            $this->typeNode = $parser->parse($code);
        }
        else {
            $this->typeNode = $template->build($this->typeSchema);
        }

        $this->template = $template;
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
            if(isset($this->typeSchema['description']))
                $node->setDocComment((new DocCommentBuilder($this->options))->createClassComment($this->typeSchema['description']));


            //build properties
            $propertyBuilder = new PropertyBuilder($this->options);
            foreach($this->typeSchema['properties'] as $propertySchema){  //build missing properties
                if ($propertySchema['state'] === "detached"){
                    $node->stmts[] = $propertyBuilder->build($this->template,$propertySchema);
                }
            }

            //build function nodes
            $funcBuilder = new FunctionBuilder();
            if(isset($this->typeSchema['functions'])){
                foreach($this->typeSchema['functions'] as $funcSchema){
                    if ($funcSchema['state'] === "detached"){
                        //$node->stmts[] = $funcBuilder->build($template);
                    }
                }
            }
        }
    }


    /**
     * @param $typeSchema array
     * @return bool
     */
    public function ensureTypeAnnotations(&$typeSchema)
    {
        if(!$this->options['includeDocAnnotations'])
            return false;
        if(!is_null($this->options['docs'])) {
            return $this->options['docs']->resolveAnnotations($typeSchema);
        }
        return true;
    }

}
