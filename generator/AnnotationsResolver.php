<?php

namespace Office365\Generator;

use DOMDocument;
use DOMNode;
use DOMXPath;
use Office365\Runtime\Http\RequestException;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Http\Requests;

/**
 * Documentation annotation service
 */
class AnnotationsResolver
{
    private $toc;
    private $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Load Docs repository
     * @throws RequestException
     */
    private function ensureDocSet()
    {
        if(is_null($this->toc)){
            $options = new RequestOptions($this->options['docsRoot'] . 'toc.json');
            $response = Requests::execute($options);
            $this->toc = json_decode($response->getContent(), true);
        }
    }


    /**
     * @param $typeSchema array
     * @return bool
     * @throws RequestException
     */
    public function resolveTypeComment(&$typeSchema)
    {
        if(!$this->options['includeDocAnnotations'])
            return false;

        $this->ensureDocSet();
        $typeKey = str_replace("SP", "Microsoft.SharePoint.Client",$typeSchema['name']);
        $typeSchema['comment'] = null;
        $this->scanDocInToc(function ($key, $value) use ($typeKey) {
            return $key === 'toc_title' &&  strpos($value, $typeKey) !== false;
        }, $this->toc,$tocEntry);

        if($tocEntry){
            $pageUrl = $this->options['docsRoot'] . $tocEntry['href'];
            $typeSchema['comment'] = $this->loadDocComments($pageUrl);

            foreach ($typeSchema['properties'] as &$prop){
                $propName = $prop['name'];
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
        return true;
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
