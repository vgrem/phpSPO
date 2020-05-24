<?php

namespace Office365\Generator\Builders;

use PhpParser\Comment\Doc;

class DocCommentBuilder
{

    private $headerText;
    private $headerKey;

    public function __construct($options)
    {
        $this->headerKey = $options['placeholder'];
        $this->headerText = implode(' ', array($options['placeholder'], $options['timestamp'], $options['version']));
    }


    private function sanitizeComment($comment){
        return " * " . str_replace("\n", " \r\n * ",$comment) . "\r\n";
    }

    /**
     * @param string $commentText
     * @return Doc
     */
    public function createClassComment($commentText){
        $commentText = $this->sanitizeComment($commentText);
        return new Doc("/**\r\n $commentText \r\n*/");
    }


    function createHeaderComment(){
        $commentText = $this->sanitizeComment($this->headerText);
        return new Doc("/**\r\n $commentText \r\n*/");
    }

    /**
     * @param $property array
     * @param array $annotations
     * @return Doc
     */
    public function createPropertyComment($property,$annotations=array('var'))
    {
        if (!is_null($property['type'])) {
            $commentText = '';
            if (isset($property['description'])) {
                $commentText .= $this->sanitizeComment($property['description']);

            }
            $commentText .= $this->sanitizeComment("@$annotations[0] " . $this->getTypeAlias($property['type']));
            return new Doc("/**\r\n  $commentText  */");
        }
        return new Doc("");
    }


    private function getTypeAlias($type){
        $parts = explode('\\', $type);
        return array_slice($parts, -1)[0];
    }

}
