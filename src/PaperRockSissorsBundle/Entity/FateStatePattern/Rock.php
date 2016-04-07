<?php
/**
 * Created by PhpStorm.
 * User: SNACKPC
 * Date: 4/6/2016
 * Time: 8:41 PM
 */

namespace PaperRockSissorsBundle\Entity\FateStatePattern;

//sub class for if our chosen state is ROCK
class Rock extends FateState
{
    //Array of things rock wins against
    public $winArray = array("lizard", "scissors");

    //GIVES : name of the current fate.
    public function getFate()
    {
        return "rock";
    }
}
