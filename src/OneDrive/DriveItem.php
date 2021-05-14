<?php

/**
 * Modified: 2020-05-26T22:33:11+00:00 
 */
namespace Office365\OneDrive;



use Office365\Excel\Workbook;
use Office365\Common\GeoCoordinates;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Actions\InvokeMethodQuery;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\ResourcePathUrl;

/**
 *  Item is the main data model in the OneDrive API. Everything is an item.
 */
class DriveItem extends BaseItem
{

    /**
     * The simple upload API allows you to provide the contents of a new file or update the contents of an
     * existing file in a single API call. This method only supports files up to 4MB in size.
     * @param string $name
     * @param string $content
     * @return DriveItem
     */
    public function upload($name, $content)
    {
        $driveItem = new DriveItem($this->getContext(), new ResourcePathUrl($name,$this->resourcePath));
        $qry = new InvokePostMethodQuery($driveItem, null,null,null,$content);
        $this->getContext()->addQueryAndResultObject($qry,$driveItem);
        $this->getContext()->getPendingRequest()->beforeExecuteRequestOnce(function (RequestOptions $request){
            $request->Url .= "content";
            $request->Method = HttpMethod::Put;
        });
        return $driveItem;
    }


    /**
     * Download the contents of the primary stream (file) of a DriveItem. Only driveItems with the file property
     * can be downloaded.
     * @param resource $handle
     * @return DriveItem
     */
    public function download($handle){
        $qry = new InvokeMethodQuery($this);
        $this->getContext()->getPendingRequest()->beforeExecuteRequestOnce(function (RequestOptions $request) use ($handle){
            $request->Url .= "/content";
            $request->StreamHandle = $handle;
            $request->FollowLocation = true;
        });
        $this->getContext()->addQuery($qry);
        return $this;
    }


    /**
     * Converts the contents of an item in a specific format
     * @param resource $handle
     * @param string $format
     * @return DriveItem
     */
    public function convert($handle, $format)
    {
        $qry = new InvokeMethodQuery($this);
        $this->getContext()->getPendingRequest()->beforeExecuteRequestOnce(function (RequestOptions $request) use ($handle,$format){
            $request->Url .= "content?\$format=$format";
            $request->StreamHandle = $handle;
            $request->FollowLocation = true;
        });
        $this->getContext()->addQuery($qry);
        return $this;
    }

