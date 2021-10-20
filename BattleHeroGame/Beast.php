<?php

namespace BattleHeroGame;

class Beast extends Fighter
{
    protected string $name = "Beast";

    public int $health_min = 60;
    public int $health_max = 90;

    public int $strength_min = 60;
    public int $strength_max = 90;

    public int $defence_min = 40;
    public int $defence_max = 60;

    public int $speed_min = 40;
    public int $speed_max = 60;

    public int $luck_min = 25;
    public int $luck_max = 40;

}