<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StoreRepository")
 *
 * @Serializer\ExclusionPolicy("ALL")
 */
class Store extends AbstractEntity
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
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\Type("string")
     * @Assert\Length(max=100)
     *
     * @Serializer\Expose
     */
    private $label;

    public function getLabel()
    {
    	return $this->label;
    }

    public function setLabel($label)
    {
    	$this->label = $label;
    }
}
