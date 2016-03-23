<?php

namespace spec\Domain\UseCase;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Repository\GoalsRepository;
use Domain\Model\Goal;
use Domain\UseCase\RemoveGoal\Responder;
use Domain\UseCase\RemoveGoal\Command;

class RemoveGoalSpec extends ObjectBehavior
{
    function let(GoalsRepository $goalsRepository)
    {
        $this->beConstructedWith($goalsRepository);
    }

    function it_should_notify_the_responder_is_goal_was_not_found(
        GoalsRepository $goalsRepository,
        Responder $responder
    ) {
        $goalsRepository->find($id = '1')->willReturn(null);

        $responder->goalNotFound($id)->shouldBeCalled();

        $this->execute(new Command($id), $responder);
    }

    function it_should_remove_a_goal_and_notify_the_responder(
        GoalsRepository $goalsRepository,
        Responder $responder
    ) {
        $goalsRepository
            ->find($id = '1')
            ->willReturn(
                $goal = new Goal(
                    $name = 'PHP Master',
                    $description = 'Complete online PHP Course'
                )
            );

        $goalsRepository
            ->remove($goal)
            ->shouldBeCalled();

        $responder
            ->goalSuccessfullyRemoved($id)
            ->shouldBeCalled();

        $this->execute(new Command($id), $responder);
    }
}
