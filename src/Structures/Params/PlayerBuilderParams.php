<?php

namespace OSM\Structures\Params;

use OSM\Interfaces\PlayerBuilderParamInterface;

class PlayerBuilderParams implements PlayerBuilderParamInterface
{
    /** @var string */
    public $position = '';

    /** @var int */
    public $skill = 0;

    /** @var int */
    public $age = 0;

    /** @var int */
    public $energy = 100;

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return int
     */
    public function getSkill(): int
    {
        return $this->skill;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getEnergy(): int
    {
        return $this->energy;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return uniqid();
    }
}
