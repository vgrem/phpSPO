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
     * @param $period string
     * @return ClientResult
     */
    private function addReportQuery($name,$period=null){
        $qry = new InvokeMethodQuery($this, $name);
        if(!is_null($period))
            $qry->MethodParameters = array("period" => $period);
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


    /**
     * Get details about Microsoft 365 active users.
     * @return ClientResult
     */
    function getOffice365ActiveUserDetail($period){
        return $this->addReportQuery("getOffice365ActiveUserDetail",$period);
    }


    /**
     * Get the count of daily active users in the reporting period by product.
     * @return ClientResult
     */
    function getOffice365ActiveUserCounts($period){
        return $this->addReportQuery("getOffice365ActiveUserCounts",$period);
    }


    /**
     * Get the count of users by activity type and service.
     * @return ClientResult
     */
    function getOffice365ServicesUserCounts($period){
        return $this->addReportQuery("getOffice365ServicesUserCounts",$period);
    }

    /**
     * Get details about Microsoft 365 groups activity by group.
     * @return ClientResult
     */
    function getOffice365GroupsActivityDetail($period){
        return $this->addReportQuery("getOffice365GroupsActivityDetail",$period);
    }

    /**
     * Get the number of group activities across group workloads.
     * @return ClientResult
     */
    function getOffice365GroupsActivityCounts($period){
        return $this->addReportQuery("getOffice365GroupsActivityCounts",$period);
    }

    /**
     * Get the daily total number of groups and how many of them were active based on email conversations,
     * Yammer posts, and SharePoint file activities.
     * @return ClientResult
     */
    function getOffice365GroupsActivityGroupCounts($period){
        return $this->addReportQuery("getOffice365GroupsActivityGroupCounts",$period);
    }

    /**
     * Get the total storage used across all group mailboxes and group sites.
     * @return ClientResult
     */
    function getOffice365GroupsActivityStorage($period){
        return $this->addReportQuery("getOffice365GroupsActivityStorage",$period);
    }

    /**
     * Get the total number of files and how many of them were active across all group sites associated with
     * a Microsoft 365 group.
     * @return ClientResult
     */
    function getOffice365GroupsActivityFileCounts($period){
        return $this->addReportQuery("getOffice365GroupsActivityFileCounts",$period);
    }


}