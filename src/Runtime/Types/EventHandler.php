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
     * @param bool $toBegin
     */
    public function addEvent(callable $callback, $once=false, $toBegin=false)
    {
        if($toBegin)
            array_unshift($this->events , array("target" => $callback, "once" => $once));
        else
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