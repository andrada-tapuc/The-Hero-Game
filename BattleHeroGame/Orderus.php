<?php

namespace BattleHeroGame;

class Orderus extends Fighter
{
    protected string $name = "Orderus";

    public int $health_min = 70;
    public int $health_max = 100;

    public int $strength_min = 70;
    public int $strength_max = 80;

    public int $defence_min = 45;
    public int $defence_max = 55;

    public int $speed_min = 40;
    public int $speed_max = 50;

    public int $luck_min = 10;
    public int $luck_max = 30;

}