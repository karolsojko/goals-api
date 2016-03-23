<?php

namespace Domain\UseCase;

use Domain\Repository\GoalsRepository;
use Domain\UseCase\ListGoals\Command;
use Domain\UseCase\ListGoals\Responder;
use Domain\Model\Goal;

class ListGoals
{
    private $goalsRepository;

    public function __construct(GoalsRepository $goalsRepository)
    {
        $this->goalsRepository = $goalsRepository;
    }

    public function execute(Command $command, Responder $responder)
    {
        $goals = $this->goalsRepository->findAll();

        $responder->goalsSuccessfullyRetrieved($goals);
    }
}
