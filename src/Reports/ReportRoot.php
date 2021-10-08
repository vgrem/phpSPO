<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Reports;

use Office365\Entity;
use Office365\Runtime\Actions\InvokeMethodQuery;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientResult;
use Office365\Runtime\Http\RequestOptions;

class ReportRoot extends Entity
{
    /**
     * Get details about users who have activated Microsoft 365.
     * @return ClientResult
     */
    function getOffice365ActivationsUserDetail(){
        $qry = new InvokePostMethodQuery($this, "getOffice365ActivationsUserDetail");
        $reportResult = new ClientResult($this->getContext(),new Report());
        $this->getContext()->addQueryAndResultObject($qry, $reportResult);
        return $reportResult;
    }

    /**
     * Get the count of Microsoft 365 activations on desktops and devices.
     * @return ClientResult
     */
    function getOffice365ActivationCounts(){
        $qry = new InvokeMethodQuery($this, "getOffice365ActivationCounts");
        $this->getContext()->getPendingRequest()->beforeExecuteRequestOnce(function (RequestOptions $request){
            $request->FollowLocation = true;
        });
        $reportResult = new ClientResult($this->getContext(),new Report());
        $this->getContext()->addQueryAndResultObject($qry, $reportResult);
        return $reportResult;
    }

    /**
     * Get the count of users that are enabled and those that have activated the Office subscription on
     * desktop or devices or shared computers.
     * @return ClientResult
     */
    function getOffice365ActivationsUserCounts(){
        $qry = new InvokePostMethodQuery($this, "getOffice365ActivationsUserCounts");
        $reportResult = new ClientResult($this->getContext(),new Report());
        $this->getContext()->addQueryAndResultObject($qry, $reportResult);
        return $reportResult;
    }
}