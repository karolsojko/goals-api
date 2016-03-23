<?php

namespace Domain\UseCase;

use Domain\Repository\GoalsRepository;
use Domain\UseCase\AddGoal\Command;
use Domain\UseCase\AddGoal\Responder;
use Domain\Model\Goal;

class AddGoal
{
    private $goalsRepository;

    public function __construct(GoalsRepository $goalsRepository)
    {
        $this->goalsRepository = $goalsRepository;
    }

    public function execute(Command $command, Responder $responder)
    {
        $goal = new Goal($command->getName(), $command->getDescription());
        $goal->setIcon($command->getIcon());
        $goal->setLevel($command->getLevel());

        $this->goalsRepository->add($goal);

        $responder->goalSuccessfullyAdded($goal);
    }
}
