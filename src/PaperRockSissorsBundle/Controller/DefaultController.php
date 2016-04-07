<?php

namespace PaperRockSissorsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PaperRockSissorsBundle\Entity\FateStatePattern\Paper;
use PaperRockSissorsBundle\Entity\FateStatePattern\Rock;
use PaperRockSissorsBundle\Entity\FateStatePattern\Scissors;
use PaperRockSissorsBundle\Entity\FateStatePattern\Lizard;
use PaperRockSissorsBundle\Entity\FateStatePattern\Spock;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //return $this->render('PaperRockSissorsBundle:Default:index.html.twig');
    }

    public function playAction($state)
    {
        //Lets start this by CHOOSING OUR FATE.
        $humanFate = $this->fateStateFactory($state);
        //Lets give our computer a randomly chosen state.
        $computerFate = $this->fateStateFactory("random");
        //Doesn't matter what fate we happened to choose, we don't really care at all so long as they can FIGHT!
        $outcome = $humanFate->fight($computerFate);

        //Lets do a lil testing before we proceed
        $data = array(
            "human" => $humanFate->getFate(),
            "computer" => $computerFate->getFate(),
            "outcome" => $outcome
        );

        return $this->render('PaperRockSissorsBundle:Default:index.html.twig', array("data" => $data));
    }

    //This factory method will be in charge of generating fate states.
    //TAKES : The name of a fate class.
    //GIVES : The fate requested.  If the fate requested does not exist, you will receive a random fate.
    private function fateStateFactory($state)
    {
        switch ($state) {
            case "Paper":
                return new Paper();
            case "Rock":
                return new Rock();
            case "Scissors":
                return new Scissors();
            case "Lizard":
                return new Lizard();
            case "Spock":
                return new Spock();
            default:
                //If we do not recognize the current state coming, we are going to give back a random state instead.
                $possibleStates = array("Paper", "Rock", "Scissors", "Lizard", "Spock");
                return $this->fateStateFactory($possibleStates[rand(0, 4)]);
        }
    }
}
