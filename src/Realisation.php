<?php
// src/Realisation.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity]
#[ORM\Table(name: 'realisations')]
class Realisation
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\ManyToOne(targetEntity: Localisation::class)]
    #[ORM\JoinColumn(name: 'localisation_id', referencedColumnName: 'id')]
    private Localisation|null $localisation = null;
    #[ORM\Column(type: 'string')]
    private string $lib;
    #[ORM\ManyToMany(targetEntity: Competence::class, inversedBy: 'realisations')]
    #[ORM\JoinTable(name: 'syntheses')]
    private Collection $competences;
    
    public function __construct()
    {
        $this->competences = new ArrayCollection();
        
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
     * Set lib.
     *
     * @param string $lib
     *
     * @return Realisation
     */
    public function setLib($lib)
    {
        $this->lib = $lib;

        return $this;
    }

    /**
     * Get lib.
     *
     * @return string
     */
    public function getLib()
    {
        return $this->lib;
    }

    /**
     * Set localisation.
     *
     * @param \Localisation|null $localisation
     *
     * @return Realisation
     */
    public function setLocalisation(\Localisation $localisation = null)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation.
     *
     * @return \Localisation|null
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Add competence.
     *
     * @param \Competence $competence
     *
     * @return Realisation
     */
    public function addCompetence(\Competence $competence)
    {
        $this->competences[] = $competence;

        return $this;
    }

    /**
     * Remove competence.
     *
     * @param \Competence $competence
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCompetence(\Competence $competence)
    {
        return $this->competences->removeElement($competence);
    }

    /**
     * Get competences.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetences()
    {
        return $this->competences;
    }
}
