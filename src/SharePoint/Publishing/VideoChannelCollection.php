<?php


namespace Office365\PHP\Client\SharePoint\Publishing;


use Office365\PHP\Client\Runtime\CreateEntityQuery;
use Office365\PHP\Client\Runtime\ClientObjectCollection;

class VideoChannelCollection extends ClientObjectCollection
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
        $this->getContext()->addQuery($qry, $channel);
        return $channel;
    }

}