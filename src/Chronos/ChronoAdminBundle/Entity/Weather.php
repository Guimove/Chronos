<?php

namespace Chronos\ChronoAdminBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="weather")
 */
class Weather
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Chrono", mappedBy="weather")
     */
    protected $chronos;

    public function __construct()
    {
        $this->chronos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Add chronos
     *
     * @param Chronos\ChronoAdminBundle\Entity\Chrono $chronos
     */
    public function addChrono(\Chronos\ChronoAdminBundle\Entity\Chrono $chronos)
    {
        $this->chronos[] = $chronos;
    }

    /**
     * Get chronos
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getChronos()
    {
        return $this->chronos;
    }

    public function __toString()
    {
        return $this->name;
    }
}