<?php

namespace Domain\Model;

use Ramsey\Uuid\Uuid;

class Goal
{
    private $id;
    private $name;
    private $description;
    private $level;

    public function __construct($name, $description, $level)
    {
        $uuid = Uuid::uuid4();
        $this->id = $uuid->toString();
        $this->name = $name;
        $this->description = $description;
        $this->level = $level;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
      return $this->description;
    }

    public function getLevel()
    {
      return $this->level;
    }
}
