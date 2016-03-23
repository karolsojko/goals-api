<?php

namespace spec\Domain\UseCase;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Domain\Repository\GoalsRepository;
use Domain\Model\Goal;
use Domain\UseCase\AddGoal\Responder;
use Domain\UseCase\AddGoal\Command;

class AddGoalSpec extends ObjectBehavior
{
    function let(GoalsRepository $goalsRepository)
    {
        $this->beConstructedWith($goalsRepository);
    }

    function it_should_add_a_goal_and_notify_the_responder(
        GoalsRepository $goalsRepository,
        Responder $responder
    ) {
        $goalsRepository
            ->add(Argument::type(Goal::class))
            ->shouldBeCalled();

        $responder
            ->goalSuccessfullyAdded(Argument::type(Goal::class))
            ->shouldBeCalled();

        $this->execute(
            new Command(
                $name = 'PHP Master',
                $description = 'Complete online PHP Course'
            ),
            $responder
        );
    }
}
