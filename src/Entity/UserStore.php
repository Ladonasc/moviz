<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This entity represent a many-to-many relation with attribute (the role)
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserStoreRepository")
 */
class UserStore extends AbstractEntity
{
	const ROLE_OWNER = 1;

	const ROLE_CONTRIBUTOR = 2;

	const ROLE_READER = 3;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     *
     * @var integer
     */
    private $role;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\User")
	 * @ORM\JoinColumn(nullable=false)
	 *
	 * @var User
	 */
    private $user;

    /**
     *
     */
    /**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Store")
	 * @ORM\JoinColumn(nullable=false)
	 *
	 * @var Store
	 */
    private $store;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param integer $role
     *
     * @return self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param Store $store
     *
     * @return self
     */
    public function setStore(Store $store)
    {
        $this->store = $store;

        return $this;
    }
}
