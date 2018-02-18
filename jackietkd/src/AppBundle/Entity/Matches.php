<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matches
 *
 * @ORM\Table(name="matches", indexes={@ORM\Index(name="idx_station", columns={"StationId"}), @ORM\Index(name="idx_division", columns={"DivisionId"}), @ORM\Index(name="idx_red_fighter", columns={"RedFighterId"}), @ORM\Index(name="idx_blue_fighter", columns={"BlueFighterId"})})
 * @ORM\Entity
 */
class Matches
{
    /**
     * @var integer
     *
     * @ORM\Column(name="RedScore", type="smallint", nullable=false)
     */
    private $redscore;

    /**
     * @var integer
     *
     * @ORM\Column(name="BlueScore", type="smallint", nullable=false)
     */
    private $bluescore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="MatchStartTime", type="datetime", nullable=true)
     */
    private $matchstarttime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="MatchEndTime", type="datetime", nullable=true)
     */
    private $matchendtime;

    /**
     * @var integer
     *
     * @ORM\Column(name="CurrentRound", type="smallint", nullable=false)
     */
    private $currentround;

    /**
     * @var integer
     *
     * @ORM\Column(name="RemainingSeconds", type="integer", nullable=false)
     */
    private $remainingseconds;

    /**
     * @var boolean
     *
     * @ORM\Column(name="RoundInProgress", type="boolean", nullable=false)
     */
    private $roundinprogress;

    /**
     * @var integer
     *
     * @ORM\Column(name="MatchId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Stations
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Stations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="StationId", referencedColumnName="StationId")
     * })
     */
    private $stationid;

    /**
     * @var \AppBundle\Entity\Fighters
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fighters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RedFighterId", referencedColumnName="FighterId")
     * })
     */
    private $redfighterid;

    /**
     * @var \AppBundle\Entity\Divisions
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Divisions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DivisionId", referencedColumnName="DivisionId")
     * })
     */
    private $divisionid;

    /**
     * @var \AppBundle\Entity\Fighters
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Fighters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="BlueFighterId", referencedColumnName="FighterId")
     * })
     */
    private $bluefighterid;



    /**
     * Set redscore
     *
     * @param integer $redscore
     *
     * @return Matches
     */
    public function setRedscore($redscore)
    {
        $this->redscore = $redscore;

        return $this;
    }

    /**
     * Get redscore
     *
     * @return integer
     */
    public function getRedscore()
    {
        return $this->redscore;
    }

    /**
     * Set bluescore
     *
     * @param integer $bluescore
     *
     * @return Matches
     */
    public function setBluescore($bluescore)
    {
        $this->bluescore = $bluescore;

        return $this;
    }

    /**
     * Get bluescore
     *
     * @return integer
     */
    public function getBluescore()
    {
        return $this->bluescore;
    }

    /**
     * Set matchstarttime
     *
     * @param \DateTime $matchstarttime
     *
     * @return Matches
     */
    public function setMatchstarttime($matchstarttime)
    {
        $this->matchstarttime = $matchstarttime;

        return $this;
    }

    /**
     * Get matchstarttime
     *
     * @return \DateTime
     */
    public function getMatchstarttime()
    {
        return $this->matchstarttime;
    }

    /**
     * Set matchendtime
     *
     * @param \DateTime $matchendtime
     *
     * @return Matches
     */
    public function setMatchendtime($matchendtime)
    {
        $this->matchendtime = $matchendtime;

        return $this;
    }

    /**
     * Get matchendtime
     *
     * @return \DateTime
     */
    public function getMatchendtime()
    {
        return $this->matchendtime;
    }

    /**
     * Set currentround
     *
     * @param integer $currentround
     *
     * @return Matches
     */
    public function setCurrentround($currentround)
    {
        $this->currentround = $currentround;

        return $this;
    }

    /**
     * Get currentround
     *
     * @return integer
     */
    public function getCurrentround()
    {
        return $this->currentround;
    }

    /**
     * Set remainingseconds
     *
     * @param integer $remainingseconds
     *
     * @return Matches
     */
    public function setRemainingseconds($remainingseconds)
    {
        $this->remainingseconds = $remainingseconds;

        return $this;
    }

    /**
     * Get remainingseconds
     *
     * @return integer
     */
    public function getRemainingseconds()
    {
        return $this->remainingseconds;
    }

    /**
     * Set roundinprogress
     *
     * @param boolean $roundinprogress
     *
     * @return Matches
     */
    public function setRoundinprogress($roundinprogress)
    {
        $this->roundinprogress = $roundinprogress;

        return $this;
    }

    /**
     * Get roundinprogress
     *
     * @return boolean
     */
    public function getRoundinprogress()
    {
        return $this->roundinprogress;
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
     * Set stationid
     *
     * @param \AppBundle\Entity\Stations $stationid
     *
     * @return Matches
     */
    public function setStationid(\AppBundle\Entity\Stations $stationid = null)
    {
        $this->stationid = $stationid;

        return $this;
    }

    /**
     * Get stationid
     *
     * @return \AppBundle\Entity\Stations
     */
    public function getStationid()
    {
        return $this->stationid;
    }

    /**
     * Set redfighterid
     *
     * @param \AppBundle\Entity\Fighters $redfighterid
     *
     * @return Matches
     */
    public function setRedfighterid(\AppBundle\Entity\Fighters $redfighterid = null)
    {
        $this->redfighterid = $redfighterid;

        return $this;
    }

    /**
     * Get redfighterid
     *
     * @return \AppBundle\Entity\Fighters
     */
    public function getRedfighterid()
    {
        return $this->redfighterid;
    }

    /**
     * Set divisionid
     *
     * @param \AppBundle\Entity\Divisions $divisionid
     *
     * @return Matches
     */
    public function setDivisionid(\AppBundle\Entity\Divisions $divisionid = null)
    {
        $this->divisionid = $divisionid;

        return $this;
    }

    /**
     * Get divisionid
     *
     * @return \AppBundle\Entity\Divisions
     */
    public function getDivisionid()
    {
        return $this->divisionid;
    }

    /**
     * Set bluefighterid
     *
     * @param \AppBundle\Entity\Fighters $bluefighterid
     *
     * @return Matches
     */
    public function setBluefighterid(\AppBundle\Entity\Fighters $bluefighterid = null)
    {
        $this->bluefighterid = $bluefighterid;

        return $this;
    }

    /**
     * Get bluefighterid
     *
     * @return \AppBundle\Entity\Fighters
     */
    public function getBluefighterid()
    {
        return $this->bluefighterid;
    }
}
