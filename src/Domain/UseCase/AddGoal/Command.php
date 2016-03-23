<?php

namespace Domain\UseCase\AddGoal;

class Command
{
    private $name;
    private $description;
    private $icon;
    private $level;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getLevel()
    {
        return $this->level;
    }
}
