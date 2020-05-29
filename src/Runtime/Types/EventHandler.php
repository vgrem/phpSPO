<?php


namespace Office365\Runtime\Types;


class EventHandler
{
    /**
     * @var array
     */
    protected $eventsList = array();
    protected $event;

    /**
     * @param callable $event
     * @param bool $once
     */
    public function addEvent(callable $event, $once=false)
    {
        if($once)
            $this->event = $event;
        else
            $this->eventsList[] = $event;
    }

    /**
     * @param array $params
     */
    public function triggerEvent($params){
        foreach ($this->eventsList as $e){
            call_user_func_array($e, $params);
        }
        if (is_callable($this->event)) {
            call_user_func_array($this->event, $params);
            $this->event = null;
        }
    }

}