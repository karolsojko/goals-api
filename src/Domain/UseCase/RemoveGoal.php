<?php

namespace Domain\UseCase;

use Domain\Repository\GoalsRepository;
use Domain\UseCase\RemoveGoal\Command;
use Domain\UseCase\RemoveGoal\Responder;
use Domain\Model\Goal;

class RemoveGoal
{
    private $goalsRepository;

    public function __construct(GoalsRepository $goalsRepository)
    {
        $this->goalsRepository = $goalsRepository;
    }

    public function execute(Command $command, Responder $responder)
    {
        $goal = $this->goalsRepository->find($command->getId());
        if (empty($goal)) {
            $responder->goalNotFound($command->getId());
            return;
        }

        $this->goalsRepository->remove($goal);

        $responder->goalSuccessfullyRemoved($command->getId());
    }
}
