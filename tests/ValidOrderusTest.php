<?php

use PHPUnit\Framework\TestCase;

class ValidOrderusTest extends TestCase
{
    /** @test */
    public function testValidLimitsHealth(){

        $fighter = new \BattleHeroGame\Orderus();
        $validation = $fighter->health_min < $fighter->health_max;

        $this->assertEquals(true, $validation);
    }

    /** @test */
    public function testValidLimitsStrength(){

        $fighter = new \BattleHeroGame\Orderus();
        $validation = $fighter->strength_min < $fighter->strength_max;

        $this->assertEquals(true, $validation);
    }

    /** @test */
    public function testValidLimitsDefence(){

        $fighter = new \BattleHeroGame\Orderus();
        $validation = $fighter->defence_min < $fighter->defence_max;

        $this->assertEquals(true, $validation);
    }

    /** @test */
    public function testValidLimitsSpeed(){

        $fighter = new \BattleHeroGame\Orderus();
        $validation = $fighter->speed_min < $fighter->speed_max;

        $this->assertEquals(true, $validation);
    }

    /** @test */
    public function testValidLimitsLuck(){

        $fighter = new \BattleHeroGame\Orderus();
        $validation = $fighter->luck_min < $fighter->luck_max;

        $this->assertEquals(true, $validation);
    }

    /** @test */
    public function testHealthNeverNegative(){
        $fighter = new \BattleHeroGame\Orderus();
        $health = $fighter->health;
        $damage = $health + 1;

        $fighter->lossHealth($damage);

        $this->assertEquals(0, $fighter->health);
    }

}