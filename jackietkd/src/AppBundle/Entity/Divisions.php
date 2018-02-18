<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Divisions
 *
 * @ORM\Table(name="divisions", indexes={@ORM\Index(name="idx_lower_rank", columns={"LowerRankId"}), @ORM\Index(name="idx_upper_rank", columns={"UpperRankId"})})
 * @ORM\Entity
 */
class Divisions
{
    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="NumRounds", type="smallint", nullable=false)
     */
    private $numrounds;

    /**
     * @var integer
     *
     * @ORM\Column(name="RoundDuration", type="integer", nullable=false)
     */
    private $roundduration;

    /**
     * @var integer
     *
     * @ORM\Column(name="BreakDuration", type="integer", nullable=false)
     */
    private $breakduration;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Gender", type="boolean", nullable=false)
     */
    private $gender;

    /**
     * @var integer
     *
     * @ORM\Column(name="LowerAge", type="smallint", nullable=false)
     */
    private $lowerage;

    /**
     * @var integer
     *
     * @ORM\Column(name="UpperAge", type="smallint", nullable=false)
     */
    private $upperage;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="LowerWeight", type="smallint", nullable=false)
     */
    private $lowerweight;

    /**
     * @var integer
     *
     * @ORM\Column(name="UpperWeight", type="smallint", nullable=false)
     */
    private $upperweight;

    /**
     * @var integer
     *
     * @ORM\Column(name="DivisionId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Ranks
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ranks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UpperRankId", referencedColumnName="RankId")
     * })
     */
    private $upperrankid;

    /**
     * @var \AppBundle\Entity\Ranks
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ranks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="LowerRankId", referencedColumnName="RankId")
     * })
     */
    private $lowerrankid;

	public function __toString()
	{
		return $this->name;
	}

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Divisions
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set numrounds
     *
     * @param integer $numrounds
     *
     * @return Divisions
     */
    public function setNumrounds($numrounds)
    {
        $this->numrounds = $numrounds;

        return $this;
    }

    /**
     * Get numrounds
     *
     * @return integer
     */
    public function getNumrounds()
    {
        return $this->numrounds;
    }

    /**
     * Set roundduration
     *
     * @param integer $roundduration
     *
     * @return Divisions
     */
    public function setRoundduration($roundduration)
    {
        $this->roundduration = $roundduration;

        return $this;
    }

    /**
     * Get roundduration
     *
     * @return integer
     */
    public function getRoundduration()
    {
        return $this->roundduration;
    }

    /**
     * Set breakduration
     *
     * @param integer $breakduration
     *
     * @return Divisions
     */
    public function setBreakduration($breakduration)
    {
        $this->breakduration = $breakduration;

        return $this;
    }

    /**
     * Get breakduration
     *
     * @return integer
     */
    public function getBreakduration()
    {
        return $this->breakduration;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     *
     * @return Divisions
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set lowerage
     *
     * @param integer $lowerage
     *
     * @return Divisions
     */
    public function setLowerage($lowerage)
    {
        $this->lowerage = $lowerage;

        return $this;
    }

    /**
     * Get lowerage
     *
     * @return integer
     */
    public function getLowerage()
    {
        return $this->lowerage;
    }

    /**
     * Set upperage
     *
     * @param integer $upperage
     *
     * @return Divisions
     */
    public function setUpperage($upperage)
    {
        $this->upperage = $upperage;

        return $this;
    }

    /**
     * Get upperage
     *
     * @return integer
     */
    public function getUpperage()
    {
        return $this->upperage;
    }
    
    /**
     * Set lowerweight
     *
     * @param integer $lowerweight
     *
     * @return Divisions
     */
    public function setLowerweight($lowerweight)
    {
        $this->lowerweight = $lowerweight;

        return $this;
    }

    /**
     * Get lowerweight
     *
     * @return integer
     */
    public function getLowerweight()
    {
        return $this->lowerweight;
    }

    /**
     * Set upperweight
     *
     * @param integer $upperweight
     *
     * @return Divisions
     */
    public function setUpperweight($upperweight)
    {
        $this->upperweight = $upperweight;

        return $this;
    }

    /**
     * Get upperweight
     *
     * @return integer
     */
    public function getUpperweight()
    {
        return $this->upperweight;
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
     * Set upperrankid
     *
     * @param \AppBundle\Entity\Ranks $upperrankid
     *
     * @return Divisions
     */
    public function setUpperrankid(\AppBundle\Entity\Ranks $upperrankid = null)
    {
        $this->upperrankid = $upperrankid;

        return $this;
    }

    /**
     * Get upperrankid
     *
     * @return \AppBundle\Entity\Ranks
     */
    public function getUpperrankid()
    {
        return $this->upperrankid;
    }

    /**
     * Set lowerrankid
     *
     * @param \AppBundle\Entity\Ranks $lowerrankid
     *
     * @return Divisions
     */
    public function setLowerrankid(\AppBundle\Entity\Ranks $lowerrankid = null)
    {
        $this->lowerrankid = $lowerrankid;

        return $this;
    }

    /**
     * Get lowerrankid
     *
     * @return \AppBundle\Entity\Ranks
     */
    public function getLowerrankid()
    {
        return $this->lowerrankid;
    }
}
