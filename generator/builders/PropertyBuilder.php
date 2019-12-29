<?php


use PhpParser\BuilderFactory;
use PhpParser\NodeVisitorAbstract;

class PropertyBuilder extends NodeVisitorAbstract
{
    private $options;
    private $propertySchema;

    public function __construct($options,$propertySchema)
    {
        $this->options = $options;
        $this->propertySchema = $propertySchema;
    }

    public function build(TemplateContext $template)
    {
        $commentBuilder = new DocCommentBuilder($this->options);
        if (!isset($this->propertySchema['template'])) {
            $factory = new BuilderFactory;
            $property = $factory->property($this->propertySchema['name'])->makePublic();
            $property->setDocComment($commentBuilder->createPropertyComment($this->propertySchema));
            return $property->getNode();
        } else {
            $propertyNode = $template->buildProperty($this->propertySchema);
            if($this->propertySchema['template'] === 'getObjectProperty' || $this->propertySchema['template'] === 'getValueProperty') {
                $propertyNode->setDocComment($commentBuilder->createPropertyComment($this->propertySchema, array('return')));
            }
            else {
                $propertyNode->setDocComment($commentBuilder->createPropertyComment($this->propertySchema));
            }
            return $propertyNode;
        }
    }

}
