<?php
/**
 * Created by PhpStorm.
 * User: SNACKPC
 * Date: 4/6/2016
 * Time: 8:45 PM
 */

namespace PaperRockSissorsBundle\Entity\FateStatePattern;

//sub class for if our chosen state is LIZARD
class Lizard extends FateState
{
    //Array of things lizard wins against
    public $winArray = array("spock", "paper");

    //GIVES : name of the current fate.
    public function getFate()
    {
        return "lizard";
    }
}
