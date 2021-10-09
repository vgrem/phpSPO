<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Reports;

use Office365\Entity;
use Office365\Runtime\Actions\InvokeMethodQuery;
use Office365\Runtime\ClientResult;
use Office365\Runtime\Http\RequestOptions;

class ReportRoot extends Entity
{

    /**
     * @param $name string
     * @return ClientResult
     */
    private function addReportQuery($name){
        $qry = new InvokeMethodQuery($this, $name);
        $this->getContext()->getPendingRequest()->beforeExecuteRequestOnce(function (RequestOptions $request){
            $request->FollowLocation = true;
        });
        $reportResult = new ClientResult($this->getContext(),new Report());
        $this->getContext()->addQueryAndResultObject($qry, $reportResult);
        return $reportResult;
    }

    /**
     * Get details about users who have activated Microsoft 365.
     * @return ClientResult
     */
    function getOffice365ActivationsUserDetail(){
        return $this->addReportQuery("getOffice365ActivationsUserDetail");
    }

    /**
     * Get the count of Microsoft 365 activations on desktops and devices.
     * @return ClientResult
     */
    function getOffice365ActivationCounts(){
        return $this->addReportQuery("getOffice365ActivationCounts");
    }

    /**
     * Get the count of users that are enabled and those that have activated the Office subscription on
     * desktop or devices or shared computers.
     * @return ClientResult
     */
    function getOffice365ActivationsUserCounts(){
        return $this->addReportQuery("getOffice365ActivationsUserCounts");
    }
}