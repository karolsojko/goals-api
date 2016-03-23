<?php

namespace Domain\UseCase\ListGoals;

interface Responder
{
    public function goalsSuccessfullyRetrieved($goals);
}
