<?php

namespace Chronos\ChronoAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="Chronos\ChronoAdminBundle\Repository\CircuitRepository")
 * @ORM\Table(name="circuit")
 * @ORM\HasLifecycleCallbacks
 */
class Circuit
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    protected $length;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank
     */
    protected $asso;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    protected $country;

    /**
     * @ORM\OneToMany(targetEntity="Chrono", mappedBy="circuit")
     */
    protected $chronos;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    private $fileName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;

    // a property used temporarily while deleting
    private $filenameForRemove;

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/images/';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            $this->fileName = md5($this->file->getClientOriginalName() . time());
            $this->path = $this->getUploadDir() . $this->fileName . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $this->file->move($this->getUploadRootDir(), $this->fileName . '.' . $this->file->guessExtension());

        unset($this->file);
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->filenameForRemove = $this->path;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->filenameForRemove) {
            unlink($this->filenameForRemove);
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->id . '.' . $this->path;
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
     * Set length
     *
     * @param integer $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * Get length
     *
     * @return integer
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function __construct()
    {
        $this->chronos = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set asso
     *
     * @param boolean $asso
     */
    public function setAsso($asso)
    {
        $this->asso = $asso;
    }

    /**
     * Get asso
     *
     * @return boolean 
     */
    public function getAsso()
    {
        return $this->asso;
    }
}