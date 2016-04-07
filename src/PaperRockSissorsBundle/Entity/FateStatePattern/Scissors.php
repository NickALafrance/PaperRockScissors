<?php
/**
 * Created by PhpStorm.
 * User: SNACKPC
 * Date: 4/6/2016
 * Time: 8:43 PM
 */

namespace PaperRockSissorsBundle\Entity\FateStatePattern;

//sub class for if our chosen state is SCISSORS
class Scissors extends FateState
{
    //Array of things rock wins against
    private $winArray = array("lizard", "paper");

    //GIVES : name of the current fate.
    public function getFate()
    {
        return "scissors";
    }
}
