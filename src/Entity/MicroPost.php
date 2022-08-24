<?php

namespace App\Entity;

use App\Repository\MicroPostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MicroPostRepository::class)
 * @ORM\Table()
 */
class MicroPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string" , length=280)
     * @Assert\NotBlank()
     * @Assert\Length(min=10,minMessage="THis is not enough")
    */
    private $text;

    /**
     * @ORM\Column(type="datetime")
    */
    private $time;

    /**
     * @ORM\Column(type="string" , name="asd" )
     */
    private $asd;

    /**
     * @return mixed
     */
    public function getAsd()
    {
        return $this->asd;
    }

    /**
     * @param mixed $asd
     */
    public function setAsd($asd): void
    {
        $this->asd = $asd;
    }


    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {
        $this->time = $time;
    }


    public function getId(): ?int
    {
        return $this->id;
    }
}
