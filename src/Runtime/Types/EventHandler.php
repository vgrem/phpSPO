<?php


namespace Office365\Runtime\Types;


class EventHandler
{
    /**
     * @var array
     */
    protected $events = array();

    /**
     * @param callable $callback
     * @param bool $once
     */
    public function addEvent(callable $callback, $once=false)
    {
        $this->events[] = array("target" => $callback, "once" => $once);
    }

    /**
     * @param array $params
     */
    public function triggerEvent($params){
        foreach ($this->events as $i => $e){
            call_user_func_array($e["target"], $params);
            if($e["once"]){
                unset($this->events[$i]);
            }
        }
    }

}