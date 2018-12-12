<?php

namespace Engine\Tests;

use DI\DependencyException;
use DI\NotFoundException;
use rkistaps\Engine\Classes\PossessionCalculator;
use rkistaps\Engine\Structures\FlatSquadStrengthModifier;
use rkistaps\Engine\Structures\Possession;
use rkistaps\Engine\Structures\SquadStrength;

class PossessionCalculatorTest extends TestBase
{
    /**
     * Generic test
     *
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function testGenericCalculator()
    {
        $calculator = $this->container->get(PossessionCalculator::class);
        $modifier = $this->container->get(FlatSquadStrengthModifier::class);

        $modifier->goalkeeperModifier = 1;
        $modifier->defenseModifier = 1;
        $modifier->midfieldModifier = 1;
        $modifier->attackModifier = 1;

        /** @var SquadStrength $homeTeamStr */
        $homeTeamStr = $this->container->make(SquadStrength::class);
        $homeTeamStr->applyModifier($modifier);

        /** @var SquadStrength $awayTeamStr */
        $awayTeamStr = $this->container->make(SquadStrength::class);
        $awayTeamStr->applyModifier($modifier);

        $possession = $calculator->calculate($homeTeamStr, $awayTeamStr);

        $this->assertInstanceOf(Possession::class, $possession);
    }
}