    /**
     * Delete a DriveItem by using its ID or path. Note that deleting items using this method will move the items to
     * the recycle bin instead of permanently deleting the item.
     * @return self
     */
    public function delete()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
        return $this;
    }


    /**
     * @return string
     */
    public function getCTag()
    {
        return $this->getProperty("CTag");
    }

    /**
     *
     * @return self
     * @var string
     */
    public function setCTag($value)
    {
        return $this->setProperty("CTag", $value, true);
    }
    /**
     * @return GeoCoordinates
     */
    public function getLocation()
    {
        return $this->getProperty("Location", new GeoCoordinates());
    }

    /**
     *
     * @return self
     * @var GeoCoordinates
     */
    public function setLocation($value)
    {
        return $this->setProperty("Location", $value, true);
    }
    /**
     * @return integer
     */
    public function getSize()
    {
        return $this->getProperty("Size");
    }

    /**
     *
     * @return self
     * @var integer
     */
    public function setSize($value)
    {
        return $this->setProperty("Size", $value, true);
    }
    /**
     * @return string
     */
    public function getWebDavUrl()
    {
        return $this->getProperty("WebDavUrl");
    }

    /**
     *
     * @return self
     * @var string
     */
    public function setWebDavUrl($value)
    {
        return $this->setProperty("WebDavUrl", $value, true);
    }
    /**
     * @return Audio
     */
    public function getAudio()
    {
        return $this->getProperty("Audio", new Audio());
    }

    /**
     *
     * @return self
     * @var Audio
     */
    public function setAudio($value)
    {
        return $this->setProperty("Audio", $value, true);
    }
    /**
     * @return Deleted
     */
    public function getDeleted()
    {
        return $this->getProperty("Deleted", new Deleted());
    }

    /**
     *
     * @return self
     * @var Deleted
     */
    public function setDeleted($value)
    {
        return $this->setProperty("Deleted", $value, true);
    }
    /**
     * @return File
     */
    public function getFile()
    {
        return $this->getProperty("File", new File());
    }

    /**
     *
     * @return self
     * @var File
     */
    public function setFile($value)
    {
        return $this->setProperty("File", $value, true);
    }
    /**
     * @return FileSystemInfo
     */
    public function getFileSystemInfo()
    {
        return $this->getProperty("FileSystemInfo", new FileSystemInfo());
    }

    /**
     *
     * @return self
     * @var FileSystemInfo
     */
    public function setFileSystemInfo($value)
    {
        return $this->setProperty("FileSystemInfo", $value, true);
    }
    /**
     * @return Folder
     */
    public function getFolder()
    {
        return $this->getProperty("Folder", new Folder());
    }

    /**
     *
     * @return self
     * @var Folder
     */
    public function setFolder($value)
    {
        return $this->setProperty("Folder", $value, true);
    }
    /**
     * @return Image
     */
    public function getImage()
    {
        return $this->getProperty("Image", new Image());
    }

    /**
     *
     * @return self
     * @var Image
     */
    public function setImage($value)
    {
        return $this->setProperty("Image", $value, true);
    }
    /**
     * @return Package
     */
    public function getPackage()
    {
        return $this->getProperty("Package", new Package());
    }
    /**
     * @var Package
     */
    public function setPackage($value)
    {
        $this->setProperty("Package", $value, true);
    }
    /**
     * @return Photo
     */
    public function getPhoto()
    {
        if (!$this->isPropertyAvailable("Photo")) {
            return null;
        }
        return $this->getProperty("Photo");
    }
    /**
     * @var Photo
     */
    public function setPhoto($value)
    {
        $this->setProperty("Photo", $value, true);
    }
    /**
     * @return PublicationFacet
     */
    public function getPublication()
    {
        return $this->getProperty("Publication", new PublicationFacet());
    }
    /**
     * @var PublicationFacet
     */
    public function setPublication($value)
    {
        $this->setProperty("Publication", $value, true);
    }
    /**
     * @return RemoteItem
     */
    public function getRemoteItem()
    {
        return $this->getProperty("RemoteItem", new RemoteItem());
    }
    /**
     * @var RemoteItem
     */
    public function setRemoteItem($value)
    {
        $this->setProperty("RemoteItem", $value, true);
    }
    /**
     * @return Root
     */
    public function getRoot()
    {
        return $this->getProperty("Root", new Root());
    }
    /**
     * @var Root
     */
    public function setRoot($value)
    {
        $this->setProperty("Root", $value, true);
    }
    /**
     * @return SearchResult
     */
    public function getSearchResult()
    {
        return $this->getProperty("SearchResult", new SearchResult());
    }
    /**
     * @var SearchResult
     */
    public function setSearchResult($value)
    {
        $this->setProperty("SearchResult", $value, true);
    }
    /**
     * @return Shared
     */
    public function getShared()
    {
        return $this->getProperty("Shared", new Shared());
    }
    /**
     * @var Shared
     */
    public function setShared($value)
    {
        $this->setProperty("Shared", $value, true);
    }
    /**
     * @return SharepointIds
     */
    public function getSharepointIds()
    {
        return $this->getProperty("SharepointIds", new SharepointIds());
    }
    /**
     * @var SharepointIds
     */
    public function setSharepointIds($value)
    {
        $this->setProperty("SharepointIds", $value, true);
    }
    /**
     * @return SpecialFolder
     */
    public function getSpecialFolder()
    {
        return $this->getProperty("SpecialFolder", new SpecialFolder());
    }
    /**
     * @var SpecialFolder
     */
    public function setSpecialFolder($value)
    {
        $this->setProperty("SpecialFolder", $value, true);
    }
    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->getProperty("Video", new Video());
    }
    /**
     * @var Video
     */
    public function setVideo($value)
    {
        $this->setProperty("Video", $value, true);
    }
    /**
     * @return Workbook
     */
    public function getWorkbook()
    {
        return $this->getProperty("Workbook",
            new Workbook($this->getContext(), new ResourcePath("Workbook", $this->getResourcePath())));
    }
    /**
     * @return ItemAnalytics
     */
    public function getAnalytics()
    {
        return $this->getProperty("Analytics",
            new ItemAnalytics($this->getContext(), new ResourcePath("Analytics", $this->getResourcePath())));
    }
    /**
     * @return ListItem
     */
    public function getListItem()
    {
        return $this->getProperty("ListItem",
            new ListItem($this->getContext(), new ResourcePath("ListItem", $this->getResourcePath())));
    }
    /**
     * @return DriveItemCollection
     */
    public function getChildren()
    {
        return $this->getProperty("Children",
            new DriveItemCollection($this->getContext(), new ResourcePath("Children", $this->getResourcePath())));
    }
    /**
     * @return PermissionCollection
     */
    public function getPermissions()
    {
        return $this->getProperty("Permissions",
            new PermissionCollection($this->getContext(),new ResourcePath("Permissions", $this->getResourcePath())));
    }

    /**
     * @param string $name
     * @param mixed $value
     * @param bool $persistChanges
     * @return self
     */
    public function setProperty($name, $value, $persistChanges = true)
    {
        parent::setProperty($name, $value, $persistChanges);
        if($name == "id" && $this->resourcePath->getParent()->getSegment() == "Children"){
            $this->resourcePath = new ResourcePath($value,
                new ResourcePath("items", $this->parentCollection->getResourcePath()->getParent()->getParent()));
        }
        return $this;
    }


    /**
     * @return bool
     */
    public function isFile(){
        return $this->isPropertyAvailable("File");
    }

    /**
     * @return bool
     */
    public function isFolder(){
        return $this->isPropertyAvailable("Folder");
    }

}