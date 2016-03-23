<?php

namespace spec\Domain\UseCase;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Repository\GoalsRepository;
use Domain\Model\Goal;
use Domain\UseCase\ListGoals\Responder;
use Domain\UseCase\ListGoals\Command;

class ListGoalsSpec extends ObjectBehavior
{
    function let(GoalsRepository $goalsRepository)
    {
        $this->beConstructedWith($goalsRepository);
    }

    function it_should_list_goals_and_notify_the_responder(
        GoalsRepository $goalsRepository,
        Responder $responder
    ) {
        $goalsRepository
            ->findAll()
            ->willReturn($goals = ['PHP Master']);

        $responder
            ->goalsSuccessfullyRetrieved($goals)
            ->shouldBeCalled();

        $this->execute(new Command(), $responder);
    }
}
