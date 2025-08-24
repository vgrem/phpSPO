<?php

/**
 * Generated  2025-08-24T07:40:13+00:00 16.0.26406.12014
 */
namespace Office365\SharePoint\CompliancePolicy;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
use Office365\SharePoint\BaseEntity;

class PolicyEvaluationInfo extends BaseEntity
{
    /**
     * @return array
     */
    public function getApplicablePolicies()
    {
        return $this->getProperty("ApplicablePolicies");
    }
    /**
     * @var array
     */
    public function setApplicablePolicies($value)
    {
        return $this->setProperty("ApplicablePolicies", $value, true);
    }
    /**
     * @return integer
     */
    public function getDlpAccessScope()
    {
        return $this->getProperty("DlpAccessScope");
    }
    /**
     * @var integer
     */
    public function setDlpAccessScope($value)
    {
        return $this->setProperty("DlpAccessScope", $value, true);
    }
    /**
     * @return array
     */
    public function getMatchedRules()
    {
        return $this->getProperty("MatchedRules");
    }
    /**
     * @var array
     */
    public function setMatchedRules($value)
    {
        return $this->setProperty("MatchedRules", $value, true);
    }
    /**
     * @return array
     */
    public function getOverriddenRules()
    {
        return $this->getProperty("OverriddenRules");
    }
    /**
     * @var array
     */
    public function setOverriddenRules($value)
    {
        return $this->setProperty("OverriddenRules", $value, true);
    }
}