<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

/**
 * Represents a submitted data policy operation. It contains necessary information for tracking the status of an operation. For example, a company administrator can submit a data policy operation request to export an employee's company data, and then later track that request.
 */
class DataPolicyOperation extends ClientObject
{
    /**
     * The URL location to where data is being exported for export requests.
     * @return string
     */
    public function getStorageLocation()
    {
        if (!$this->isPropertyAvailable("StorageLocation")) {
            return null;
        }
        return $this->getProperty("StorageLocation");
    }
    /**
     * The URL location to where data is being exported for export requests.
     * @var string
     */
    public function setStorageLocation($value)
    {
        $this->setProperty("StorageLocation", $value, true);
    }
    /**
     * The id for the user on whom the operation is performed.
     * @return string
     */
    public function getUserId()
    {
        if (!$this->isPropertyAvailable("UserId")) {
            return null;
        }
        return $this->getProperty("UserId");
    }
    /**
     * The id for the user on whom the operation is performed.
     * @var string
     */
    public function setUserId($value)
    {
        $this->setProperty("UserId", $value, true);
    }
    /**
     * Specifies the progress of an operation.
     * @return double
     */
    public function getProgress()
    {
        if (!$this->isPropertyAvailable("Progress")) {
            return null;
        }
        return $this->getProperty("Progress");
    }
    /**
     * Specifies the progress of an operation.
     * @var double
     */
    public function setProgress($value)
    {
        $this->setProperty("Progress", $value, true);
    }
}