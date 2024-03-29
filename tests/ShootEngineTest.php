<?php

declare(strict_types=1);

namespace Engine\Tests;

use DI\DependencyException;
use DI\NotFoundException;
use OSM\Services\ShootEngine;
use OSM\Exceptions\EngineException;
use OSM\Structures\Player;
use OSM\Structures\ShootConfig;
use OSM\Structures\ShootResult;

class ShootEngineTest extends TestBase
{
    /**
     * Generic shoot test
     *
     * @throws DependencyException
     * @throws NotFoundException
     * @throws EngineException
     */
    public function testShoot()
    {
        $config = new ShootConfig();
        $config->goalkeeper = $this->getStandardPlayer(Player::POS_G);
        $config->striker = $this->getStandardPlayer(Player::POS_F);

        $shootEngine = $this->container->get(ShootEngine::class);
        $result = $shootEngine->shoot($config);

        $this->assertInstanceOf(ShootResult::class, $result);
    }

    /**
     * Test goal
     *
     * @throws DependencyException
     * @throws EngineException
     * @throws NotFoundException
     */
    public function testGoal()
    {
        /** @var ShootConfig $config */
        $config = $this->container->make(ShootConfig::class);

        $config->goalkeeper = $this->getStandardPlayer(Player::POS_G, 100);
        $config->striker = $this->getStandardPlayer(Player::POS_F, 200);

        // no random in tests
        $config->randomModifier = 0;

        $shootEngine = $this->container->get(ShootEngine::class);
        $result = $shootEngine->shoot($config);

        $this->assertTrue($result->isGoal());
    }

    /**
     * Test save
     *
     * @throws DependencyException
     * @throws EngineException
     * @throws NotFoundException
     */
    public function testSave()
    {
        /** @var ShootConfig $config */
        $config = $this->container->make(ShootConfig::class);

        $config->goalkeeper = $this->getStandardPlayer(Player::POS_G, 200);
        $config->striker = $this->getStandardPlayer(Player::POS_F, 100);

        // no random in tests
        $config->randomModifier = 0;

        $shootEngine = $this->container->get(ShootEngine::class);
        $result = $shootEngine->shoot($config);

        $this->assertNotTrue($result->isGoal());
    }
}