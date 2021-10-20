<?php

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testGetWinnerBattle()
    {
        $orderus = new \BattleHeroGame\Orderus();
        $beast = new \BattleHeroGame\Beast();
        $battle = new \BattleHeroGame\BattleHeroGame();

        $beast->health = 0;
        $battle->checkHealth($orderus, $beast);

        $this->assertEquals("Orderus", $battle->winner);
    }

}