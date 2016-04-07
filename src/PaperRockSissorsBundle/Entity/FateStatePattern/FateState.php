<?php
/**
 * Created by PhpStorm.
 * User: SNACKPC
 * Date: 4/6/2016
 * Time: 7:59 PM
 */

namespace PaperRockSissorsBundle\Entity\FateStatePattern;

//Parent class for an implementation of the state pattern!  paper rock scissors is a game that can be pretty easily
//described in several states
class FateState
{
    //The parent FATE will win against nothing.
    public $winArray = array();

    //this will match this fate state against an opposing fate state to determine a winner!
    //TAKES : another subclass of fateState
    //GIVES : "TIE", "WIN", or "LOSS", based on the outcome of the match.
    final public function fight($computerFate)
    {
        //First things first, if the names match, we have a tie
        if($this->getFate() == $computerFate->getFate()) {
            return "TIE";
        }
        //Each child of this class will have a Win Array.
        //If the name of the computer's chosen fate is found within this win array, human has won!
        if(in_array($computerFate->getFate() ,$this->getWinArray())) {
            return "WIN";
        }
        //Otherwise, we must have lost.
        return "LOSS";
    }
    //GIVES : name of the current fate.  For the top level class, it will just be the word FATE
    public function getFate()
    {
        return "FATE";
    }
    //GIVES : an array containing all of the other FATES that the current fate wins against.
    public function getWinArray()
    {
        return $this->winArray;
    }
}
