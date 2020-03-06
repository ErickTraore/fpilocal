<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\File;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SmsbureauRepository")
 */
class Smsbureau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $messagesms;

   /**
     * @ORM\Column(name="datesms", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $datesms;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titresms;

    public function __construct()
    {
        $this->datesms = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessagesms(): ?string
    {
        return $this->messagesms;
    }

    public function setMessagesms(string $messagesms): self
    {
        $this->messagesms = $messagesms;

        return $this;
    }

    /**
     * Get datesms
     *
     * @return \DATETIME
     */
    public function getDatesms()
    {
        return $this->datesms;
    }

    public function setDatesms(\DATETIME $datesms)
    {
        $this->datesms = $datesms;
        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString(){
        return $this->getDatesms();
    }

    public function getTitresms(): ?string
    {
        return $this->titresms;
    }

    public function setTitresms(string $titresms): self
    {
        $this->titresms = $titresms;

        return $this;
    }
}
