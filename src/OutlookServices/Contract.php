<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

/**
 *  "Represents an existing partnership that the partner tenant has with a customer tenant."
 */
class Contract extends Entity
{
    /**
     * Type of contract.<br><br>Possible values are:<br> *SyndicationPartner* - Partner that exclusively resells and manages O365 and Intune for this customer. They resell and support their customers.<br> *BreadthPartner* - Partner has the ability to provide administrative support for this customer. However, the partner is not allowed to resell to the customer.<br>*ResellerPartner* - Partner that is similar to a syndication partner, except that the partner doesn’t have exclusive access to a tenant. In the syndication case, the customer cannot buy additional direct subscriptions from Microsoft or from other partners.
     * @return string
     */
    public function getContractType()
    {
        if (!$this->isPropertyAvailable("ContractType")) {
            return null;
        }
        return $this->getProperty("ContractType");
    }
    /**
     * Type of contract.<br><br>Possible values are:<br> *SyndicationPartner* - Partner that exclusively resells and manages O365 and Intune for this customer. They resell and support their customers.<br> *BreadthPartner* - Partner has the ability to provide administrative support for this customer. However, the partner is not allowed to resell to the customer.<br>*ResellerPartner* - Partner that is similar to a syndication partner, except that the partner doesn’t have exclusive access to a tenant. In the syndication case, the customer cannot buy additional direct subscriptions from Microsoft or from other partners.
     * @var string
     */
    public function setContractType($value)
    {
        $this->setProperty("ContractType", $value, true);
    }
    /**
     * The unique identifier for the customer tenant referenced by this partnership. Corresponds to the id property of the customer tenant's organization resource. 
     * @return string
     */
    public function getCustomerId()
    {
        if (!$this->isPropertyAvailable("CustomerId")) {
            return null;
        }
        return $this->getProperty("CustomerId");
    }
    /**
     * The unique identifier for the customer tenant referenced by this partnership. Corresponds to the id property of the customer tenant's organization resource. 
     * @var string
     */
    public function setCustomerId($value)
    {
        $this->setProperty("CustomerId", $value, true);
    }
    /**
     * A copy of the customer tenant's default domain name. The copy is made when the partnership with the customer is established. It is not automatically updated if the customer tenant's default domain name changes.
     * @return string
     */
    public function getDefaultDomainName()
    {
        if (!$this->isPropertyAvailable("DefaultDomainName")) {
            return null;
        }
        return $this->getProperty("DefaultDomainName");
    }
    /**
     * A copy of the customer tenant's default domain name. The copy is made when the partnership with the customer is established. It is not automatically updated if the customer tenant's default domain name changes.
     * @var string
     */
    public function setDefaultDomainName($value)
    {
        $this->setProperty("DefaultDomainName", $value, true);
    }
    /**
     * A copy of the customer tenant's display name. The copy is made when the partnership with the customer is established. It is not automatically updated if the customer tenant's display name changes.
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
     * A copy of the customer tenant's display name. The copy is made when the partnership with the customer is established. It is not automatically updated if the customer tenant's display name changes.
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
}