<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

     /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Image
     */
    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

      /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->imageName;
        // to show the id of the Category in the select
        // return $this->id;
    }
}