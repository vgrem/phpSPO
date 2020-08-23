<?php


namespace Office365\SharePoint\Publishing;


use Office365\Runtime\Actions\CreateEntityQuery;
use Office365\Runtime\ClientObjectCollection;

class VideoCollection extends ClientObjectCollection
{

    public function add($title,$description=null,$fileName=null)
    {
        $videoItem = new VideoItem($this->getContext());
        $this->addChild($videoItem);
        $videoItem->setProperty("Title",$title);
        if(isset($description))
            $videoItem->setProperty("Description",$description);
        if(isset($fileName))
            $videoItem->setProperty("FileName",$fileName);
        $qry = new CreateEntityQuery($videoItem);
        $this->getContext()->addQueryAndResultObject($qry,$videoItem);
        return $videoItem;
    }


    /**
     * @return string
     */
    public function getItemTypeName()
    {
        return __NAMESPACE__ . "\\" . "VideoItem";
    }
}