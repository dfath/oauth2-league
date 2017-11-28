<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="scopes")
 * @ORM\Entity(repositoryClass="App\Repository\ScopeRepository")
 */
class Scope implements ScopeEntityInterface
{
    use EntityTrait;

    /**
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Grant", mappedBy="scopes")
     */
    protected $grants;

    /**
     * @ORM\ManyToMany(targetEntity="Client", mappedBy="scopes")
     */
    protected $clients;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="scopes")
     */
    protected $users;

    /**
     * @ORM\ManyToMany(targetEntity="AccessToken", mappedBy="scopes")
     */
    protected $accessTokens;

    /**
     * @ORM\ManyToMany(targetEntity="AuthCode", mappedBy="scopes")
     */
    protected $authCodes;

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

    public function jsonSerialize()
    {
        return $this->getIdentifier();
    }

    public function __construct()
    {
        $this->grants = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->accessTokens = new ArrayCollection();
        $this->authCodes = new ArrayCollection();
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
     * Get the value of Grants
     *
     * @return mixed
     */
    public function getGrants()
    {
        return $this->grants;
    }

    /**
     * Set the value of Grants
     *
     * @param mixed grants
     *
     * @return self
     */
    public function setGrants($grants)
    {
        $this->grants = $grants;

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
     * Get the value of Access Tokens
     *
     * @return mixed
     */
    public function getAccessTokens()
    {
        return $this->accessTokens;
    }

    /**
     * Set the value of Access Tokens
     *
     * @param mixed accessTokens
     *
     * @return self
     */
    public function setAccessTokens($accessTokens)
    {
        $this->accessTokens = $accessTokens;

        return $this;
    }

    /**
     * Get the value of Auth Codes
     *
     * @return mixed
     */
    public function getAuthCodes()
    {
        return $this->authCodes;
    }

    /**
     * Set the value of Auth Codes
     *
     * @param mixed authCodes
     *
     * @return self
     */
    public function setAuthCodes($authCodes)
    {
        $this->authCodes = $authCodes;

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
