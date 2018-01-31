<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
 * @ORM\Table(indexes={@ORM\Index(name="search_idx", columns={"label"})})
 *
 * @Serializer\ExclusionPolicy("ALL")
 */
class Language extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Serializer\Expose
     *
     * @var integer
     */
    private $id;

    /**
     * Code ISO 639-1
     *
     * @ORM\Column(type="string", length=2)
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(max=2)
     *
     * @Serializer\Expose
     *
     * @var string
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(max=50)
     *
     * @Serializer\Expose
     *
     * @var string
     */
    private $label;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Assert\Type("boolean")
     * @Assert\NotNull
     *
     * @Serializer\Expose
     *
     * @var boolean
     */
    private $isActive;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return self
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     *
     * @return self
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }
}
