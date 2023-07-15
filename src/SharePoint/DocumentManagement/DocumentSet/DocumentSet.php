<?php

namespace Office365\SharePoint\DocumentManagement\DocumentSet;

use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\Http\RequestOptions;
use Office365\SharePoint\ClientContext;
use Office365\SharePoint\Entity;
use Office365\SharePoint\Folder;
use Office365\SharePoint\SPList;

class DocumentSet extends Entity
{

    /**
     * Creates a DocumentSet (section 3.1.5.3) object on the server.
     *
     * @param ClientContext $context
     * @param Folder $parentFolder
     * @param string $name
     * @return DocumentSet
     */
    public static function create($context, $parentFolder, $name)
    {
        $returnType = new DocumentSet($context);
        $parentFolder->ensureProperties(array("UniqueId", "Properties", "ServerRelativeUrl"),
            function () use ($parentFolder, $context, $name, $returnType) {
                $customProps = $parentFolder->getProperty("Properties");
                $listId = $customProps['vti_x005f_listname'];
                $targetList = $context->getWeb()->getLists()->getById($listId);
                $folderUrl = $parentFolder->getServerRelativeUrl() . '/' . $name;

                $returnType->setProperty("ServerRelativeUrl", $folderUrl);
                $targetList->ensureProperty("Title",
                    function () use ($targetList, $parentFolder, $folderUrl) {
                        DocumentSet::_create($targetList, $folderUrl);
                    });
            });
        return $returnType;
    }

    /**
     * @param SPList $targetList
     * @param string $folderUrl
     * @param string $ctId
     * @return void
     */
    private static function _create($targetList, $folderUrl, $ctId = "0x0120D520")
    {
        $context = $targetList->getContext();
        $qry = new InvokePostMethodQuery($targetList);
        $context->addQuery($qry);
        $context->getPendingRequest()->beforeExecuteRequestOnce(
            function (RequestOptions $request) use ($context, $targetList, $ctId, $folderUrl) {
                $request->Url = "{$context->getBaseUrl()}/_vti_bin/listdata.svc/{$targetList->getTitle()}";
                $request->Method = HttpMethod::Post;
                $request->ensureHeader("Slug", "{$folderUrl}|{$ctId}");
            });
    }

    function setProperty($name, $value, $persistChanges = true)
    {
        if (is_null($this->resourcePath)) {
            if ($name === "ServerRelativeUrl") {
                $this->resourcePath = $this->getContext()->getWeb()->getFolderByServerRelativeUrl($value)->getResourcePath();
            }
        }
        return parent::setProperty($name, $value, $persistChanges);
    }

}