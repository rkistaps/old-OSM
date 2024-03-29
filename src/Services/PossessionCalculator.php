<?php

namespace OSM\Services;

use OSM\Structures\Possession;
use OSM\Structures\Settings\PossessionCalculatorSettings;
use OSM\Structures\SquadStrength;

class PossessionCalculator
{
    /** @var PossessionCalculatorSettings */
    private $settings;

    /**
     * PossessionCalculator constructor.
     *
     * @param PossessionCalculatorSettings $settings
     */
    public function __construct(PossessionCalculatorSettings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Calculate ball possession
     *
     * @param SquadStrength $homeTeamStrength
     * @param SquadStrength $awayTeamStrength
     * @return Possession
     */
    public function calculate(SquadStrength $homeTeamStrength, SquadStrength $awayTeamStrength): Possession
    {
        $homeTeamMidStrength = $homeTeamStrength->midfield;
        $awayTeamMidStrength = $awayTeamStrength->midfield;

        $homeTeamK = $homeTeamMidStrength * 2 / $awayTeamMidStrength;
        $awayTeamK = $awayTeamMidStrength * 2 / $homeTeamMidStrength;

        $randomModifier = rand(100 - $this->settings->randomRange, 100 + $this->settings->randomRange) / 100;

        $homeTeamPossession = $homeTeamK / ($homeTeamK + $awayTeamK) * $randomModifier;
        $homeTeamPossession = $homeTeamPossession < 0.99 ? $homeTeamPossession : 0.99;

        $awayTeamPossession = 1 - $homeTeamPossession;

        $possession = new Possession();
        $possession->homeTeam = $homeTeamPossession;
        $possession->awayTeam = $awayTeamPossession;

        return $possession;
    }
}