<?php

/**
 * Modified: 2019-11-17T18:33:00+00:00 16.0.19506.12022
 */
namespace Office365\SharePoint\Sharing;

use Office365\SharePoint\BaseEntity;
use Office365\SharePoint\ContentTypeId;

class SharedDocumentInfo extends BaseEntity
{
    /**
     * @return Principal
     */
    public function getAuthor()
    {
        return $this->getProperty("Author", new Principal());
    }
    /**
     * @var Principal
     */
    public function setAuthor($value)
    {
        $this->setProperty("Author", $value, true);
    }
    /**
     * @return string
     */
    public function getCallerStack()
    {
        return $this->getProperty("CallerStack");
    }
    /**
     * @var string
     */
    public function setCallerStack($value)
    {
        $this->setProperty("CallerStack", $value, true);
    }
    /**
     * @return ContentTypeId
     */
    public function getContentTypeId()
    {
        return $this->getProperty("ContentTypeId");
    }
    /**
     * @var ContentTypeId
     */
    public function setContentTypeId($value)
    {
        $this->setProperty("ContentTypeId", $value, true);
    }
    /**
     * @return string
     */
    public function getDriveAccessToken()
    {
        return $this->getProperty("DriveAccessToken");
    }
    /**
     * @var string
     */
    public function setDriveAccessToken($value)
    {
        $this->setProperty("DriveAccessToken", $value, true);
    }
    /**
     * @return string
     */
    public function getDriveAccessTokenV21()
    {
        return $this->getProperty("DriveAccessTokenV21");
    }
    /**
     * @var string
     */
    public function setDriveAccessTokenV21($value)
    {
        $this->setProperty("DriveAccessTokenV21", $value, true);
    }
    /**
     * @return string
     */
    public function getDriveUrl()
    {
        return $this->getProperty("DriveUrl");
    }
    /**
     * @var string
     */
    public function setDriveUrl($value)
    {
        $this->setProperty("DriveUrl", $value, true);
    }
    /**
     * @return Principal
     */
    public function getEditor()
    {
        return $this->getProperty("Editor", new Principal());
    }
    /**
     * @var Principal
     */
    public function setEditor($value)
    {
        $this->setProperty("Editor", $value, true);
    }
    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->getProperty("Extension");
    }
    /**
     * @var string
     */
    public function setExtension($value)
    {
        $this->setProperty("Extension", $value, true);
    }
    /**
     * @return string
     */
    public function getFileLeafRef()
    {
        return $this->getProperty("FileLeafRef");
    }
    /**
     * @var string
     */
    public function setFileLeafRef($value)
    {
        $this->setProperty("FileLeafRef", $value, true);
    }
    /**
     * @return string
     */
    public function getFileRef()
    {
        return $this->getProperty("FileRef");
    }
    /**
     * @var string
     */
    public function setFileRef($value)
    {
        $this->setProperty("FileRef", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsContainer()
    {
        return $this->getProperty("IsContainer");
    }
    /**
     * @var bool
     */
    public function setIsContainer($value)
    {
        $this->setProperty("IsContainer", $value, true);
    }
    /**
     * @return string
     */
    public function getLinkingUrl()
    {
        return $this->getProperty("LinkingUrl");
    }
    /**
     * @var string
     */
    public function setLinkingUrl($value)
    {
        $this->setProperty("LinkingUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getListId()
    {
        return $this->getProperty("ListId");
    }
    /**
     * @var string
     */
    public function setListId($value)
    {
        $this->setProperty("ListId", $value, true);
    }
    /**
     * @return integer
     */
    public function getListItemId()
    {
        return $this->getProperty("ListItemId");
    }
    /**
     * @var integer
     */
    public function setListItemId($value)
    {
        $this->setProperty("ListItemId", $value, true);
    }
    /**
     * @return string
     */
    public function getMediaBaseUrl()
    {
        if (!$this->isPropertyAvailable("MediaBaseUrl")) {
            return null;
        }
        return $this->getProperty("MediaBaseUrl");
    }
    /**
     * @var string
     */
    public function setMediaBaseUrl($value)
    {
        $this->setProperty("MediaBaseUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getModified()
    {
        if (!$this->isPropertyAvailable("Modified")) {
            return null;
        }
        return $this->getProperty("Modified");
    }
    /**
     * @var string
     */
    public function setModified($value)
    {
        $this->setProperty("Modified", $value, true);
    }
    /**
     * @return string
     */
    public function getOfficeBundleGenerate()
    {
        if (!$this->isPropertyAvailable("OfficeBundleGenerate")) {
            return null;
        }
        return $this->getProperty("OfficeBundleGenerate");
    }
    /**
     * @var string
     */
    public function setOfficeBundleGenerate($value)
    {
        $this->setProperty("OfficeBundleGenerate", $value, true);
    }
    /**
     * @return string
     */
    public function getOfficeBundleGetFragment()
    {
        if (!$this->isPropertyAvailable("OfficeBundleGetFragment")) {
            return null;
        }
        return $this->getProperty("OfficeBundleGetFragment");
    }
    /**
     * @var string
     */
    public function setOfficeBundleGetFragment($value)
    {
        $this->setProperty("OfficeBundleGetFragment", $value, true);
    }
    /**
     * @return string
     */
    public function getPdfConversionUrl()
    {
        if (!$this->isPropertyAvailable("PdfConversionUrl")) {
            return null;
        }
        return $this->getProperty("PdfConversionUrl");
    }
    /**
     * @var string
     */
    public function setPdfConversionUrl($value)
    {
        $this->setProperty("PdfConversionUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getProgId()
    {
        if (!$this->isPropertyAvailable("ProgId")) {
            return null;
        }
        return $this->getProperty("ProgId");
    }
    /**
     * @var string
     */
    public function setProgId($value)
    {
        $this->setProperty("ProgId", $value, true);
    }
    /**
     * @return string
     */
    public function getServerRedirectedEmbedUrl()
    {
        if (!$this->isPropertyAvailable("ServerRedirectedEmbedUrl")) {
            return null;
        }
        return $this->getProperty("ServerRedirectedEmbedUrl");
    }
    /**
     * @var string
     */
    public function setServerRedirectedEmbedUrl($value)
    {
        $this->setProperty("ServerRedirectedEmbedUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getServerRedirectedPreviewUrl()
    {
        if (!$this->isPropertyAvailable("ServerRedirectedPreviewUrl")) {
            return null;
        }
        return $this->getProperty("ServerRedirectedPreviewUrl");
    }
    /**
     * @var string
     */
    public function setServerRedirectedPreviewUrl($value)
    {
        $this->setProperty("ServerRedirectedPreviewUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getServerRedirectedUrl()
    {
        if (!$this->isPropertyAvailable("ServerRedirectedUrl")) {
            return null;
        }
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
     * @var string
     */
    public function setSiteId($value)
    {
        $this->setProperty("SiteId", $value, true);
    }
    /**
     * @return string
     */
    public function getSiteUrl()
    {
        if (!$this->isPropertyAvailable("SiteUrl")) {
            return null;
        }
        return $this->getProperty("SiteUrl");
    }
    /**
     * @var string
     */
    public function setSiteUrl($value)
    {
        $this->setProperty("SiteUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getSpItemUrl()
    {
        if (!$this->isPropertyAvailable("SpItemUrl")) {
            return null;
        }
        return $this->getProperty("SpItemUrl");
    }
    /**
     * @var string
     */
    public function setSpItemUrl($value)
    {
        $this->setProperty("SpItemUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getSpResourceUrl()
    {
        if (!$this->isPropertyAvailable("SpResourceUrl")) {
            return null;
        }
        return $this->getProperty("SpResourceUrl");
    }
    /**
     * @var string
     */
    public function setSpResourceUrl($value)
    {
        $this->setProperty("SpResourceUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getThumbnailUrl()
    {
        if (!$this->isPropertyAvailable("ThumbnailUrl")) {
            return null;
        }
        return $this->getProperty("ThumbnailUrl");
    }
    /**
     * @var string
     */
    public function setThumbnailUrl($value)
    {
        $this->setProperty("ThumbnailUrl", $value, true);
    }
    /**
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
     * @var string
     */
    public function setTitle($value)
    {
        $this->setProperty("Title", $value, true);
    }
    /**
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
     * @var string
     */
    public function setUniqueId($value)
    {
        $this->setProperty("UniqueId", $value, true);
    }
    /**
     * @return string
     */
    public function getUrlPath()
    {
        if (!$this->isPropertyAvailable("UrlPath")) {
            return null;
        }
        return $this->getProperty("UrlPath");
    }
    /**
     * @var string
     */
    public function setUrlPath($value)
    {
        $this->setProperty("UrlPath", $value, true);
    }
    /**
     * @return string
     */
    public function getVideoManifestUrl()
    {
        if (!$this->isPropertyAvailable("VideoManifestUrl")) {
            return null;
        }
        return $this->getProperty("VideoManifestUrl");
    }
    /**
     * @var string
     */
    public function setVideoManifestUrl($value)
    {
        $this->setProperty("VideoManifestUrl", $value, true);
    }
    /**
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
     * @var string
     */
    public function setWebId($value)
    {
        $this->setProperty("WebId", $value, true);
    }
}