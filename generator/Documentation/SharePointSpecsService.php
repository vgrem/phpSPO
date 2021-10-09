<?php


namespace Office365\Generator\Documentation;

use DOMDocument;
use DOMNode;
use DOMXPath;
use Office365\Runtime\Http\RequestException;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Http\Requests;

class SharePointSpecsService
{
    /**
     * @var array $toc
     */
    private $toc;

    /**
     * @var string $docsRootUrl
     */
    private $docsRootUrl;

    /**
     * SharePointSpecsService constructor.
     * @param string $docsRootUrl
     * @throws RequestException
     */
    public function __construct($docsRootUrl)
    {
        $this->docsRootUrl = $docsRootUrl;
        $this->ensureToc();
    }


    /**
     * @param array $typeSchema
     * @return bool
     */
    public function resolveAnnotations(array &$typeSchema)
    {
        $typeKey = str_replace("SP", "Microsoft.SharePoint.Client",$typeSchema['name']);

        $this->scanDocInToc(function ($key, $value) use ($typeKey) {
            return $key === 'toc_title' &&  strpos($value, $typeKey) !== false;
        }, $this->toc,$tocEntry);

        if($tocEntry){
            $pageUrl = $this->docsRootUrl . $tocEntry['href'];
            $type['description'] = $this->parseTypePage($pageUrl);

            foreach ($typeSchema['properties'] as &$prop){
                $propName = $prop['name'];
                $propEntry = null;
                $this->scanDocInToc(function ($key, $value) use ($propName) {
                    return $key === 'toc_title' &&  strpos($value, $propName) !== false;
                }, $tocEntry,$propEntry);
                if($propEntry){
                    $pageUrl = $this->docsRootUrl . $propEntry['href'];
                    $prop['description'] = $this->parseTypePage($pageUrl);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Load table of contents
     * @throws RequestException
     */
    private function ensureToc()
    {
        if(is_null($this->toc)){
            $options = new RequestOptions($this->docsRootUrl . 'toc.json');
            $response = Requests::execute($options);
            $this->toc = json_decode($response->getContent(), true);
        }
    }


    /**
     * @param string $pageUrl
     * @return string|null
     */
    private function parseTypePage($pageUrl)
    {
        $doc = new DOMDocument();
        libxml_use_internal_errors(true); //disable HTML error reporting
        $doc->loadHTMLFile($pageUrl);
        return $this->extractComments($doc);
    }


    /**
     * @param DOMDocument $doc
     * @return string|null
     */
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


    /**
     * @param callable $callback
     * @param $array
     * @param $foundItem
     */
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