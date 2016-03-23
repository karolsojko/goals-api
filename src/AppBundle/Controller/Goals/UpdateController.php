<?php

namespace AppBundle\Controller\Goals;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Domain\UseCase\UpdateGoal\Responder;
use Domain\UseCase\UpdateGoal\Command;
use Domain\Model\Goal;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UpdateController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="update a goal",
     *   parameters={
     *     {"name"="name", "dataType"="string", "required"=false, "description"="goal name"},
     *     {"name"="description", "dataType"="string", "required"=false, "description"="goal description"},
     *     {"name"="icon", "dataType"="string", "required"=false, "description"="goal icon url"},
     *     {"name"="level", "dataType"="integer", "required"=false, "description"="goal level"}
     *   }
     * )
     */
    public function putGoalsAction($id, Request $request)
    {
      $useCase = $this->get('app.use_case.update_goal');

      $name = $request->get('name');
      $description = $request->get('description');
      $icon = $request->get('icon');
      $level = $request->get('level');

      $command = new Command($id);

      if (!empty($name)) {
        $command->setName($name);
      }
      if (!empty($description)) {
        $command->setDescription($description);
      }
      if (!empty($icon)) {
        $command->setIcon($icon);
      }
      if (!empty($level)) {
        $command->setLevel($level);
      }

      $useCase->execute($command, $this);

      return $this->handleView($this->view);
    }

    public function goalNotFound($id)
    {
        throw $this->createNotFoundException('Goal does not exist');
    }

    public function goalSuccessfullyUpdated(Goal $goal)
    {
        $this->view = $this->view($goal);
    }
}
