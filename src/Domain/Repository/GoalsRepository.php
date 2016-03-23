<?php

namespace Domain\Repository;

use Domain\Model\Goal;

interface GoalsRepository
{
    public function add(Goal $goal);

    public function find($id);

    public function remove(Goal $goal);

    public function findAll();
}
