<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStore", mappedBy="store")
     *
     * @Serializer\Expose
     */
    private $userStores;

    public function __construct()
    {
        $this->userStores = new ArrayCollection();
    }

    public function getLabel()
    {
    	return $this->label;
    }

    public function setLabel($label)
    {
    	$this->label = $label;
    }

    public function addUserStore(UserStore $userStore)
    {
        $this->userStores[] = $userStore;
        return $this;
    }

    public function removeUserStore(UserStore $userStore)
    {
        $this->userStores->removeElement($userStore);
        return $this;
    }

    public function getUserStores()
    {
        return $this->userStores;
    }
}
