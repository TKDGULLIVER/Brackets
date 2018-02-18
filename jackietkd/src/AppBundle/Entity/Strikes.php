<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Strikes
 *
 * @ORM\Table(name="strikes", indexes={@ORM\Index(name="idx_match_id", columns={"MatchId"})})
 * @ORM\Entity
 */
class Strikes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FighterId", type="integer", nullable=false)
     */
    private $fighterid;

    /**
     * @var integer
     *
     * @ORM\Column(name="PointValue", type="smallint", nullable=false)
     */
    private $pointvalue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Timestamp", type="datetime", nullable=false)
     */
    private $timestamp = 'CURRENT_TIMESTAMP(3)';

    /**
     * @var integer
     *
     * @ORM\Column(name="Round", type="smallint", nullable=false)
     */
    private $round;

    /**
     * @var integer
     *
     * @ORM\Column(name="StrikeId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Matches
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Matches")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MatchId", referencedColumnName="MatchId")
     * })
     */
    private $matchid;



    /**
     * Set fighterid
     *
     * @param integer $fighterid
     *
     * @return Strikes
     */
    public function setFighterid($fighterid)
    {
        $this->fighterid = $fighterid;

        return $this;
    }

    /**
     * Get fighterid
     *
     * @return integer
     */
    public function getFighterid()
    {
        return $this->fighterid;
    }

    /**
     * Set pointvalue
     *
     * @param integer $pointvalue
     *
     * @return Strikes
     */
    public function setPointvalue($pointvalue)
    {
        $this->pointvalue = $pointvalue;

        return $this;
    }

    /**
     * Get pointvalue
     *
     * @return integer
     */
    public function getPointvalue()
    {
        return $this->pointvalue;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return Strikes
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set round
     *
     * @param integer $round
     *
     * @return Strikes
     */
    public function setRound($round)
    {
        $this->round = $round;

        return $this;
    }

    /**
     * Get round
     *
     * @return integer
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set matchid
     *
     * @param \AppBundle\Entity\Matches $matchid
     *
     * @return Strikes
     */
    public function setMatchid(\AppBundle\Entity\Matches $matchid = null)
    {
        $this->matchid = $matchid;

        return $this;
    }

    /**
     * Get matchid
     *
     * @return \AppBundle\Entity\Matches
     */
    public function getMatchid()
    {
        return $this->matchid;
    }
}
