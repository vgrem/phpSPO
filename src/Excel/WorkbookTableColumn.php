<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;

use Office365\Common\Json;
use Office365\Runtime\ResourcePath;
class WorkbookTableColumn extends Entity
{
    /**
     * @return integer
     */
    public function getIndex()
    {
        if (!$this->isPropertyAvailable("Index")) {
            return null;
        }
        return $this->getProperty("Index");
    }
    /**
     * @var integer
     */
    public function setIndex($value)
    {
        $this->setProperty("Index", $value, true);
    }
    /**
     * @return string
     */
    public function getName()
    {
        if (!$this->isPropertyAvailable("Name")) {
            return null;
        }
        return $this->getProperty("Name");
    }
    /**
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
    /**
     * @return Json
     */
    public function getValues()
    {
        if (!$this->isPropertyAvailable("Values")) {
            return null;
        }
        return $this->getProperty("Values");
    }
    /**
     * @var Json
     */
    public function setValues($value)
    {
        $this->setProperty("Values", $value, true);
    }
    /**
     * @return WorkbookFilter
     */
    public function getFilter()
    {
        if (!$this->isPropertyAvailable("Filter")) {
            $this->setProperty("Filter", new WorkbookFilter($this->getContext(), new ResourcePath("Filter", $this->getResourcePath())));
        }
        return $this->getProperty("Filter");
    }
}