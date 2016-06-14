<?php

namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\WebParts\LimitedWebPartManager;
use SharePoint\PHP\Client\WebParts\PersonalizationScope;

/**
 * File client object
 *
 * @property InformationRightsManagementSettings InformationRightsManagementSettings
 */
class File extends SecurableObject
{

     /**
      * Checks out the file from a document library based on the check-out type.
      */
     public function checkOut(){

          $qry = new ClientQuery($this->getUrl() . "/checkout", ClientActionType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Reverts an existing checkout for the file.
      */
     public function undoCheckout(){
          $qry = new ClientQuery($this->getUrl() . "/undocheckout", ClientActionType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Checks the file in to a document library based on the check-in type.
      * @param string $comment A comment for the check-in. Its length must be <= 1023.
      */
     public function checkIn($comment){
          $qry = new ClientQuery($this->getUrl() . "/checkin(comment='$comment',checkintype=0)", ClientActionType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Approves the file submitted for content approval with the specified comment.
      * @param string $comment The comment for the approval.
      */
     public function approve($comment){
          $qry = new ClientQuery($this->getUrl() . "/approve(comment='$comment')", ClientActionType::Update);
          $this->getContext()->addQuery($qry);
     }

     /**
      * Denies approval for a file that was submitted for content approval.
      * @param string $comment The comment for the denial.
      */
     public function deny($comment){
          $qry = new ClientQuery($this->getUrl() . "/deny(comment='$comment')", ClientActionType::Update);
          $this->getContext()->addQuery($qry);
     }

     /**
      * Submits the file for content approval with the specified comment.
      * @param string $comment The comment for the published file. Its length must be <= 1023.
      */
     public function publish($comment){
          $qry = new ClientQuery($this->getUrl() . "/publish(comment='$comment')", ClientActionType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Removes the file from content approval or unpublish a major version.
      * @param string $comment The comment for the unpublish operation. Its length must be <= 1023.
      */
     public function unpublish($comment){
          $qry = new ClientQuery($this->getUrl() . "/unpublish(comment='$comment')", ClientActionType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Copies the file to the destination URL.
      * @param string $strNewUrl The absolute URL or server relative URL of the destination file path to copy to.
      * @param bool $bOverWrite true to overwrite a file with the same name in the same location; otherwise false.
      */
     public function copyTo($strNewUrl,$bOverWrite){
          $qry = new ClientQuery($this->getUrl() . "/copyto(strnewurl='$strNewUrl',boverwrite=$bOverWrite)", ClientActionType::Update);
          $this->getContext()->addQuery($qry);
     }

     /**
      * Moves the file to the specified destination URL.
      * @param string $newUrl The absolute URL or server relative URL of the destination file path to move to.
      * @param int $flags The bitwise SP.MoveOperations value for how to move the file. Overwrite = 1; AllowBrokenThickets (move even if supporting files are separated from the file) = 8.
      */
     public function moveTo($newUrl,$flags){
          $qry = new ClientQuery($this->getUrl() . "/moveto(newurl='$newUrl',flags=$flags)", ClientActionType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Moves the file to the Recycle Bin and returns the identifier of the new Recycle Bin item.
      */
     public function recycle(){
          $qry = new ClientQuery($this->getUrl() . "/recycle", ClientActionType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Opens the file
      * @param ClientContext $ctx
      * @param $serverRelativeUrl
      * @return mixed|string
      */
     public static function openBinary(ClientContext $ctx,$serverRelativeUrl){
          $serverRelativeUrl = rawurlencode($serverRelativeUrl);

          $options = array(
              'url' => $ctx->getUrl() . "/_api/web/getfilebyserverrelativeurl('$serverRelativeUrl')/\$value",
              'method' => 'GET'
          );
          $data = $ctx->getPendingRequest()->executeQueryDirect($options);
          return $data;
     }

     /**
      * Saves the file
      * Note: it is supported to update the existing file only. For adding a new file see FileCollection.add method
      * @param ClientContext $ctx
      * @param $serverRelativeUrl
      * @param $content file content
      */
     public static function saveBinary(ClientContext $ctx,$serverRelativeUrl,$content){
          $serverRelativeUrl = rawurlencode($serverRelativeUrl);
          $options = array(
              'url' => $ctx->getUrl() . "/_api/web/getfilebyserverrelativeurl('$serverRelativeUrl')/\$value",
              'method' => 'POST',
              'headers' => array(
                  'X-HTTP-Method' => 'PUT'
              ),
              'data' => $content,
              'binaryStringRequestBody' => true
          );
          $ctx->getPendingRequest()->executeQueryDirect($options);
     }


     /**
      * Specifies the control set used to access, modify, or add Web Parts associated with this Web Part Page and view.
      * An exception is thrown if the file is not an ASPX page.
      * @param int $scope
      * @return LimitedWebPartManager
      */
     public function getLimitedWebPartManager($scope)
     {
          $manager = new LimitedWebPartManager($this->getContext(),$this->getResourcePath(), "getlimitedwebpartmanager($scope)");
          return $manager;
     }

     /**
      * Returns IRM settings for given file.
      * 
      * @return InformationRightsManagementSettings
      */
     public function getInformationRightsManagementSettings()
     {
          if(!$this->isPropertyAvailable('InformationRightsManagementSettings')){
               $this->InformationRightsManagementSettings = new InformationRightsManagementSettings($this->getContext(),$this->getResourcePath(), "InformationRightsManagementSettings");
          }
          return $this->InformationRightsManagementSettings;
     }
}