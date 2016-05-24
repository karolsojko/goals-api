<?php

namespace AppBundle\Controller\Goals;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Domain\UseCase\AddGoal\Responder;
use Domain\UseCase\AddGoal\Command;
use Domain\Model\Goal;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CreateController extends FOSRestController implements Responder
{
    private $view;

    /**
     * @ApiDoc(
     *   resource=true,
     *   description="Create a goal",
     *   parameters={
     *     {"name"="name", "dataType"="string", "required"=true, "description"="goal name"},
     *     {"name"="description", "dataType"="string", "required"=true, "description"="goal description"},
     *     {"name"="icon", "dataType"="string", "required"=false, "description"="goal icon url"},
     *     {"name"="tags", "dataType"="string", "required"=false, "description"="goal tags"},
     *     {"name"="level", "dataType"="integer", "required"=false, "description"="goal level"}
     *   }
     * )
     */
    public function postGoalsAction(Request $request)
    {
        $useCase = $this->get('app.use_case.add_goal');

        $name = $request->get('name');
        $description = $request->get('description');
        $icon = $request->get('icon');
        $level = $request->get('level');
        $tags = $request->get('tags');

        if (empty($name) || empty($description)) {
            throw new HttpException(400, 'Missing required parameters');
        }

        $command = new Command($name, $description);

        if (!empty($icon)) {
            $command->setIcon($icon);
        }
        if (!empty($level)) {
            $command->setLevel($level);
        }
        if (!empty($tags)) {
            $command->setTags($tags);
        }

        $useCase->execute($command, $this);

        return $this->handleView($this->view);
    }

    public function goalSuccessfullyAdded(Goal $goal)
    {
        $this->view = $this->view($goal);
    }
}
