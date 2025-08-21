<?php

namespace Office365\Planner\Tasks;

use Office365\Entity;
use Office365\EntityCollection;
use Office365\Planner\Plans\PlannerPlan;
use Office365\Runtime\Actions\CreateEntityQuery;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

class PlannerTaskCollection extends EntityCollection {


    public function __construct(ClientRuntimeContext $ctx, ?ResourcePath $resourcePath = null, ?Entity $parent=null)
    {
        parent::__construct($ctx, $resourcePath, PlannerTask::class, $parent);
    }

    /**
     * Create a new plannerTask.
     * @param string $title
     * @param string|null $planId
     * @param string|null $bucketId
     * @param array $assignments
     * @return PlannerTask
     * @throws \Exception
     */
    public function create($title, $planId=null, $bucketId=null, $assignments=[]){
        /** @var PlannerTask $returnType */
        if ($this->getParent() === null && $planId === null) {
            throw new \Exception("planId is mandatory when creating a task without a parent");
        }

        $returnType = new PlannerTask($this->getContext());
        $this->getContext()->getPlanner()->getTasks()->addChild($returnType);

        $returnType->setTitle($title);
        $returnType->setProperty("bucketId", $bucketId);
        if (!empty($assignments)) {
            $returnType->setProperty("assignments", $assignments);
        }

        $qry = new CreateEntityQuery($returnType);
        $container = $this->getParent();

        if ($container instanceof PlannerPlan) {
            $container->ensureProperty("Id", function () use ($container, $qry, $returnType) {
                $returnType->setProperty("planId", $container->getId());
                $this->getContext()->addQueryAndResultObject($qry,$returnType);
            });
        }
        else {
            $returnType->setProperty("planId", $planId);
            $this->getContext()->addQueryAndResultObject($qry,$returnType);
        }

        return $returnType;
    }

}