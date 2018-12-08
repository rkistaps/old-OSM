<?php

namespace rkistaps\Engine\Structures;

class MatchSettings
{
    /** @var float */
    public $homeTeamBonus = 1.15;

    /** @var bool */
    public $hasHomeTeamBonus = true;

    /** @var float */
    public $coachSpecialityBonus = 1.15;

    /** @var float */
    public $coachLevelBonus = 1.05;

    /** @var float */
    public $defenseModifier = 3.5;

    /** @var float */
    public $midfieldModifier = 3.5;

    /** @var float */
    public $attackModifier = 2.5;

    /** @var float */
    public $performanceRandomRange = 0;
}