<?php

namespace App\Entity;

use App\Interfaces\PasswordProtectedInterface;
use App\Interfaces\UserInterface;

class User extends BaseEntity implements UserInterface, PasswordProtectedInterface
{
    private ?int $id = null;
    private ?string $username = null;
    private ?string $password = null;
    private ?string $email = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $gender = null;
    private array $roles = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return User
     */
    public function setGender(string $gender): User
    {
        $this->gender = $gender;
        return $this;
    }
    /**
     * Check if the password in bdd match with the password entered
     * 
     * @return bool
     */
    public function passwordMatch(string $plainPwd): bool
    {
        if (!password_verify($plainPwd, $this->getHashedPassword())) {
            return false;
        }
        return true;
    }
    /**
     * Get the value of hashed password
     * 
     * @return string
     */
    public function getHashedPassword(): string
    {
        return $this->password;
    }
    /**
     * Set the value of hashed password
     *
     * @param string
     * @return self
     */
    public function setHashedPassword($pwd): User
    {
        $this->password = password_hash($pwd, PASSWORD_DEFAULT);
        return $this;
    }

    /**
     * Get the value of roles
     * @return array $roles
     */
    public function getRoles()
    {
        $roles = $this->roles;
        return $roles;
    }

    /**
     * Set the value of roles
     * 
     * @param array
     * @return  self
     */
    public function setRoles(array|string $roles): User
    {
        if (is_string($roles)) {
            $this->roles = json_decode($roles, true);
        }
        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword(string $pwd): User
    {
        $this->password = $pwd;

        return $this;
    }
}
