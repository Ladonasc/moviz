<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 * @ORM\Table(indexes={@ORM\Index(name="search_idx", columns={"identity"})})
 *
 * @Serializer\ExclusionPolicy("ALL")
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Serializer\Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     *
     * @Serializer\Expose
     */
    private $identity;

    /**
     * Director === réalisateur
     *
     * @ORM\Column(type="boolean")
     *
     * @Assert\NotBlank()
     *
     * @Serializer\Expose
     */
    private $isDirector;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Assert\NotBlank()
     *
     * @Serializer\Expose
     */
    private $isActor;

    public function getId()
    {
        return $this->id;
    }

    public function getIdentity()
    {
        return $this->identity;
    }

    public function setIdentity($identity)
    {
        $this->identity = $identity;
        return $this;
    }

    public function getIsDirector()
    {
        return $this->isDirector;
    }

    public function setIsDirector($isDirector)
    {
        $this->isDirector = $isDirector;
        return $this;
    }

    public function getIsActor()
    {
        return $this->isActor;
    }

    public function setIsActor($isActor)
    {
        $this->isActor = $isActor;
        return $this;
    }
}
