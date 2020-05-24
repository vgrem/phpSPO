<?php

namespace Office365\Generator;



use Office365\Generator\Documentation\MSGraphDocsService;
use Office365\Generator\Documentation\SharePointSpecsService;

/**
 * Documentation annotation service
 */
class AnnotationsResolver
{
    private $options;
    private $docsService;

    public function __construct($options)
    {
        $this->options = $options;
        if($options['model'] == "SharePoint")
            $this->docsService = new SharePointSpecsService($this->options['docsRoot']);
        else if($options['model'] == "MicrosoftGraph")
            $this->docsService = new MSGraphDocsService();
    }

    /**
     * @param $typeSchema array
     * @return bool
     */
    public function resolveTypeComment(&$typeSchema)
    {
        if(!$this->options['includeDocAnnotations'])
            return false;

        if(!is_null($this->docsService))
            $this->docsService->resolveType($typeSchema);
        return true;
    }
}
