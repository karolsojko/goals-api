<?php

namespace AppBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Domain\Model\Goal;

class LoadGoalData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $goalsData = $this->getGoalsData();

        foreach ($goalsData as $goalData) {
            $goal = new Goal($goalData->type, $goalData->task);
            if (isset($goalData->icon)) {
                $goal->setIcon($goalData->icon);
            }
            if (isset($goalData->level)) {
                $goal->setLevel($goalData->level);
            }

            $manager->persist($goal);
            $manager->flush();
        }
    }

    private function getGoalsData()
    {
        $goalsData = [];

        $rootDir = $this->container->getParameter('kernel.root_dir');
        if (file_exists($rootDir . '/../var/goals.json')) {
            $goalsData =
                json_decode(file_get_contents($rootDir . '/../var/goals.json'));
        }

        return $goalsData;
    }
}
