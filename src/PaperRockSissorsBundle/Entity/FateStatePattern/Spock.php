<?php
/**
 * Created by PhpStorm.
 * User: SNACKPC
 * Date: 4/6/2016
 * Time: 8:47 PM
 */

namespace PaperRockSissorsBundle\Entity\FateStatePattern;

//sub class for if our chosen state is SPOCK
class Spock extends FateState
{
    //Array of things lizard wins against
    private $winArray = array("rock", "scissors");

    //GIVES : name of the current fate.
    public function getFate()
    {
        return "spock";
    }
}
