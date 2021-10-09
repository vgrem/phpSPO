<?php


namespace Office365\Generator\Documentation;


use Office365\Runtime\Http\RequestException;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Http\Requests;

class MSGraphDocsService
{

    /**
     * @var array $toc
     */
    private $toc;

    /**
     * @var string $docsRootUrl
     */
    private $docsRootUrl;


    public function __construct()
    {
        $this->docsRootUrl = "https://raw.githubusercontent.com/microsoftgraph/microsoft-graph-docs/master/api-reference/v1.0/";
        $this->ensureToc();
    }


    /**
     * Load table of contents
     */
    private function ensureToc()
    {
        if (is_null($this->toc)) {
            $options = new RequestOptions($this->docsRootUrl . 'toc.yml');
            $response = Requests::execute($options);
            $this->toc = yaml_parse($response->getContent());
        }
    }

    /**
     * @param array $typeSchema
     * @return array
     * @throws RequestException
     */
    public function resolveAnnotations(&$typeSchema)
    {
        $key = "resources/" . strtolower($typeSchema['alias']) . ".md";
        $this->scanDocInToc(function ($k, $v) use ($key) {
            return $k === 'href' && $v == $key;
        }, $this->toc, $tocEntry);

        if ($tocEntry) {
            $page = $this->parsePage($tocEntry['href']);
            if(isset($page['description']))
                $typeSchema['description'] = $page['description'];
            else
                $typeSchema['description'] = $page['metadata']['description'];
            foreach ($typeSchema['properties'] as &$propSchema){
                $key = $propSchema['name'];
                if(isset($page['Properties'][$key]))
                    $propSchema['description'] = $page['Properties'][$key]['desc'];
                else if(isset($page['Relationships'][$key])) {
                    $propSchema['description'] = $page['Relationships'][$key]['desc'];
                }
            }
        }
        return null;
    }


    /**
     * Parse markdown docs page
     * @param string $href
     * @return array[]
     * @throws RequestException
     */
    private function parsePage($href)
    {
        $blocks = array('Properties', 'Relationships');
        $url = $this->docsRootUrl . $href;
        $options = new RequestOptions($url);
        $response = Requests::execute($options);
        $sections = preg_split('/\n## |\n# /', $response->getContent());

        $page = array(
            'metadata' => array(),
        );
        $lines = preg_split('@\n@', str_replace("---", "", $sections[0]), NULL, PREG_SPLIT_NO_EMPTY);
        foreach ($lines as $line) {
            list($k, $v) = explode(":", $line);
            $page['metadata'][$k] = $v;
        }

        $lines = preg_split('@\n@', $sections[1], NULL, PREG_SPLIT_NO_EMPTY);
        if(count($lines) == 3){
            $page['name'] = $lines[0];
            $page['description'] = $lines[2];
        }

        foreach ($blocks as $blockName){
            $page[$blockName] = array();
            foreach ($sections as $sectionText) {
                if (substr($sectionText, 0, strlen($blockName)) === $blockName) {
                    $lines = preg_split('@\n@', $sectionText, NULL, PREG_SPLIT_NO_EMPTY);
                    foreach ($lines as $index => $line){
                        $values = preg_split('@\|@', $line, NULL, PREG_SPLIT_NO_EMPTY);
                        if(count($values) == 3 &&  $index > 2){
                            $page[$blockName][ucfirst($values[0])] =
                                array('name' => $values[0], 'type' => $values[1], 'desc' => $values[2]);
                        }
                    }
                }
            }
        }
        return $page;
    }


    /**
     * @param callable $callback
     * @param $array
     * @param $foundItem
     */
    private function scanDocInToc(callable $callback, $array, &$foundItem)
    {
        foreach ($array as $key => $value) {
            if (isset($foundItem)) break;
            if (is_array($value)) {
                $this->scanDocInToc($callback, $value, $foundItem);
            } else {
                $found = call_user_func($callback, $key, $value);
                if ($found) {
                    $foundItem = $array;
                }
            }
        }
    }

}