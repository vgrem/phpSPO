<?php


namespace Office365\SharePoint\Publishing;


use Office365\Runtime\Actions\CreateEntityQuery;
use Office365\SharePoint\BaseEntityCollection;

class VideoChannelCollection extends BaseEntityCollection
{

    /**
     * Create an video channel
     * @param string $title
     * @return VideoChannel
     */
    public function add($title) {
        $channel = new VideoChannel($this->getContext());
        $this->addChild($channel);
        $channel->setProperty("Title",$title);
        $channel->setProperty("TileHtmlColor","#0072c6");
        $qry = new CreateEntityQuery($channel);
        $this->getContext()->addQueryAndResultObject($qry, $channel);
        return $channel;
    }

}