<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="grants")
 * @ORM\Entity(repositoryClass="App\Repository\GrantRepository")
 */
class Grant
{
    /**
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Scope", inversedBy="grants")
     * @ORM\JoinTable(name="grant_scopes")
     */
    protected $scopes;

    /**
     * @ORM\ManyToMany(targetEntity="Client", mappedBy="grants")
     */
    protected $clients;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="grants")
     */
    protected $users;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $identifier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;

    public function __construct()
    {
        $this->scopes = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->users = new ArrayCollection();
    }


    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Scopes
     *
     * @return mixed
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * Set the value of Scopes
     *
     * @param mixed scopes
     *
     * @return self
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;

        return $this;
    }

    /**
     * Get the value of Clients
     *
     * @return mixed
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Set the value of Clients
     *
     * @param mixed clients
     *
     * @return self
     */
    public function setClients($clients)
    {
        $this->clients = $clients;

        return $this;
    }

    /**
     * Get the value of Users
     *
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set the value of Users
     *
     * @param mixed users
     *
     * @return self
     */
    public function setUsers($users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get the value of Identifier
     *
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set the value of Identifier
     *
     * @param mixed identifier
     *
     * @return self
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of Created At
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of Created At
     *
     * @param mixed createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of Updated At
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of Updated At
     *
     * @param mixed updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
