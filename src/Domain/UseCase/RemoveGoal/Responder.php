<?php

namespace Domain\UseCase\RemoveGoal;

interface Responder
{
    public function goalSuccessfullyRemoved($id);

    public function goalNotFound($argument1);
}
