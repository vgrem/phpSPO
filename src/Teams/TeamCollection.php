<?php


namespace Office365\Teams;


use Office365\Common\Group;
use Office365\EntityCollection;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Http\Response;
use Office365\Runtime\ResourcePath;

class TeamCollection extends EntityCollection
{
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null)
    {
        parent::__construct($ctx, $resourcePath, Team::class);
    }


    /**
     * Create a new team.
     * @param string $displayName
     * @param string|null $description
     * @param string $templateName
     * @return Team
     */
    public function add($displayName=null, $description=null,$templateName="standard")
    {
        $returnType = new Team($this->getContext());
        $this->addChild($returnType);
        $payload = array(
            "template@odata.bind" => "https://graph.microsoft.com/v1.0/teamsTemplates('$templateName')",
            "displayName" => $displayName,
            "description" => $description
        );
        $qry = new InvokePostMethodQuery($this, null, null, null, $payload);
        $this->getContext()->addQueryAndResultObject($qry, $returnType);
        $this->getContext()->getPendingRequest()->beforeExecuteRequestOnce(function (RequestOptions $request) {
            $request->IncludeHeaders = true;
        });

        $this->getContext()->getPendingRequest()->afterExecuteRequest(function ($resp) use ($returnType) {
            $teamId = $this->parseCreateResponse($resp);
            $returnType->setProperty("Id", $teamId, false);
            $returnType->resourcePath = new ResourcePath($teamId, new ResourcePath("groups"));
        }, true);
        return $returnType;
    }

    /**
     * @param Response $response
     */
    private function parseCreateResponse($response){
        $headerKey = "Content-Location";
        $extraHeaders = $response->getHeaders();
        if(array_key_exists($headerKey,$extraHeaders)){
            preg_match('#\(\'(.*?)\'\)#', $extraHeaders[$headerKey], $match);
            return $match[1];
        }
        return null;
    }


    /**
     * To list all teams in an organization (tenant), you find all groups that have teams,
     * and then get information for each team.
     * @param string[] $includeProperties
     */
    public function getAll($includeProperties=array())
    {
        $includeProperties = array_merge($includeProperties, array("id", "resourceProvisioningOptions"));
        $groups = $this->getContext()->getGroups()->select($includeProperties)->get();
        $this->getContext()->getPendingRequest()->afterExecuteRequest(function () use($groups) {
            /** @var Group $group */
            foreach ($groups as $group){
                if (in_array("Team", $group->getProperty("ResourceProvisioningOptions"))) {
                    $this->addChild($group);
                }
            }
        }, true);
        return $this;
    }

}