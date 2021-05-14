<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive;

use Office365\Entity;

class ColumnDefinition extends Entity
{
    /**
     * @return string
     */
    public function getColumnGroup()
    {
        return $this->getProperty("ColumnGroup");
    }

    /**
     *
     * @return self
     * @var string
     */
    public function setColumnGroup($value)
    {
        return $this->setProperty("ColumnGroup", $value, true);
    }
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getProperty("Description");
    }

    /**
     *
     * @return self
     * @var string
     */
    public function setDescription($value)
    {
        return $this->setProperty("Description", $value, true);
    }
    /**
     * @return string
     */
    public function getDisplayName()
    {
        if (!$this->isPropertyAvailable("DisplayName")) {
            return null;
        }
        return $this->getProperty("DisplayName");
    }

    /**
     *
     * @return self
     * @var string
     */
    public function setDisplayName($value)
    {
        return $this->setProperty("DisplayName", $value, true);
    }
    /**
     * @return bool
     */
    public function getEnforceUniqueValues()
    {
        return $this->getProperty("EnforceUniqueValues");
    }

    /**
     *
     * @return self
     * @var bool
     */
    public function setEnforceUniqueValues($value)
    {
        return $this->setProperty("EnforceUniqueValues", $value, true);
    }
    /**
     * @return bool
     */
    public function getHidden()
    {
        return $this->getProperty("Hidden");
    }
    /**
     * @var bool
     */
    public function setHidden($value)
    {
        $this->setProperty("Hidden", $value, true);
    }
    /**
     * @return bool
     */
    public function getIndexed()
    {
        return $this->getProperty("Indexed");
    }
    /**
     * @var bool
     */
    public function setIndexed($value)
    {
        $this->setProperty("Indexed", $value, true);
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getProperty("Name");
    }

    /**
     *
     * @return self
     * @var string
     */
    public function setName($value)
    {
        return $this->setProperty("Name", $value, true);
    }
    /**
     * @return bool
     */
    public function getReadOnly()
    {
        return $this->getProperty("ReadOnly");
    }
    /**
     * @var bool
     */
    public function setReadOnly($value)
    {
        $this->setProperty("ReadOnly", $value, true);
    }
    /**
     * @return bool
     */
    public function getRequired()
    {
        return $this->getProperty("Required");
    }
    /**
     * @var bool
     */
    public function setRequired($value)
    {
        $this->setProperty("Required", $value, true);
    }
    /**
     * @return BooleanColumn
     */
    public function getBoolean()
    {
        return $this->getProperty("Boolean", new BooleanColumn());
    }
    /**
     * @var BooleanColumn
     */
    public function setBoolean($value)
    {
        $this->setProperty("Boolean", $value, true);
    }
    /**
     * @return CalculatedColumn
     */
    public function getCalculated()
    {
        return $this->getProperty("Calculated", new CalculatedColumn());
    }
    /**
     * @var CalculatedColumn
     */
    public function setCalculated($value)
    {
        $this->setProperty("Calculated", $value, true);
    }
    /**
     * @return ChoiceColumn
     */
    public function getChoice()
    {
        return $this->getProperty("Choice", new ChoiceColumn());
    }
    /**
     * @var ChoiceColumn
     */
    public function setChoice($value)
    {
        $this->setProperty("Choice", $value, true);
    }
    /**
     * @return CurrencyColumn
     */
    public function getCurrency()
    {
        return $this->getProperty("Currency", new CurrencyColumn());
    }
    /**
     * @var CurrencyColumn
     */
    public function setCurrency($value)
    {
        $this->setProperty("Currency", $value, true);
    }
    /**
     * @return DateTimeColumn
     */
    public function getDateTime()
    {
        return $this->getProperty("DateTime", new DateTimeColumn());
    }
    /**
     * @var DateTimeColumn
     */
    public function setDateTime($value)
    {
        $this->setProperty("DateTime", $value, true);
    }
    /**
     * @return DefaultColumnValue
     */
    public function getDefaultValue()
    {
        return $this->getProperty("DefaultValue", new DefaultColumnValue());
    }
    /**
     * @var DefaultColumnValue
     */
    public function setDefaultValue($value)
    {
        $this->setProperty("DefaultValue", $value, true);
    }
    /**
     * @return LookupColumn
     */
    public function getLookup()
    {
        return $this->getProperty("Lookup", new LookupColumn());
    }
    /**
     * @var LookupColumn
     */
    public function setLookup($value)
    {
        $this->setProperty("Lookup", $value, true);
    }
    /**
     * @return NumberColumn
     */
    public function getNumber()
    {
        return $this->getProperty("Number", new NumberColumn());
    }
    /**
     * @var NumberColumn
     */
    public function setNumber($value)
    {
        $this->setProperty("Number", $value, true);
    }
    /**
     * @return PersonOrGroupColumn
     */
    public function getPersonOrGroup()
    {
        return $this->getProperty("PersonOrGroup", new PersonOrGroupColumn());
    }
    /**
     * @var PersonOrGroupColumn
     */
    public function setPersonOrGroup($value)
    {
        $this->setProperty("PersonOrGroup", $value, true);
    }
    /**
     * @return TextColumn
     */
    public function getText()
    {
        return $this->getProperty("Text", new TextColumn());
    }
    /**
     * @var TextColumn
     */
    public function setText($value)
    {
        $this->setProperty("Text", $value, true);
    }
}