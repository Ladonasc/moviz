<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email already taken")
 *
 * @Serializer\ExclusionPolicy("ALL")
 */
class User extends AbstractEntity implements UserInterface, \Serializable
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
     * Will act like an username
     *
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\Length(max=255)
     *
     * @Serializer\Expose
     */
    private $email;

    /**
     * Not persisted in DB (there is no Column annotation)
     *
     * Exposed but since always empty when hydrated from db this property
     * is never serialized.
     * Only use during deserialization for create / update process
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Serializer\Expose
     */
    private $role;

    public function getId() {
    	return $this->id;
    }

    public function setUsername($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * Required by UserInterface
     */
    public function getUsername() {
        return $this->email;
    }

    /**
     * Used when hydrating object from a PUT request
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Used when hydrating object from a PUT request
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
        return $this;
    }

    /**
     * Required by UserInterface
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;

        // Ensure plain password is reset when crypted password is filled
        $this->setPlainPassword(null);

        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    public function getRole() {
        return $this->role;
    }

    /**
     * Required by UserInterface
     */
    public function getRoles() {
        return array($this->getRole());
    }

    /**
     * Required by UserInterface
     */
    public function getSalt() {
        return null; // We use bcrypt, salt is not necessary
    }

    /**
     * Required by UserInterface
     */
    public function eraseCredentials() {

    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
        ) = unserialize($serialized);
    }
}
