<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(indexes={@ORM\Index(name="search_idx", columns={"label"})})
 *
 * @Serializer\ExclusionPolicy("ALL")
 */
class Category extends AbstractEntity
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
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(max = 100)
     *
     * @Serializer\Expose
     *
     * @var string
     */
    private $label;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Assert\Type("integer")
     *
     * @var integer
     */
    private $tmdbId;

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
     * @return integer
     */
    public function getTmdbId()
    {
        return $this->tmdbId;
    }

    /**
     * @param integer $tmdbId
     *
     * @return self
     */
    public function setTmdbId($tmdbId)
    {
        $this->tmdbId = $tmdbId;

        return $this;
    }
}
