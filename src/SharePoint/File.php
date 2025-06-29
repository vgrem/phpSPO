<?php

/**
 * Generated  2025-06-14T08:50:37+00:00 16.0.26121.12017
 */
namespace Office365\SharePoint;

use Exception;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientResult;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\Http\RequestException;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Paths\ServiceOperationPath;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Types\Guid;
use Office365\SharePoint\Internal\Paths\FileContentPath;
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
    public function moveToEx($destUrl, $overwrite)
    {
        $this->ensureProperty("ServerRelativeUrl", function () use ($destUrl, $overwrite) {
            MoveCopyUtil::moveFile($this->getContext(), $this->getServerRelativeUrl(), $destUrl, $overwrite, new MoveCopyOptions());
        });
    }
    /**
     * Resolves File from absolute Url
     * @param string $absUrl
     * @return File
     */
    public static function fromUrl($absUrl)
    {
        $ctx = ClientContext::fromUrl($absUrl);
        $fileRelUrl = str_replace($ctx->getBaseUrl(), "", $absUrl);
        return $ctx->getWeb()->getFileByServerRelativeUrl($fileRelUrl);
    }
    /**
     * Downloads file content
     * @param resource $handle
     * @return $this
     */
    public function download($handle)
    {
        $this->ensureProperty("ServerRelativeUrl", function () use ($handle) {
            $this->constructDownloadQuery($this, $handle);
        });
        return $this;
    }
    /**
     * @param File $file
     * @param resource $handle
     */
    private function constructDownloadQuery($file, $handle)
    {
        $file->getContext()->load($file);
        $this->getContext()->getPendingRequest()->beforeExecuteRequestOnce(function ($request) use ($handle) {
            $request->Url .= "/\$value";
            $request->StreamHandle = $handle;
        });
    }
    /**
     * Checks out the file from a document library based on the check-out type.
     * @return $this
     */
    public function checkOut()
    {
        $qry = new InvokePostMethodQuery($this, "checkout");
        $this->getContext()->addQuery($qry);
        return $this;
    }
    /**
     * Reverts an existing checkout for the file.
     * @return $this
     */
    public function undoCheckout()
    {
        $qry = new InvokePostMethodQuery($this, "undocheckout");
        $this->getContext()->addQuery($qry);
        return $this;
    }
    /**
     * Checks the file in to a document library based on the check-in type.
     * @param string $comment A comment for the check-in. Its length must be <= 1023.
     * @return File
     */
    public function checkIn($comment)
    {
        $qry = new InvokePostMethodQuery($this, "checkIn", array("comment" => $comment, "checkintype" => 0));
        $this->getContext()->addQuery($qry);
        return $this;
    }
    /**
     * Approves the file submitted for content approval with the specified comment.
     * @param string $comment The comment for the approval.
     * @return File
     */
    public function approve($comment)
    {
        $qry = new InvokePostMethodQuery($this, "approve", array("comment" => $comment));
        $this->getContext()->addQuery($qry);
        return $this;
    }
    /**
     * Denies approval for a file that was submitted for content approval.
     * @param string $comment The comment for the denial.
     * @return File
     */
    public function deny($comment)
    {
        $qry = new InvokePostMethodQuery($this, "deny", array("comment" => $comment));
        $this->getContext()->addQuery($qry);
        return $this;
    }
    /**
     * Submits the file for content approval with the specified comment.
     * @param string $comment The comment for the published file. Its length must be <= 1023.
     * @return File
     */
    public function publish($comment)
    {
        $qry = new InvokePostMethodQuery($this, "publish", array("comment" => $comment));
        $this->getContext()->addQuery($qry);
        return $this;
    }
    /**
     * Removes the file from content approval or unpublish a major version.
     * @param string $comment The comment for the unpublish operation. Its length must be <= 1023.
     * @return File
     */
    public function unpublish($comment)
    {
        $qry = new InvokePostMethodQuery($this, "unpublish", array("comment" => $comment));
        $this->getContext()->addQuery($qry);
        return $this;
    }
    /**
     * Copies the file to the destination URL.
     * @param string $strNewUrl The absolute URL or server relative URL of the destination file path to copy to.
     * @param bool $bOverWrite true to overwrite a file with the same name in the same location; otherwise false.
     * @return File
     */
    public function copyTo($strNewUrl, $bOverWrite)
    {
        $qry = new InvokePostMethodQuery($this, "copyto", array("strnewurl" => rawurlencode($strNewUrl), "boverwrite" => $bOverWrite));
        $this->getContext()->addQuery($qry);
        return $this;
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
        return $this;
    }
    /**
     * Moves the file to the Recycle Bin and returns the identifier of the new Recycle Bin item.
     */
    public function recycle()
    {
        $qry = new InvokePostMethodQuery($this, "recycle");
        $this->getContext()->addQuery($qry);
        return $this;
    }
    /**
     * Opens the file
     * @param ClientContext $ctx
     * @param string $serverRelativeUrl
     * @param  bool $usePath
     * @return mixed|string
     * @throws Exception
     */
    public static function openBinary(ClientRuntimeContext $ctx, $serverRelativeUrl, $usePath = true)
    {
        $file = new File($ctx);
        if ($usePath) {
            $file->setProperty("ServerRelativePath", new SPResourcePath($serverRelativeUrl));
        } else {
            $file->setProperty("ServerRelativeUrl", $serverRelativeUrl);
        }
        $contentPath = new FileContentPath($file->getResourcePath());
        $url = $ctx->getServiceRootUrl() . $contentPath->toUrl();
        $options = new RequestOptions($url);
        $options->TransferEncodingChunkedAllowed = true;
        $response = $ctx->executeQueryDirect($options);
        if (400 <= $statusCode = $response->getStatusCode()) {
            throw new RequestException(sprintf('Could not open file located at "%s". SharePoint has responded with status code %d, error was: %s', rawurldecode($serverRelativeUrl), $statusCode, $response->getContent()), $statusCode, $response->getContent());
        }
        return $response->getContent();
    }
    /**
     * Saves the file
     * Note: it is supported to update the existing file only. For adding a new file see FileCollection.add method
     * @param ClientContext $ctx
     * @param string $serverRelativeUrl
     * @param string $content file content
     * @param  bool $usePath
     * @throws Exception
     */
    public static function saveBinary(ClientRuntimeContext $ctx, $serverRelativeUrl, $content, $usePath = true)
    {
        $file = new File($ctx);
        if ($usePath) {
            $file->setProperty("ServerRelativePath", new SPResourcePath($serverRelativeUrl));
        } else {
            $file->setProperty("ServerRelativeUrl", $serverRelativeUrl);
        }
        $contentPath = new FileContentPath($file->getResourcePath());
        $url = $ctx->getServiceRootUrl() . $contentPath->toUrl();
        $request = new RequestOptions($url);
        $request->Method = HttpMethod::Post;
        $request->ensureHeader('X-HTTP-Method', 'PUT');
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
        return new LimitedWebPartManager($this->getContext(), new ServiceOperationPath("getLimitedWebPartManager", array($scope), $this->getResourcePath()));
    }
    /**
     * Returns IRM settings for given file.
     *
     * @return InformationRightsManagementSettings
     */
    public function getInformationRightsManagementSettings()
    {
        return $this->getProperty("InformationRightsManagementSettings", new InformationRightsManagementSettings($this->getContext(), new ResourcePath("InformationRightsManagementSettings", $this->getResourcePath())));
    }
    /**
     * Gets a value that returns a collection of file version objects that represent the versions of the file.
     * @return FileVersionCollection
     */
    public function getVersions()
    {
        return $this->getProperty("Versions", new FileVersionCollection($this->getContext(), new ResourcePath("Versions", $this->getResourcePath())));
    }
    /**
     * Gets a value that indicates how the file is checked out of a document library
     * @return int|null
     */
    public function getCheckOutType()
    {
        return $this->getProperty("CheckOutType");
    }
    /**
     * Specifies the list item field (2) values for the list item corresponding to the file.
     * @return ListItem
     */
    public function getListItemAllFields()
    {
        return $this->getProperty("ListItemAllFields", new ListItem($this->getContext(), new ResourcePath("ListItemAllFields", $this->getResourcePath())));
    }
    /**
     * Starts a new chunk upload session and uploads the first fragment
     * @param Guid $uploadId The unique identifier of the upload session.
     * @param string $content
     * @return ClientResult The size of the uploaded data in bytes.
     */
    public function startUpload($uploadId, $content)
    {
        $qry = new InvokePostMethodQuery($this, "StartUpload", array('uploadId' => $uploadId->toString()), null, $content);
        $result = new ClientResult($this->context);
        $this->getContext()->addQueryAndResultObject($qry, $result);
        return $result;
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
        $result = new ClientResult($this->context);
        $qry = new InvokePostMethodQuery($this, "ContinueUpload", array('uploadId' => $uploadId->toString(), 'fileOffset' => $fileOffset), null, $content);
        $this->getContext()->addQueryAndResultObject($qry, $result);
        return $result;
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
        $qry = new InvokePostMethodQuery($this, "finishupload", array('uploadId' => $uploadId->toString(), 'fileOffset' => $fileOffset), null, $content);
        $this->getContext()->addQueryAndResultObject($qry, $this);
        return $this;
    }
    function setProperty($name, $value, $persistChanges = true)
    {
        parent::setProperty($name, $value, $persistChanges);
        if ($name === "UniqueId") {
            $this->resourcePath = $this->getParentWeb()->getFileById($value)->getResourcePath();
        }
        if (is_null($this->resourcePath)) {
            if ($name === "ServerRelativeUrl") {
                $this->resourcePath = $this->getParentWeb()->getFileByServerRelativeUrl($value)->getResourcePath();
            } elseif ($name === "ServerRelativePath") {
                $this->resourcePath = $this->getParentWeb()->getFileByServerRelativePath($value)->getResourcePath();
            }
        }
        return $this;
    }
    /**
     * Specifies 
     * the comment used when a document is checked into a document library.Its length 
     * MUST be equal to or less than 1023. 
     * @return string
     */
    public function getCheckInComment()
    {
        return $this->getProperty("CheckInComment");
    }
    /**
     * Specifies
     * the comment used when a document is checked into a document library.Its length
     * MUST be equal to or less than 1023.
     *
     * @return self
     * @var string
     */
    public function setCheckInComment($value)
    {
        return $this->setProperty("CheckInComment", $value, true);
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
        return $this->getProperty("Author", new User($this->getContext(), new ResourcePath("Author", $this->getResourcePath())));
    }
    /**
     * Specifies 
     * the user who has checked out the file.
     * @return User
     */
    public function getCheckedOutByUser()
    {
        return $this->getProperty("CheckedOutByUser", new User($this->getContext(), new ResourcePath("CheckedOutByUser", $this->getResourcePath())));
    }
    /**
     * Specifies 
     * the user that owns the current lock on the file.MUST 
     * return null if there is no lock.Exceptions: Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return User
     */
    public function getLockedByUser()
    {
        return $this->getProperty("LockedByUser", new User($this->getContext(), new ResourcePath("LockedByUser", $this->getResourcePath())));
    }
    /**
     * Specifies 
     * the user who last modified the file.Exceptions: 
     * Error CodeError Type NameCondition-2147024894System.IO.FileNotFoundExceptionFile cannot be found.
     * @return User
     */
    public function getModifiedBy()
    {
        return $this->getProperty("ModifiedBy", new User($this->getContext(), new ResourcePath("ModifiedBy", $this->getResourcePath())));
    }
    /**
     * @return EffectiveInformationRightsManagementSettings
     */
    public function getEffectiveInformationRightsManagementSettings()
    {
        return $this->getProperty("EffectiveInformationRightsManagementSettings", new EffectiveInformationRightsManagementSettings($this->getContext(), new ResourcePath("EffectiveInformationRightsManagementSettings", $this->getResourcePath())));
    }
    /**
     * @return Web|null
     */
    private function getParentWeb()
    {
        return $this->getContext()->getWeb();
    }
    /**
     * Specifies 
     * the relative path of the file based on the URL for the server.
     * @return SPResourcePath
     */
    public function getServerRelativePath()
    {
        return $this->getProperty("ServerRelativePath", new SPResourcePath());
    }
    /**
     * Specifies 
     * the relative path of the file based on the URL for the server.
     * @var SPResourcePath
     */
    public function setServerRelativePath($value)
    {
        $this->setProperty("ServerRelativePath", $value, true);
    }
    /**
     * @return string
     */
    public function getVroomItemID()
    {
        return $this->getProperty("VroomItemID");
    }
    /**
     * @var string
     */
    public function setVroomItemID($value)
    {
        $this->setProperty("VroomItemID", $value, true);
    }
    /**
     * @return string
     */
    public function getVroomDriveID()
    {
        return $this->getProperty("VroomDriveID");
    }
    /**
     * @var string
     */
    public function setVroomDriveID($value)
    {
        $this->setProperty("VroomDriveID", $value, true);
    }
    /**
     * @return bool
     */
    public function getHasAlternateContentStreams()
    {
        return $this->getProperty("HasAlternateContentStreams");
    }
    /**
     * @var bool
     */
    public function setHasAlternateContentStreams($value)
    {
        $this->setProperty("HasAlternateContentStreams", $value, true);
    }
    /**
     * @return string
     */
    public function getServerRedirectedUrl()
    {
        return $this->getProperty("ServerRedirectedUrl");
    }
    /**
     * @var string
     */
    public function setServerRedirectedUrl($value)
    {
        $this->setProperty("ServerRedirectedUrl", $value, true);
    }
    /**
     * @return ListItemComplianceInfo
     */
    public function getComplianceInfo()
    {
        return $this->getProperty("ComplianceInfo");
    }
    /**
     * @var ListItemComplianceInfo
     */
    public function setComplianceInfo($value)
    {
        return $this->setProperty("ComplianceInfo", $value, true);
    }
    /**
     * @return string
     */
    public function getExpirationDate()
    {
        return $this->getProperty("ExpirationDate");
    }
    /**
     * @var string
     */
    public function setExpirationDate($value)
    {
        return $this->setProperty("ExpirationDate", $value, true);
    }
    /**
     * @return bool
     */
    public function getExistsAllowThrowForPolicyFailures()
    {
        return $this->getProperty("ExistsAllowThrowForPolicyFailures");
    }
    /**
     * @var bool
     */
    public function setExistsAllowThrowForPolicyFailures($value)
    {
        return $this->setProperty("ExistsAllowThrowForPolicyFailures", $value, true);
    }
    /**
     * @return FileVersionCollection
     */
    public function getVersionExpirationReport()
    {
        return $this->getProperty("VersionExpirationReport", new FileVersionCollection($this->getContext(), new ResourcePath("VersionExpirationReport", $this->getResourcePath())));
    }
    /**
     * @return bool
     */
    public function getExistsWithException()
    {
        return $this->getProperty("ExistsWithException");
    }
    /**
     * @var bool
     */
    public function setExistsWithException($value)
    {
        return $this->setProperty("ExistsWithException", $value, true);
    }
    /**
     * @return bool
     */
    public function getSuppressExpirationNotification()
    {
        return $this->getProperty("SuppressExpirationNotification");
    }
    /**
     * @var bool
     */
    public function setSuppressExpirationNotification($value)
    {
        return $this->setProperty("SuppressExpirationNotification", $value, true);
    }
    /**
     * @return Web
     */
    public function getWeb()
    {
        return $this->getProperty("Web", new Web($this->getContext(), new ResourcePath("Web", $this->getResourcePath())));
    }
}