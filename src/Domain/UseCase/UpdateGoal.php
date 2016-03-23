<?php

namespace Domain\UseCase;

use Domain\Repository\GoalsRepository;
use Domain\UseCase\UpdateGoal\Command;
use Domain\UseCase\UpdateGoal\Responder;
use Domain\Model\Goal;

class UpdateGoal
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

        if ($name = $command->getName()) {
            $goal->setName($name);
        }
        if ($description = $command->getDescription()) {
            $goal->setDescription($description);
        }
        if ($icon = $command->getIcon()) {
            $goal->setIcon($icon);
        }
        if ($level = $command->getLevel()) {
            $goal->setLevel($level);
        }

        $this->goalsRepository->add($goal);

        $responder->goalSuccessfullyUpdated($goal);
    }
}
