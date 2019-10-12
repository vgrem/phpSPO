<?php


use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\Runtime\Utilities\Requests;

class AnnotationsResolver
{
    private $toc;
    private $options;

    public function __construct($options)
    {
        $this->options = $options;
        $this->loadDocSet();
    }

    /**
     * Load Docs repository
     * @throws Exception
     */
    public function loadDocSet()
    {
        $options = new RequestOptions($this->options['docsRoot'] . 'toc.json');
        $content = Requests::execute($options, $responseInfo);
        $this->toc = json_decode($content, true);
    }


    /**
     * @param $typeName string
     * @param $typeSchema array
     */
    public function resolveTypeComment($typeName,&$typeSchema)
    {
        $typeKey = str_replace("SP", "Microsoft.SharePoint.Client",$typeName);
        $typeSchema['comment'] = null;
        $this->scanDocInToc(function ($key, $value) use ($typeKey) {
            return $key === 'toc_title' &&  strpos($value, $typeKey) !== false;
        }, $this->toc,$tocEntry);

        if($tocEntry){
            $pageUrl = $this->options['docsRoot'] . $tocEntry['href'];
            $typeSchema['comment'] = $this->loadDocComments($pageUrl);

            foreach ($typeSchema['properties'] as $propName => &$prop){
                $propEntry = null;
                $this->scanDocInToc(function ($key, $value) use ($propName) {
                    return $key === 'toc_title' &&  strpos($value, $propName) !== false;
                }, $tocEntry,$propEntry);
                if($propEntry){
                    $pageUrl = $this->options['docsRoot'] . $propEntry['href'];
                    $prop['comment'] = $this->loadDocComments($pageUrl);
                }
            }

        }
    }

    private function loadDocComments($pageUrl)
    {
        $doc = new DOMDocument();
        libxml_use_internal_errors(true); //disable HTML error reporting
        $doc->loadHTMLFile($pageUrl);
        return $this->extractComments($doc);
    }


    private function extractComments(DOMDocument $doc)
    {
        $xpath = new DOMXpath($doc);
        $contentNodes = $xpath->query("//*[preceding::comment()[. = ' <content> ']][following::comment()[. = ' </content> ']]/text()[normalize-space()]");

        if (count($contentNodes) <= 4) {
            return null;
        }
        $token = $contentNodes[0]->nodeValue;
        if(strpos($token, "TypeId:") === false && strpos($token, "Type:") === false)
            return null;

        $result = '';
        /**
         * @var  $node DOMNode
         */
        foreach ($contentNodes as $i => $node) {
            if ($i < 4) {
                continue;
            }
            $result .= $node->nodeValue;
        }
        return $result;
    }


    private function scanDocInToc(callable $callback, $array, &$foundItem)
    {
        foreach ($array as $key => $value) {
            if(isset($foundItem)) break;
            if (is_array($value)) {
                $this->scanDocInToc($callback, $value,$foundItem);
            }
            else{
                $found = call_user_func($callback,$key, $value);
                if ($found) {
                    $foundItem = $array;
                }
            }
        }
    }

}
