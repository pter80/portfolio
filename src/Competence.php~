<?php
// src/Competence.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;



#[ORM\Entity]
#[ORM\Table(name: 'competences')]
class Competence
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $short_lib;
    #[ORM\Column(type: 'text')]
    private string $long_lib;
    #[ORM\Column(type: 'integer')]
    private int $ordre;
    
    #[ORM\ManyToMany(targetEntity: Realisation::class, mappedBy: 'competences')]
    #[ORM\JoinTable(name: 'syntheses')]
    private Collection $realisations;
    
    
    public function __construct()
    {
        $this->realisations = new ArrayCollection();
    }
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set shortLib.
     *
     * @param string $shortLib
     *
     * @return Competence
     */
    public function setShortLib($shortLib)
    {
        $this->short_lib = $shortLib;

        return $this;
    }

    /**
     * Get shortLib.
     *
     * @return string
     */
    public function getShortLib()
    {
        return $this->short_lib;
    }

    /**
     * Set longLib.
     *
     * @param string $longLib
     *
     * @return Competence
     */
    public function setLongLib($longLib)
    {
        $this->long_lib = $longLib;

        return $this;
    }

    /**
     * Get longLib.
     *
     * @return string
     */
    public function getLongLib()
    {
        return $this->long_lib;
    }

    /**
     * Add realisation.
     *
     * @param \Realisation $realisation
     *
     * @return Competence
     */
    public function addRealisation(\Realisation $realisation)
    {
        $this->realisations[] = $realisation;

        return $this;
    }

    /**
     * Remove realisation.
     *
     * @param \Realisation $realisation
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRealisation(\Realisation $realisation)
    {
        return $this->realisations->removeElement($realisation);
    }

    /**
     * Get realisations.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRealisations()
    {
        return $this->realisations;
    }

    /**
     * Set ordre.
     *
     * @param int $ordre
     *
     * @return Competence
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre.
     *
     * @return int
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
}
