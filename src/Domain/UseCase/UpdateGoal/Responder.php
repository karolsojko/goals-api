<?php

namespace Domain\UseCase\UpdateGoal;

use Domain\Model\Goal;

interface Responder
{
    public function goalNotFound($id);

    public function goalSuccessfullyUpdated(Goal $goal);
}
