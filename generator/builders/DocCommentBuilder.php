<?php

use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class DocCommentBuilder extends NodeVisitorAbstract
{

    private $headerText;
    private $headerKey;

    public function __construct($options)
    {
        $this->headerKey = $options['placeholder'];
        $this->headerText = implode(' ', array($options['placeholder'], $options['timestamp'], $options['version']));
    }


    static function sanitizeComment($comment){
        $result = " * " . str_replace("\n", " \r\n * ",$comment) . "\r\n";
        return $result;
    }

    /**
     * @param $typeSchema array
     * @return Doc
     */
    static function createClassComment($typeSchema){
        if($typeSchema['comment']){
            $commentText = self::sanitizeComment($typeSchema['comment']);
            return new Doc("/**\r\n $commentText \r\n*/");
        }
        return new Doc("");
    }


    function createHeaderComment(){
        $commentText = self::sanitizeComment($this->headerText);
        return new Doc("/**\r\n $commentText \r\n*/");
    }

    /**
     * @param $property array
     * @return Doc
     */
    static function createPropertyComment($property)
    {
        if (!is_null($property['type'])) {
            $commentText = '';
            if (isset($property['comment'])) {
                $commentText .= self::sanitizeComment($property['comment']);

            }
            $commentText .= self::sanitizeComment("@var " . $property['type']);
            return new Doc("/**\r\n  $commentText  */");
        }
        return new Doc("");
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Namespace_) {
            $comments = $node->getComments();
            $result = array_filter(
                $comments,
                function (Doc $comment) {
                    return strpos($comment->getText(), $this->headerKey) === false;
                }
            );
            $result[] = $this->createHeaderComment();
            $node->setAttribute('comments', $result);
        }
    }
}
