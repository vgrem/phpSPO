<?php
namespace Office365\Generator\Builders;

use PhpParser\BuilderFactory;
use PhpParser\Node\Stmt\Property;
use PhpParser\NodeVisitorAbstract;

class PropertyBuilder extends NodeVisitorAbstract
{
    private $options;

    public function __construct($options)
    {
        $this->options = $options;
    }


    /**
     * @param TemplateContext $template
     * @param array $propertySchema
     * @return Property
     */
    public function build(TemplateContext $template,$propertySchema)
    {
        $commentBuilder = new DocCommentBuilder($this->options);
        if (!isset($propertySchema['template'])) {
            $factory = new BuilderFactory;
            $property = $factory->property($propertySchema['name'])->makePublic();
            $property->setDocComment($commentBuilder->createPropertyComment($propertySchema));
            return $property->getNode();
        } else {
            $propertyNode = $template->buildProperty($propertySchema);
            if($propertySchema['template'] === 'getObjectProperty' || $propertySchema['template'] === 'getValueProperty') {
                $propertyNode->setDocComment($commentBuilder->createPropertyComment($propertySchema, array('return')));
            }
            else {
                $propertyNode->setDocComment($commentBuilder->createPropertyComment($propertySchema));
            }
            return $propertyNode;
        }
    }

}
