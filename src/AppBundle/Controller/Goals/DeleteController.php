<?php

namespace AppBundle\Controller\Goals;

use FOS\RestBundle\Controller\FOSRestController;
use Domain\UseCase\RemoveGoal\Responder;
use Domain\UseCase\RemoveGoal\Command;
use Domain\Model\Goal;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DeleteController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="Delete a goal",
     *   parameters={
     *     {"name"="id", "dataType"="string", "description"="goal id"}
     *   }
     * )
     */
    public function deleteGoalsAction($id)
    {
        $useCase = $this->get('app.use_case.remove_goal');
        $useCase->execute(new Command($id), $this);

        return $this->handleView($this->view);
    }

    public function goalSuccessfullyRemoved($id)
    {
        $this->view = $this->view(null, 204);
    }

    public function goalNotFound($id)
    {
        throw $this->createNotFoundException('Goal does not exist');
    }
}
