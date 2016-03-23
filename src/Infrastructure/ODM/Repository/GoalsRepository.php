<?php

namespace Infrastructure\ODM\Repository;

use Doctrine\Common\Persistence\ObjectManager;
use Domain\Repository\GoalsRepository as GoalsRepositoryInterface;
use Domain\Model\Goal;

class GoalsRepository implements GoalsRepositoryInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function add(Goal $goal)
    {
        $this->manager->persist($goal);
        $this->manager->flush();
    }

    public function findAll()
    {
        return $this->manager->getRepository(Goal::class)->findBy([]);
    }

    public function find($id)
    {
        return $this->manager->getRepository(Goal::class)->find($id);
    }

    public function remove(Goal $goal)
    {
        $this->manager->remove($goal);
        $this->manager->flush();
    }
}
