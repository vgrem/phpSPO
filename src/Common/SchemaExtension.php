<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\Common;

use Office365\Entity;

/**
 *  "Schema extensions allow you to define a schema to extend and add strongly-typed custom data to a resource type. The custom data appears as a complex type on the extended resource. "
 */
class SchemaExtension extends Entity
{
    /**
     * Description for the schema extension.
     * @return string
     */
    public function getDescription()
    {
        if (!$this->isPropertyAvailable("Description")) {
            return null;
        }
        return $this->getProperty("Description");
    }
    /**
     * Description for the schema extension.
     * @var string
     */
    public function setDescription($value)
    {
        $this->setProperty("Description", $value, true);
    }
    /**
     * Set of Microsoft Graph types (that can support extensions) that the schema extension can be applied to. Select from **contact**, **device**, **event**, **group**, **message**, **organization**, **post**, or **user**.
     * @return array
     */
    public function getTargetTypes()
    {
        if (!$this->isPropertyAvailable("TargetTypes")) {
            return null;
        }
        return $this->getProperty("TargetTypes");
    }
    /**
     * Set of Microsoft Graph types (that can support extensions) that the schema extension can be applied to. Select from **contact**, **device**, **event**, **group**, **message**, **organization**, **post**, or **user**.
     * @var array
     */
    public function setTargetTypes($value)
    {
        $this->setProperty("TargetTypes", $value, true);
    }
    /**
     * The lifecycle state of the schema extension. Possible states are **InDevelopment**, **Available**, and **Deprecated**. Automatically set to **InDevelopment** on creation. [Schema extensions](/graph/extensibility-overview#schema-extensions) provides more information on the possible state transitions and behaviors.
     * @return string
     */
    public function getStatus()
    {
        if (!$this->isPropertyAvailable("Status")) {
            return null;
        }
        return $this->getProperty("Status");
    }
    /**
     * The lifecycle state of the schema extension. Possible states are **InDevelopment**, **Available**, and **Deprecated**. Automatically set to **InDevelopment** on creation. [Schema extensions](/graph/extensibility-overview#schema-extensions) provides more information on the possible state transitions and behaviors.
     * @var string
     */
    public function setStatus($value)
    {
        $this->setProperty("Status", $value, true);
    }
    /**
     * @return string
     */
    public function getOwner()
    {
        if (!$this->isPropertyAvailable("Owner")) {
            return null;
        }
        return $this->getProperty("Owner");
    }
    /**
     * @var string
     */
    public function setOwner($value)
    {
        $this->setProperty("Owner", $value, true);
    }
}