<?php
/**
 * Created by PhpStorm.
 * User: SNACKPC
 * Date: 4/6/2016
 * Time: 8:37 PM
 */

namespace PaperRockSissorsBundle\Entity\FateStatePattern;

//sub class for if our chosen state is PAPER
class Paper extends FateState
{
    //Array of things paper wins against
    public $winArray = array("rock", "spock");

    //GIVES : name of the current fate.
    public function getFate()
    {
        return "paper";
    }
}
