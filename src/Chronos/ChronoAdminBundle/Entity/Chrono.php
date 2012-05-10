<?php

namespace Chronos\ChronoAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Chronos\ChronoAdminBundle\Repository\ChronoRepository")
 * @ORM\Table(name="chrono")
 */
class Chrono
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $time;

    /**
     * @ORM\Column(type="string")
     */
    protected $bike;

    /**
     * @ORM\Column(type="text")
     */
    protected $comment;

    /**
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @ORM\ManyToOne(targetEntity="Circuit", inversedBy="chronos", cascade={"all"})
     * @ORM\JoinColumn(name="circuit_id", referencedColumnName="id", onDelete="CASCADE", onUpdate="CASCADE" )
     */
    protected $circuit;

    /**
     * @ORM\ManyToOne(targetEntity="Weather", inversedBy="chronos", cascade={"all"})
     * @ORM\JoinColumn(name="weather_id", referencedColumnName="id", onDelete="CASCADE", onUpdate="CASCADE" )
     */
    protected $weather;

    /**
     * @ORM\ManyToOne(targetEntity="RoadState", inversedBy="chronos", cascade={"all"})
     * @ORM\JoinColumn(name="roadstate_id", referencedColumnName="id", onDelete="CASCADE", onUpdate="CASCADE" )
     */
    protected $roadstate;

    /**
     * @ORM\Column(type="string")
     */
    protected $user;

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
     * Set time
     *
     * @param integer $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * Get time
     *
     * @return integer
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set bike
     *
     * @param string $bike
     */
    public function setBike($bike)
    {
        $this->bike = $bike;
    }

    /**
     * Get bike
     *
     * @return string
     */
    public function getBike()
    {
        return $this->bike;
    }

    /**
     * Set comment
     *
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set date
     *
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set circuit
     *
     * @param Chronos\ChronoAdminBundle\Entity\Circuit $circuit
     */
    public function setCircuit(\Chronos\ChronoAdminBundle\Entity\Circuit $circuit)
    {
        $this->circuit = $circuit;
    }

    /**
     * Get circuit
     *
     * @return Chronos\ChronoAdminBundle\Entity\Circuit
     */
    public function getCircuit()
    {
        return $this->circuit;
    }

    /**
     * Set weather
     *
     * @param Chronos\ChronoAdminBundle\Entity\Weather $weather
     */
    public function setWeather(\Chronos\ChronoAdminBundle\Entity\Weather $weather)
    {
        $this->weather = $weather;
    }

    /**
     * Get weather
     *
     * @return Chronos\ChronoAdminBundle\Entity\Weather
     */
    public function getWeather()
    {
        return $this->weather;
    }

    /**
     * Set roadstate
     *
     * @param Chronos\ChronoAdminBundle\Entity\RoadState $roadstate
     */
    public function setRoadstate(\Chronos\ChronoAdminBundle\Entity\RoadState $roadstate)
    {
        $this->roadstate = $roadstate;
    }

    /**
     * Get roadstate
     *
     * @return Chronos\ChronoAdminBundle\Entity\RoadState
     */
    public function getRoadstate()
    {
        return $this->roadstate;
    }
}