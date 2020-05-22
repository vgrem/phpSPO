<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T16:30:08+00:00 16.0.19506.12022
 */
namespace Office365\SharePoint;


use Exception;
use Office365\Runtime\ClientResult;
use Office365\Runtime\DeleteEntityQuery;
use Office365\Runtime\Http\RequestException;
use Office365\Runtime\InvokeMethodQuery;
use Office365\Runtime\InvokePostMethodQuery;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\ResourcePathServiceOperation;
use Office365\Runtime\Types\Guid;
use Office365\Runtime\Http\RequestOptions;
use Office365\SharePoint\WebParts\LimitedWebPartManager;


/**
 * Represents 
 * a file in a site (2) that can be 
 * a Web 
 * Part Page, an item in a document library, or 
 * a file in a folder.The ListId, PageRenderType, ServerRelativePath, SiteId and 
 * WebId properties are not included in the default scalar property set 
 * for this type.
 */
class File extends SecurableObject
{

    /**
     * Downloads file content
     * @return ClientResult
     */
    public function download()
    {
        $result = new ClientResult();
        if ($this->isPropertyAvailable("ServerRelativeUrl")) {
            $this->constructDownloadQuery($this->getServerRelativeUrl(), $result);
        } else {
            $this->getContext()->load($this, array("ServerRelativeUrl"));
            $this->getContext()->getPendingRequest()->afterExecuteQuery(function () use ($result) {
                $this->constructDownloadQuery($this->getServerRelativeUrl(), $result);
            });
        }
        return $result;
    }

    /**
     * @param string $url
     * @param ClientResult $result
     */
    private function constructDownloadQuery($url,$result){
        $url = rawurlencode($url);
        $qry = new InvokeMethodQuery($this->getParentWeb(), "getFileByServerRelativeUrl('{$url}')/\$value");
        $this->getContext()->addQueryAndResultObject($qry,$result);
    }

