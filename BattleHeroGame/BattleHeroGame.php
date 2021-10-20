<?php

namespace BattleHeroGame;

class BattleHeroGame
{
    public string $winner;

    public function __construct()
    {
        $this->startGame();
    }

    //Set the game opening message
    private function startGame()
    {
        $message = "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\nxxxxxxxxxxxxxxxxxxxxxxxxx The Hero Game xxxxxxxxxxxxxxxxxxxxxxxx\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
        fwrite(STDOUT, $message . "\n\n");
    }

    //Finding the order of attacks
    private function getFigthersOrder(Orderus $orderus, Beast $beast): array
    {
        //Compare the speed of the fighters
        if($orderus->getSpeed() > $beast->getSpeed())
            return array($orderus, $beast);

        //If speed is equal, compare the luck of the fighters
        elseif($orderus->getSpeed() == $beast->getSpeed()){
            if($orderus->getLuck() > $beast->getLuck())
                return array($orderus, $beast);
        }

        return array($beast, $orderus);
    }

    //Carrying out the battle
    public function startBattle()
    {
        //Initiation of Orderus
        $orderus = new Orderus();
        $orderus->initStats();

        //Initiation of the Beast
        $beast = new Beast();
        $beast->initStats();

        //Get order of the fighters' attacks
        $fighters = $this->getFigthersOrder($orderus, $beast);

        //Print on screen the initial properties of the fighters
        fwrite(STDOUT, "~~~Initial properties:");
        $this->printStats($orderus, $beast);

        //Start the fight with a maximum of 20 turns
        for($number_round = 0; $number_round < 20; $number_round++){
            fwrite(STDOUT, "\n\n~~~TURN ". ($number_round + 1) .  ":\n");

            //The first fighter attack
            $fighters[0]->attack($fighters[1]);

            //Print on screen the properties of the fighters after the last attack
            $this->printStats($orderus, $beast);

            //Check if the game is over
            if($this->checkHealth($orderus, $beast)){
                fwrite(STDOUT, $this->winner . " is the winner!\nx_x GAME OVER x_x\n");
                break;
            }

            //The second fighter attack
            $fighters[1]->attack($fighters[0]);

            //Print on screen the properties of the fighters after the last attack
            $this->printStats($orderus, $beast);

            //Check if the game is over
            if($this->checkHealth($orderus, $beast)) {
                fwrite(STDOUT, $this->winner . " is the winner!\nx_x GAME OVER x_x\n");
                break;
            }

            //20 rounds have passed
            if($number_round == 19)
                fwrite(STDOUT, "The battle ended without a winner!\nx_x GAME OVER x_x\n");
        }
    }

    //Checking if one of the fighters lost his health and was defeated
    public function checkHealth(Orderus $orderus, Beast $beast): bool
    {
        //The beast win - Orderus lose
        if($orderus->getHealth() <= 0) {
            $this->winner = 'Beast';
            return true;
        }

        //Orderus win - The beast lose
        elseif ($beast->getHealth() <= 0) {
            $this->winner = 'Orderus';
            return true;
        }

        //The battle continues
        return false;
    }

    //Print the actual properties of the fighters
    private function printStats(Orderus $orderus, Beast $beast)
    {
        $message = "
                  HEALTH    STRENGTH    DEFENCE    SPEED    LUCK
        ORDERUS   " . $orderus->getHealth() . '        ' . $orderus->getStrength() . '          ' . $orderus->getDefence() . '         ' . $orderus->getSpeed() . '       ' . $orderus->getLuck()
        . "%\n        BEAST     " . $beast->getHealth() . '        ' . $beast->getStrength() . '          ' . $beast->getDefence() . '         ' . $beast->getSpeed() . '       ' . $beast->getLuck() . "%\n\n" ;
        fwrite(STDOUT, $message);
    }
}