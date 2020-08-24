<?php


namespace Office365\OutlookServices;
use Office365\Runtime\Actions\CreateEntityQuery;
use Office365\Runtime\ClientObjectCollection;

class EventCollection extends ClientObjectCollection
{

    /**
     * Create an event in the user's primary calendar or a specific calendar by posting to the calendar's events endpoint.
     * @return Event
     */
    public function createEvent() {
        $event = new Event($this->getContext());
        $this->addChild($event);
        $qry = new CreateEntityQuery($event);
        $this->getContext()->addQueryAndResultObject($qry,$event);
        return $event;
    }

}