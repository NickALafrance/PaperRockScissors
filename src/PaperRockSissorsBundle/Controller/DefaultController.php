<?php

namespace PaperRockSissorsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use PaperRockSissorsBundle\Entity\FateStatePattern\Paper;
use PaperRockSissorsBundle\Entity\FateStatePattern\Rock;
use PaperRockSissorsBundle\Entity\FateStatePattern\Scissors;
use PaperRockSissorsBundle\Entity\FateStatePattern\Lizard;
use PaperRockSissorsBundle\Entity\FateStatePattern\Spock;
use Symfony\Component\HttpFoundation\Request;
use PaperRockSissorsBundle\Form\DefaultType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //Just forward us onto the outcome action with the default settings.
        return $this->redirectToRoute('paper_rock_sissors_outcome', array('human' => "CHOOSE", 'computer' => "CHOOSE", 'outcome' => "FATE"));
    }

    public function playAction($state)
    {
        //Lets start this by CHOOSING OUR FATE.
        $humanFate = $this->fateStateFactory($state);
        //Lets give our computer a randomly chosen state.
        $computerFate = $this->fateStateFactory("random");
        //Doesn't matter what fate we happened to choose, we don't really care at all so long as they can FIGHT!
        $outcome = $humanFate->fight($computerFate);

        //redirect to our increment controller
        return $this->redirectToRoute('statistics_increment', array('human' => $humanFate->getFate(), 'computer' => $computerFate->getFate(), 'outcome' => $outcome));
    }
    
    public function outcomeAction($human, $computer, $outcome, Request $request)
    {
        $fightForm = new DefaultType();
        $form = $this->createForm('PaperRockSissorsBundle\Form\DefaultType', $fightForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //If we have a POST back, forward the user onto the playAction
            return $this->redirectToRoute('paper_rock_sissors_play', array('state' => $fightForm->getChooseFate()));
        }


        //We played a game and the outcome is in!
        //Lets get our general win loss statistics
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        //Total the wins
        $qb->select('SUM(s.occurences)')
            ->from('PaperRockSissorsBundle:Statistics', 's')
            ->where('s.outcome = \'WIN\'');
        $statistics['winCount'] = $qb->getQuery()->getSingleResult()[1];

        //total the losses
        $qb->where('s.outcome = \'LOSS\'');
        $statistics['lossCount'] = $qb->getQuery()->getSingleResult()[1];

        //Lets now gather up the results from previous games into an array
        $granularStatistics['human'] = $this->getGranularStatisticsArray(true);
        $granularStatistics['computer'] = $this->getGranularStatisticsArray(false);

        //record what our current game is
        $currentGame = array(
            'humanFate' => $human,
            'computerFate' => $computer,
            'outcome' => $outcome
        );

        //and post results!
        return $this->render('PaperRockSissorsBundle:Default:index.html.twig', array(
            'quickStatistics' => $statistics,
            'granularStatistics' => $granularStatistics,
            'currentGame' => $currentGame,
            'form_view' => $form->createView()
        ));
    }

    //This will build an array which will retrieve all of the statistics from our database and arrange it into an array
    //This array will group fates and number of occurences first by all of the fates which have been chosen
    //then by win or loss
    //like so : humanFate.WIN.computerFate  This should make looping through this data set easy for twig to handle.
    //TAKES : true or false, depending on if you want this sorted by human win/losses or sorted by computer win/losses
    private function getGranularStatisticsArray($human)
    {
        //The bool sent in will decide if we want an array for the computer or an array for the human.
        $groupBy = "computerFate";
        $dontGroupBy = 'humanFate';
        //If you are a computer, a win IS a loss, and a loss is a win.
        $invertWinLoss = array('WIN' => 'LOSS', 'LOSS' => 'WIN');
        if($human) {
            $groupBy = 'humanFate';
            $dontGroupBy = "computerFate";
            //But if you are a human, a win is a win!
            $invertWinLoss = array('LOSS' => 'LOSS', 'WIN' => 'WIN');
        }

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        //We are going to separate our results into arrays by fate.  Lets get all our game records out of the table.
        $qb->select(array('s.humanFate', 's.computerFate', 's.outcome', 's.occurences'))
            ->from('PaperRockSissorsBundle:Statistics', 's')
            ->where('s.outcome != \'tie\'');

        $listOfGames = $qb->getQuery()->getArrayResult();
        $statistics = array();
        //By looping through all the rows in our database and storing them first by human chosen fates
        //and then by the outcome, we have a convenient way to print out granular statistics in twig.
        foreach ($listOfGames as $game) {
            $statistics[$game[$groupBy]][$invertWinLoss[$game['outcome']]][] = array(
                $dontGroupBy => $game[$dontGroupBy],
                'occurences' => $game['occurences']);
        }
        return $statistics;
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
