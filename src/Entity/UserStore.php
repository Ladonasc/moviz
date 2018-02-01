<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This entity represent a many-to-many relation with attribute (the role)
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserStoreRepository")
 */
class UserStore extends AbstractEntity
{
    const ROLE_OWNER = 'ROLE_OWNER';

    const ROLE_CONTRIBUTOR = 'ROLE_CONTRIBUTOR';

    const ROLE_READER = 'ROLE_READER';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Assert\Type("integer")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\Choice(callback="getAllowedRoles")
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

    public function getAllowedRoles()
    {
        return [
            self::ROLE_READER,
            self::ROLE_CONTRIBUTOR,
            self::ROLE_OWNER
        ];
    }
}
