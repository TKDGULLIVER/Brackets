<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fighters
 *
 * @ORM\Table(name="fighters", indexes={@ORM\Index(name="idx_school_id", columns={"SchoolId"}), @ORM\Index(name="idx_rank", columns={"RankId"})})
 * @ORM\Entity
 */
class Fighters
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
     * @ORM\Column(name="Age", type="integer", nullable=false)
     */
    private $age;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="Weight", type="integer", nullable=false)
     */
    private $weight;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="Gender", type="boolean", nullable=false)
     */
    private $gender;

    /**
     * @var boolean
     *
     * @ORM\Column(name="CompetingInForms", type="boolean", nullable=false)
     */
    private $competinginforms;

    /**
     * @var boolean
     *
     * @ORM\Column(name="CompetingInSparring", type="boolean", nullable=false)
     */
    private $competinginsparring;

    /**
     * @var boolean
     *
     * @ORM\Column(name="CompetingInBreaking", type="boolean", nullable=false)
     */
    private $competinginbreaking;

    /**
     * @var integer
     *
     * @ORM\Column(name="FighterId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Schools
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Schools")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SchoolId", referencedColumnName="SchoolId")
     * })
     */
    private $schoolid;

    /**
     * @var \AppBundle\Entity\Ranks
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ranks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RankId", referencedColumnName="RankId")
     * })
     */
    private $rankid;
    
    /**
     * @var \AppBundle\Entity\Divisions
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Divisions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DivisionId", referencedColumnName="DivisionId")
     * })
     */
    private $divisionid;

	public function __toString()
	{
		return $this->name;
	}

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Fighters
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
     * Set age
     *
     * @param integer $age
     *
     * @return Fighters
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }
    
    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Fighters
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
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
     * Set competinginforms
     *
     * @param boolean $competinginforms
     *
     * @return Fighters
     */
    public function setCompetinginforms($competinginforms)
    {
        $this->competinginforms = $competinginforms;

        return $this;
    }

    /**
     * Get competinginforms
     *
     * @return boolean
     */
    public function getCompetinginforms()
    {
        return $this->competinginforms;
    }

    /**
     * Set competinginsparring
     *
     * @param boolean $competinginsparring
     *
     * @return Fighters
     */
    public function setCompetinginsparring($competinginsparring)
    {
        $this->competinginsparring = $competinginsparring;

        return $this;
    }

    /**
     * Get competinginsparring
     *
     * @return boolean
     */
    public function getCompetinginsparring()
    {
        return $this->competinginsparring;
    }

    /**
     * Set competinginbreaking
     *
     * @param boolean $competinginbreaking
     *
     * @return Fighters
     */
    public function setCompetinginbreaking($competinginbreaking)
    {
        $this->competinginbreaking = $competinginbreaking;

        return $this;
    }

    /**
     * Get competinginbreaking
     *
     * @return boolean
     */
    public function getCompetinginbreaking()
    {
        return $this->competinginbreaking;
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
     * Set schoolid
     *
     * @param \AppBundle\Entity\Schools $schoolid
     *
     * @return Fighters
     */
    public function setSchoolid(\AppBundle\Entity\Schools $schoolid = null)
    {
        $this->schoolid = $schoolid;

        return $this;
    }

    /**
     * Get schoolid
     *
     * @return \AppBundle\Entity\Schools
     */
    public function getSchoolid()
    {
        return $this->schoolid;
    }

    /**
     * Set rankid
     *
     * @param \AppBundle\Entity\Ranks $rankid
     *
     * @return Fighters
     */
    public function setRankid(\AppBundle\Entity\Ranks $rankid = null)
    {
        $this->rankid = $rankid;

        return $this;
    }

    /**
     * Get rankid
     *
     * @return \AppBundle\Entity\Ranks
     */
    public function getRankid()
    {
        return $this->rankid;
    }
}
