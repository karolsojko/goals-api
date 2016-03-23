<?php

namespace AppBundle\Controller\Goals;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Domain\UseCase\ListGoals\Responder;
use Domain\UseCase\ListGoals\Command;
use Domain\Model\Goal;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ReadController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="List of goals"
     * )
     */
    public function getGoalsAction()
    {
        $useCase = $this->get('app.use_case.list_goals');
        $useCase->execute(new Command(), $this);

        return $this->handleView($this->view);
    }

    public function goalsSuccessfullyRetrieved($goals)
    {
        $this->view = $this->view($goals);
    }
}
