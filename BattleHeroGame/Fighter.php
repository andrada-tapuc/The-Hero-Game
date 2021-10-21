<?php

namespace BattleHeroGame;

abstract class Fighter
{
    protected string $name;

    public int $health;
    protected int $health_min;
    protected int $health_max;

    protected int $strength;
    protected int $strength_min;
    protected int $strength_max;

    protected int $defence;
    protected int $defence_min;
    protected int $defence_max;

    protected int $speed;
    protected int $speed_min;
    protected int $speed_max;

    protected int $luck;
    protected int $luck_min;
    protected int $luck_max;

    //Lucky turn (without damage)
    protected function luckyTurn(): bool
    {
        if(rand(0,100) <= $this->getLuck())
            return true;

        return false;
    }

    //Use skill - Rapid Strike (double attack)
    protected function useRapidStrike(): bool
    {
        //Just Orderus has the skill
        if($this->getName() != 'Orderus')
            return false;

        //10% chance to use the skill
        if(rand(0,100) < 10)
            return true;

        return false;
    }

    //Use skill - Magic shield (lose just half from health)
    protected function useMagicShield(): bool
    {
        //Just Orderus has the skill
        if($this->getName() != 'Orderus')
            return false;

        //20% chance to use the skill
        if(rand(0,100) < 20)
            return true;

        return false;
    }

    public function __construct()
    {
        $this->initStats();
    }

    //Initiation of the fighter's properties
    public function initStats(): Fighter
    {
        if($this->health_min > $this->health_max){
            fwrite(STDOUT, "The min health is bigger then the max health. Please add valid values.");
            exit(1);
        }
        if($this->strength_min > $this->strength_max){
            fwrite(STDOUT, "The min strength is bigger then the max strength. Please add valid values.");
            exit(1);
        }
        if($this->defence_min > $this->defence_max){
            fwrite(STDOUT, "The min defence is bigger then the max defence. Please add valid values.");
            exit(1);
        }
        if($this->speed_min > $this->speed_max){
            fwrite(STDOUT, "The min speed is bigger then the max speed. Please add valid values.");
            exit(1);
        }
        if($this->luck_min > $this->luck_max){
            fwrite(STDOUT, "The min luck is bigger then the max luck. Please add valid values.");
            exit(1);
        }

        $this->health = rand($this->health_min, $this->health_max);
        $this->strength = rand($this->strength_min, $this->strength_max);
        $this->defence = rand($this->defence_min, $this->defence_max);
        $this->speed = rand($this->speed_min, $this->speed_max);
        $this->luck = rand($this->luck_min, $this->luck_max);

        return $this;
    }

    //Get fighter's name
    public function getName(): string
    {
        return $this->name;
    }

    //Get fighter's health
    public function getHealth(): int
    {
        return $this->health;
    }

    //Get fighter's strength
    public function getStrength(): int
    {
        return $this->strength;
    }

    //Get fighter's defence
    public function getDefence(): int
    {
        return $this->defence;
    }

    //Get fighter's speed
    public function getSpeed(): int
    {
        return $this->speed;
    }

    //Get fighter's luck
    public function getLuck(): int {
        return $this->luck;
    }

    //Loss health in attack
    public function lossHealth($damage): Fighter
    {
        $this->health = $this->health - $damage;
        if($this->health < 0)
            $this->health = 0;

        return $this;
    }

    //Carrying out an attack
    public function attack(Fighter $enemy): bool
    {
        //Attack without damage - the enemy have a Lucky Turn and attacker miss the hit.
        if($enemy->luckyTurn()){
            fwrite(STDOUT, $this->getName() . " attack but miss the hit. " . $enemy->getName() . " has a Lucky Turn!\n");
            return true;
        }

        //Print on screen the attacker's name
        fwrite(STDOUT, $this->getName() . " attack!\n");

        //Calculate the damage of the enemy
        $damage = ($this->getStrength() > $enemy->getDefence()) ? ($this->getStrength() - $enemy->getDefence()) : 0;

        //The attacker is Orderus and use the Rapid Strike skill
        if($this->useRapidStrike()){

            //First attack
            fwrite(STDOUT, $this->getName() . " use Rapid Strike Skill!\n");
            $enemy->lossHealth($damage);
            fwrite(STDOUT, $enemy->getName() . " lose " . ($damage) . " health.\n");

            //The second attack
            fwrite(STDOUT, $this->getName() . " attack again!\n");
            $enemy->lossHealth($damage);
            fwrite(STDOUT, $enemy->getName() . " lose " . ($damage) . " health\n");

            return true;
        }

        //The attacker is Beast and Orderus use the Magic Shield skill
        if($enemy->useMagicShield()){
            fwrite(STDOUT, $enemy->getName() . " use Magic Shield Skill!\n");

            //Orderus lose just half of the damage
            $enemy->lossHealth($damage/2);
            fwrite(STDOUT, $enemy->getName() . " lose " . ($damage/2) . " health.\n");

            return true;
        }

        //Normal attack (without using any skill)
        $enemy->lossHealth($damage);
        fwrite(STDOUT, $enemy->getName() . " lose " . $damage . " health.\n");

        return true;
    }
}
