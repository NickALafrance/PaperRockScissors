<?php

namespace PaperRockSissorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistics
 *
 * @ORM\Table(name="statistics")
 * @ORM\Entity(repositoryClass="PaperRockSissorsBundle\Repository\StatisticsRepository")
 */
class Statistics
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="humanFate", type="string", length=15)
     */
    private $humanFate;

    /**
     * @var string
     *
     * @ORM\Column(name="computerFate", type="string", length=15)
     */
    private $computerFate;

    /**
     * @var string
     *
     * @ORM\Column(name="outcome", type="string", length=4)
     */
    private $outcome;

    /**
     * @var int
     *
     * @ORM\Column(name="occurences", type="integer")
     */
    private $occurences;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set humanFate
     *
     * @param string $humanFate
     *
     * @return Statistics
     */
    public function setHumanFate($humanFate)
    {
        $this->humanFate = $humanFate;

        return $this;
    }

    /**
     * Get humanFate
     *
     * @return string
     */
    public function getHumanFate()
    {
        return $this->humanFate;
    }

    /**
     * Set computerFate
     *
     * @param string $computerFate
     *
     * @return Statistics
     */
    public function setComputerFate($computerFate)
    {
        $this->computerFate = $computerFate;

        return $this;
    }

    /**
     * Get computerFate
     *
     * @return string
     */
    public function getComputerFate()
    {
        return $this->computerFate;
    }

    /**
     * Set outcome
     *
     * @param string $outcome
     *
     * @return Statistics
     */
    public function setOutcome($outcome)
    {
        $this->outcome = $outcome;

        return $this;
    }

    /**
     * Get outcome
     *
     * @return string
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * Set occurences
     *
     * @param integer $occurences
     *
     * @return Statistics
     */
    public function setOccurences($occurences)
    {
        $this->occurences = $occurences;

        return $this;
    }

    /**
     * Get occurences
     *
     * @return int
     */
    public function getOccurences()
    {
        return $this->occurences;
    }
}

