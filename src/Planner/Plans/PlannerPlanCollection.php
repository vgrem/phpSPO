<?php

namespace Office365\Planner\Plans;


use Office365\EntityCollection;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\ResourcePath;

class PlannerPlanCollection extends EntityCollection {

    /**
     * @var mixed|null
     */
    private $parent;

    public function __construct(ClientRuntimeContext $ctx, ?ResourcePath $resourcePath = null, $parent=null)
    {
        parent::__construct($ctx, $resourcePath, PlannerPlan::class);
        $this->parent = $parent;
    }

    /**
     * Create a new plannerPlan object.
     * Note: If the container is a Microsoft 365 group, the user who creates the plan must be a member of the group
     * that contains the plan. When you create a new group by using Create group, you aren't added to the group
     * as a member. After the group is created, add yourself as a member by using group post members.
     * @param $title
     * @return PlannerPlan
     */
    public function create($title){
        /** @var PlannerPlan $returnType */
        $containerUrl = $this->getContainerUrl();
        $returnType = $this->add();
        $returnType->setTitle($title);
        $returnType->setProperty("container", ["url" => $containerUrl]);
        $this->getContext()->getPendingRequest()->beforeExecuteRequestOnce(function (RequestOptions $request){
            $request->Url = $this->getContext()->getServiceRootUrl() . "/planner/plans";
        });
        return $returnType;
    }

    public function getContainerUrl()
    {
        if ($this->parent === null) {
            throw new \RuntimeException("Parent resource is not available");
        }
        $resourceUrl = $this->parent->getResourceUrl();

        if (str_ends_with($resourceUrl, '/Planner')) {
            $resourceUrl = substr($resourceUrl, 0, -8);
        }

        return $resourceUrl;
    }

}