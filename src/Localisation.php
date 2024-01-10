<?php
// src/Localisation.php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'localisations')]
class Localisation
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $short_lib;
    #[ORM\Column(type: 'string')]
    private string $long_lib;
    
    public function __toString() {
        return $this->getShortLib();
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
     * @return Localisation
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
     * @return Localisation
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
}