    /**
     * Deletes the File object.
     */
    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
        $this->removeFromParentCollection();
    }
    /**
     * Checks out the file from a document library based on the check-out type.
     */
    public function checkOut()
    {
        $qry = new InvokePostMethodQuery($this, "checkout");
        $this->getContext()->addQuery($qry);
    }
    /**
     * Reverts an existing checkout for the file.
     */
    public function undoCheckout()
    {
        $qry = new InvokePostMethodQuery($this, "undocheckout");
        $this->getContext()->addQuery($qry);
    }
    /**
     * Checks the file in to a document library based on the check-in type.
     * @param string $comment A comment for the check-in. Its length must be <= 1023.
     */
    public function checkIn($comment)
    {
        $qry = new InvokePostMethodQuery($this, "checkIn", array("comment" => $comment, "checkintype" => 0));
        $this->getContext()->addQuery($qry);
    }
    /**
     * Approves the file submitted for content approval with the specified comment.
     * @param string $comment The comment for the approval.
     */
    public function approve($comment)
    {
        $qry = new InvokePostMethodQuery($this, "approve", array("comment" => $comment));
        $this->getContext()->addQuery($qry);
    }
    /**
     * Denies approval for a file that was submitted for content approval.
     * @param string $comment The comment for the denial.
     */
    public function deny($comment)
    {
        $qry = new InvokePostMethodQuery($this, "deny", array("comment" => $comment));
        $this->getContext()->addQuery($qry);
    }
    /**
     * Submits the file for content approval with the specified comment.
     * @param string $comment The comment for the published file. Its length must be <= 1023.
     */
    public function publish($comment)
    {
        $qry = new InvokePostMethodQuery($this, "publish", array("comment" => $comment));
        $this->getContext()->addQuery($qry);
    }
    /**
     * Removes the file from content approval or unpublish a major version.
     * @param string $comment The comment for the unpublish operation. Its length must be <= 1023.
     */
    public function unpublish($comment)
    {
        $qry = new InvokePostMethodQuery($this, "unpublish", array("comment" => $comment));
        $this->getContext()->addQuery($qry);
    }
    /**
     * Copies the file to the destination URL.
     * @param string $strNewUrl The absolute URL or server relative URL of the destination file path to copy to.
     * @param bool $bOverWrite true to overwrite a file with the same name in the same location; otherwise false.
     */
    public function copyTo($strNewUrl, $bOverWrite)
    {
        $qry = new InvokePostMethodQuery($this, "copyto", array("strnewurl" => rawurlencode($strNewUrl), "boverwrite" => $bOverWrite));
        $this->getContext()->addQuery($qry);
    }
    /**
     * Moves the file to the specified destination URL.
     * @param string $newUrl The absolute URL or server relative URL of the destination file path to move to.
     * @param int $flags The bitwise SP.MoveOperations value for how to move the file. Overwrite = 1; AllowBrokenThickets (move even if supporting files are separated from the file) = 8.
     */
    public function moveTo($newUrl, $flags)
    {
        $qry = new InvokePostMethodQuery($this, "moveto", array("newurl" => rawurlencode($newUrl), "flags" => $flags));
        $this->getContext()->addQuery($qry);
    }
    /**
     * Moves the file to the Recycle Bin and returns the identifier of the new Recycle Bin item.
     */
    public function recycle()
    {
        $qry = new InvokePostMethodQuery($this, "recycle");
        $this->getContext()->addQuery($qry);
    }
    /**
     * Opens the file
     * @param ClientRuntimeContext $ctx
     * @param $serverRelativeUrl
     * @return mixed|string
     * @throws Exception
     */
    public static function openBinary(ClientRuntimeContext $ctx, $serverRelativeUrl, $outFile = NULL)
    {
        $serverRelativeUrl = rawurlencode($serverRelativeUrl);
        $url = $ctx->getServiceRootUrl() . "web/getfilebyserverrelativeurl('{$serverRelativeUrl}')/\$value";
        $options = new RequestOptions($url);
        $options->TransferEncodingChunkedAllowed = true;
        $options->OutputFile = $outFile;
        $response = $ctx->executeQueryDirect($options);
        if (400 <= ($statusCode = $response->getStatusCode())) {
            throw new RequestException(sprintf('Could not open file located at "%s". SharePoint has responded with status code %d, error was: %s', rawurldecode($serverRelativeUrl), $statusCode, $response->getContent()), $statusCode, $response->getContent());
        }
        return $response->getContent();
    }
    /**
     * Saves the file
     * Note: it is supported to update the existing file only. For adding a new file see FileCollection.add method
     * @param ClientRuntimeContext $ctx
     * @param string $serverRelativeUrl
     * @param string $content file content
     * @throws Exception
     */
    public static function saveBinary(ClientRuntimeContext $ctx, $serverRelativeUrl, $content)
    {
        $serverRelativeUrl = rawurlencode($serverRelativeUrl);
        $url = $ctx->getServiceRootUrl() . "web/getfilebyserverrelativeurl('{$serverRelativeUrl}')/\$value";
        $request = new RequestOptions($url);
        $request->Method = HttpMethod::Post;
        $request->addCustomHeader('X-HTTP-Method', 'PUT');
        $request->Data = $content;
        if ($ctx instanceof ClientContext) {
            $ctx->ensureFormDigest($request);
        }
        $request->TransferEncodingChunkedAllowed = true;
        $ctx->executeQueryDirect($request);
    }
    /**
     * Specifies the control set used to access, modify, or add Web Parts associated with this Web Part Page and view.
     * An exception is thrown if the file is not an ASPX page.
     * @param int $scope
     * @return LimitedWebPartManager
     */
    public function getLimitedWebPartManager($scope)
    {
        return new LimitedWebPartManager($this->getContext(),
            new ResourcePathServiceOperation("getLimitedWebPartManager",array($scope), $this->getResourcePath()));
    }
    /**
     * Returns IRM settings for given file.
     *
     * @return InformationRightsManagementSettings
     */
    public function getInformationRightsManagementSettings()
    {
        if (!$this->isPropertyAvailable('InformationRightsManagementSettings')) {
            $this->setProperty("InformationRightsManagementSettings", new InformationRightsManagementSettings());
        }
        return $this->getProperty("InformationRightsManagementSettings");
    }
    /**
     * Gets a value that returns a collection of file version objects that represent the versions of the file.
     * @return FileVersionCollection
     */
    public function getVersions()
    {
        if (!$this->isPropertyAvailable('Versions')) {
            $this->setProperty("Versions", new FileVersionCollection($this->getContext(),
                new ResourcePath("Versions", $this->getResourcePath())));
        }
        return $this->getProperty("Versions");
    }
    /**
     * Gets a value that indicates how the file is checked out of a document library
     * @return int|null
     */
    public function getCheckOutType()
    {
        if ($this->isPropertyAvailable('CheckOutType')) {
            return $this->getProperty("CheckOutType");
        }
        return null;
    }
    /**
     * Specifies the list item field (2) values for the list item corresponding to the file.
     * @return ListItem
     */
    public function getListItemAllFields()
    {
        if (!$this->isPropertyAvailable("ListItemAllFields")) {
            $this->setProperty("ListItemAllFields", new ListItem($this->getContext(),
                new ResourcePath("ListItemAllFields", $this->getResourcePath())));
        }
        return $this->getProperty("ListItemAllFields");
    }
    /**
     * Starts a new chunk upload session and uploads the first fragment
     * @param Guid $uploadId The unique identifier of the upload session.
     * @param string $content
     * @return ClientResult The size of the uploaded data in bytes.
     */
    public function startUpload($uploadId, $content)
    {
        $qry = new InvokePostMethodQuery($this, "StartUpload", array('uploadId' => $uploadId->toString()),null, $content);
        $returnValue = new ClientResult();
        $this->getContext()->addQueryAndResultObject($qry, $returnValue);
        return $returnValue;
    }
    /**
     * Continues the chunk upload session with an additional fragment
     * @param Guid $uploadId The unique identifier of the upload session.
     * @param int $fileOffset
     * @param string $content
     * @return ClientResult
     */
    public function continueUpload($uploadId, $fileOffset, $content)
    {
        $returnValue = new ClientResult();
        $qry = new InvokePostMethodQuery($this, "ContinueUpload", array('uploadId' => $uploadId->toString(), 'fileOffset' => $fileOffset),null, $content);
        $this->getContext()->addQueryAndResultObject($qry, $returnValue);
        return $returnValue;
    }
    /**
     * Uploads the last file fragment and commits the file.
     * The current file content is changed when this method completes.
     * @param Guid $uploadId
     * @param int $fileOffset
     * @param string $content
     * @return File
     */
    public function finishUpload($uploadId, $fileOffset, $content)
    {
        $qry = new InvokePostMethodQuery($this, "finishupload", array('uploadId' => $uploadId->toString(), 'fileOffset' => $fileOffset),null, $content);
        $this->getContext()->addQueryAndResultObject($qry, $this);
        return $this;
    }
    function setProperty($name, $value, $persistChanges = true)
    {
        parent::setProperty($name, $value, $persistChanges);
        //if(is_null($this->resourcePath)){
            if ($name == "UniqueId") {
                $this->resourcePath = new ResourcePath("GetFileById(guid'{$value}')", new ResourcePath("Web"));
            }
            else if ($name == "ServerRelativeUrl") {
                $this->resourcePath = new ResourcePath("GetFileByServerRelativeUrl('$value')", new ResourcePath("Web"));
            }
        //}
    }
    /**
     * Specifies 
     * the comment used when a document is checked into a document library.Its length 
     * MUST be equal to or less than 1023. 
     * @return string
     */
    public function getCheckInComment()
    {
        if (!$this->isPropertyAvailable("CheckInComment")) {
            return null;
        }
        return $this->getProperty("CheckInComment");
    }
    /**
     * Specifies 
     * the comment used when a document is checked into a document library.Its length 
     * MUST be equal to or less than 1023. 
     * @var string
     */
    public function setCheckInComment($value)
    {
        $this->setProperty("CheckInComment", $value, true);
    }
    /**
     * Specifies 
     * the type of check out on the file.
     * @var integer
     */
    public function setCheckOutType($value)
    {
        $this->setProperty("CheckOutType", $value, true);
    }
    /**
     * Returns 
     * internal version of content, used to validate document equality for read 
     * purposes.
     * @return string
     */
    public function getContentTag()
    {
        if (!$this->isPropertyAvailable("ContentTag")) {
            return null;
        }
        return $this->getProperty("ContentTag");
    }
    /**
     * Returns 
     * internal version of content, used to validate document equality for read 
     * purposes.
     * @var string
     */
    public function setContentTag($value)
    {
        $this->setProperty("ContentTag", $value, true);
    }
    /**
     * Specifies 
     * the customization status of the file.
     * @return integer
     */
    public function getCustomizedPageStatus()
    {
        if (!$this->isPropertyAvailable("CustomizedPageStatus")) {
            return null;
        }
        return $this->getProperty("CustomizedPageStatus");
    }
    /**
     * Specifies 
     * the customization status of the file.
     * @var integer
     */
    public function setCustomizedPageStatus($value)
    {
        $this->setProperty("CustomizedPageStatus", $value, true);
    }
    /**
     * Gets the 
     * GUID that uniquely identifies the list/document library containing the file.
     * @return string
     */
    public function getListId()
    {
        if (!$this->isPropertyAvailable("ListId")) {
            return null;
        }
        return $this->getProperty("ListId");
    }
    /**
     * Gets the 
     * GUID that uniquely identifies the list/document library containing the file.
     * @var string
     */
    public function setListId($value)
    {
        $this->setProperty("ListId", $value, true);
    }
    /**
     * Specifies 
     * the ETag (see [RFC2616]) 
     * value.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return string
     */
    public function getETag()
    {
        if (!$this->isPropertyAvailable("ETag")) {
            return null;
        }
        return $this->getProperty("ETag");
    }
    /**
     * Specifies 
     * the ETag (see [RFC2616]) 
     * value.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @var string
     */
    public function setETag($value)
    {
        $this->setProperty("ETag", $value, true);
    }
    /**
     * Specifies 
     * whether the file exists.
     * @return bool
     */
    public function getExists()
    {
        if (!$this->isPropertyAvailable("Exists")) {
            return null;
        }
        return $this->getProperty("Exists");
    }
    /**
     * Specifies 
     * whether the file exists.
     * @var bool
     */
    public function setExists($value)
    {
        $this->setProperty("Exists", $value, true);
    }
    /**
     * Specifies 
     * whether or not Information Rights Management (IRM) is enabled at the file 
     * level. A value of true indicates IRM is enabled; a value of false indicates IRM 
     * is disabled.
     * @return bool
     */
    public function getIrmEnabled()
    {
        if (!$this->isPropertyAvailable("IrmEnabled")) {
            return null;
        }
        return $this->getProperty("IrmEnabled");
    }
    /**
     * Specifies 
     * whether or not Information Rights Management (IRM) is enabled at the file 
     * level. A value of true indicates IRM is enabled; a value of false indicates IRM 
     * is disabled.
     * @var bool
     */
    public function setIrmEnabled($value)
    {
        $this->setProperty("IrmEnabled", $value, true);
    }
    /**
     * Specifies 
     * the size of the file in bytes, excluding the size of any Web Parts 
     * that are used in the file.<32>Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.-2147024891System.UnauthorizedAccessExceptionLack of permissions to perform the operation.
     * @return integer
     */
    public function getLength()
    {
        if (!$this->isPropertyAvailable("Length")) {
            return null;
        }
        return $this->getProperty("Length");
    }
    /**
     * Specifies 
     * the size of the file in bytes, excluding the size of any Web Parts 
     * that are used in the file.<32>Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.-2147024891System.UnauthorizedAccessExceptionLack of permissions to perform the operation.
     * @var integer
     */
    public function setLength($value)
    {
        $this->setProperty("Length", $value, true);
    }
    /**
     * Specifies 
     * the publishing 
     * level of the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return string
     */
    public function getLevel()
    {
        if (!$this->isPropertyAvailable("Level")) {
            return null;
        }
        return $this->getProperty("Level");
    }
    /**
     * Specifies 
     * the publishing 
     * level of the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @var string
     */
    public function setLevel($value)
    {
        $this->setProperty("Level", $value, true);
    }
    /**
     * Specifies 
     * the URL that is suitable for durable linking to the file.It MUST 
     * NOT be NULL. 
     * @return string
     */
    public function getLinkingUri()
    {
        if (!$this->isPropertyAvailable("LinkingUri")) {
            return null;
        }
        return $this->getProperty("LinkingUri");
    }
    /**
     * Specifies 
     * the URL that is suitable for durable linking to the file.It MUST 
     * NOT be NULL. 
     * @var string
     */
    public function setLinkingUri($value)
    {
        $this->setProperty("LinkingUri", $value, true);
    }
    /**
     * Specifies 
     * the URL that is suitable for durable linking to the file.For file 
     * types that do not support durable linking, an empty string is returned.It MUST NOT be NULL. 
     * @return string
     */
    public function getLinkingUrl()
    {
        if (!$this->isPropertyAvailable("LinkingUrl")) {
            return null;
        }
        return $this->getProperty("LinkingUrl");
    }
    /**
     * Specifies 
     * the URL that is suitable for durable linking to the file.For file 
     * types that do not support durable linking, an empty string is returned.It MUST NOT be NULL. 
     * @var string
     */
    public function setLinkingUrl($value)
    {
        $this->setProperty("LinkingUrl", $value, true);
    }
    /**
     * Specifies 
     * the major 
     * version of the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return integer
     */
    public function getMajorVersion()
    {
        if (!$this->isPropertyAvailable("MajorVersion")) {
            return null;
        }
        return $this->getProperty("MajorVersion");
    }
    /**
     * Specifies 
     * the major 
     * version of the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @var integer
     */
    public function setMajorVersion($value)
    {
        $this->setProperty("MajorVersion", $value, true);
    }
    /**
     * Specifies 
     * the minor 
     * version of the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return integer
     */
    public function getMinorVersion()
    {
        if (!$this->isPropertyAvailable("MinorVersion")) {
            return null;
        }
        return $this->getProperty("MinorVersion");
    }
    /**
     * Specifies 
     * the minor 
     * version of the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @var integer
     */
    public function setMinorVersion($value)
    {
        $this->setProperty("MinorVersion", $value, true);
    }
    /**
     * Specifies 
     * the file name including the extension.It MUST 
     * NOT be NULL. Its length MUST be equal to or less than 260. Exceptions: Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return string
     */
    public function getName()
    {
        if (!$this->isPropertyAvailable("Name")) {
            return null;
        }
        return $this->getProperty("Name");
    }
    /**
     * Specifies 
     * the file name including the extension.It MUST 
     * NOT be NULL. Its length MUST be equal to or less than 260. Exceptions: Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
    /**
     * Returns 
     * the render type of the current file. If the file will render in modern 
     * experience which is compelling, flexible and more performant, it'll return ListPageRenderType.Modern. 
     * If the file will render in classic experience, it'll return the reason for 
     * staying in classic, as specified by ListPageRenderType enumeration 
     * (section 3.2.5.415).
     * @return integer
     */
    public function getPageRenderType()
    {
        if (!$this->isPropertyAvailable("PageRenderType")) {
            return null;
        }
        return $this->getProperty("PageRenderType");
    }
    /**
     * Returns 
     * the render type of the current file. If the file will render in modern 
     * experience which is compelling, flexible and more performant, it'll return ListPageRenderType.Modern. 
     * If the file will render in classic experience, it'll return the reason for 
     * staying in classic, as specified by ListPageRenderType enumeration 
     * (section 3.2.5.415).
     * @var integer
     */
    public function setPageRenderType($value)
    {
        $this->setProperty("PageRenderType", $value, true);
    }
    /**
     * Specifies 
     * the server-relative 
     * URL of the file.It MUST 
     * NOT be NULL. It MUST be a URL of server-relative form. 
     * @return string
     */
    public function getServerRelativeUrl()
    {
        if (!$this->isPropertyAvailable("ServerRelativeUrl")) {
            return null;
        }
        return $this->getProperty("ServerRelativeUrl");
    }
    /**
     * Specifies 
     * the server-relative 
     * URL of the file.It MUST 
     * NOT be NULL. It MUST be a URL of server-relative form. 
     * @var string
     */
    public function setServerRelativeUrl($value)
    {
        $this->setProperty("ServerRelativeUrl", $value, true);
    }
    /**
     * Gets the 
     * GUID that identifies the site collection containing the file.
     * @return string
     */
    public function getSiteId()
    {
        if (!$this->isPropertyAvailable("SiteId")) {
            return null;
        }
        return $this->getProperty("SiteId");
    }
    /**
     * Gets the 
     * GUID that identifies the site collection containing the file.
     * @var string
     */
    public function setSiteId($value)
    {
        $this->setProperty("SiteId", $value, true);
    }
    /**
     * Specifies 
     * when the file was created.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return string
     */
    public function getTimeCreated()
    {
        if (!$this->isPropertyAvailable("TimeCreated")) {
            return null;
        }
        return $this->getProperty("TimeCreated");
    }
    /**
     * Specifies 
     * when the file was created.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @var string
     */
    public function setTimeCreated($value)
    {
        $this->setProperty("TimeCreated", $value, true);
    }
    /**
     * Specifies 
     * when the file was last modified.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return string
     */
    public function getTimeLastModified()
    {
        if (!$this->isPropertyAvailable("TimeLastModified")) {
            return null;
        }
        return $this->getProperty("TimeLastModified");
    }
    /**
     * Specifies 
     * when the file was last modified.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @var string
     */
    public function setTimeLastModified($value)
    {
        $this->setProperty("TimeLastModified", $value, true);
    }
    /**
     * Specifies 
     * the display 
     * name of the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return string
     */
    public function getTitle()
    {
        if (!$this->isPropertyAvailable("Title")) {
            return null;
        }
        return $this->getProperty("Title");
    }
    /**
     * Specifies 
     * the display 
     * name of the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @var string
     */
    public function setTitle($value)
    {
        $this->setProperty("Title", $value, true);
    }
    /**
     * Specifies 
     * the implementation-specific version identifier of the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return integer
     */
    public function getUIVersion()
    {
        if (!$this->isPropertyAvailable("UIVersion")) {
            return null;
        }
        return $this->getProperty("UIVersion");
    }
    /**
     * Specifies 
     * the implementation-specific version identifier of the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @var integer
     */
    public function setUIVersion($value)
    {
        $this->setProperty("UIVersion", $value, true);
    }
    /**
     * Specifies 
     * the implementation-specific version identifier of the file.It MUST 
     * NOT be NULL. Exceptions: Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return string
     */
    public function getUIVersionLabel()
    {
        if (!$this->isPropertyAvailable("UIVersionLabel")) {
            return null;
        }
        return $this->getProperty("UIVersionLabel");
    }
    /**
     * Specifies 
     * the implementation-specific version identifier of the file.It MUST 
     * NOT be NULL. Exceptions: Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @var string
     */
    public function setUIVersionLabel($value)
    {
        $this->setProperty("UIVersionLabel", $value, true);
    }
    /**
     * Gets the 
     * GUID that uniquely identifies the file in the content database.
     * @return string
     */
    public function getUniqueId()
    {
        if (!$this->isPropertyAvailable("UniqueId")) {
            return null;
        }
        return $this->getProperty("UniqueId");
    }
    /**
     * Gets the 
     * GUID that uniquely identifies the file in the content database.
     * @var string
     */
    public function setUniqueId($value)
    {
        $this->setProperty("UniqueId", $value, true);
    }
    /**
     * Gets the 
     * GUID for the site containing the file.
     * @return string
     */
    public function getWebId()
    {
        if (!$this->isPropertyAvailable("WebId")) {
            return null;
        }
        return $this->getProperty("WebId");
    }
    /**
     * Gets the 
     * GUID for the site containing the file.
     * @var string
     */
    public function setWebId($value)
    {
        $this->setProperty("WebId", $value, true);
    }
    /**
     * Specifies 
     * the user who added the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return User
     */
    public function getAuthor()
    {
        if (!$this->isPropertyAvailable("Author")) {
            $this->setProperty("Author", new User($this->getContext(),
                new ResourcePath("Author", $this->getResourcePath())));
        }
        return $this->getProperty("Author");
    }
    /**
     * Specifies 
     * the user who has checked out the file.
     * @return User
     */
    public function getCheckedOutByUser()
    {
        if (!$this->isPropertyAvailable("CheckedOutByUser")) {
            $this->setProperty("CheckedOutByUser", new User($this->getContext(), new ResourcePath("CheckedOutByUser", $this->getResourcePath())));
        }
        return $this->getProperty("CheckedOutByUser");
    }
    /**
     * Specifies 
     * the user that owns the current lock on the file.MUST 
     * return null if there is no lock.Exceptions: Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return User
     */
    public function getLockedByUser()
    {
        if (!$this->isPropertyAvailable("LockedByUser")) {
            $this->setProperty("LockedByUser", new User($this->getContext(), new ResourcePath("LockedByUser", $this->getResourcePath())));
        }
        return $this->getProperty("LockedByUser");
    }
    /**
     * Specifies 
     * the user who last modified the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return User
     */
    public function getModifiedBy()
    {
        if (!$this->isPropertyAvailable("ModifiedBy")) {
            $this->setProperty("ModifiedBy", new User($this->getContext(),
                new ResourcePath("ModifiedBy", $this->getResourcePath())));
        }
        return $this->getProperty("ModifiedBy");
    }
    /**
     * @return EffectiveInformationRightsManagementSettings
     */
    public function getEffectiveInformationRightsManagementSettings()
    {
        if (!$this->isPropertyAvailable("EffectiveInformationRightsManagementSettings")) {
            $this->setProperty("EffectiveInformationRightsManagementSettings",
                new EffectiveInformationRightsManagementSettings($this->getContext(),
                    new ResourcePath("EffectiveInformationRightsManagementSettings", $this->getResourcePath())));
        }
        return $this->getProperty("EffectiveInformationRightsManagementSettings");
    }

    /**
     * @return Web|null
     */
    private function getParentWeb()
    {
        if($this->context instanceof ClientContext){
            return $this->context->getWeb();
        }
        return null;
    }

}