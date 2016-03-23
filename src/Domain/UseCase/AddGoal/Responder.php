<?php

namespace Domain\UseCase\AddGoal;

use Domain\Model\Goal;

interface Responder
{
    public function goalSuccessfullyAdded(Goal $goal);
}
