<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\RefreshTokenTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="refresh_tokens")
 * @ORM\Entity(repositoryClass="App\Repository\RefreshTokenRepository")
 */
class RefreshToken implements RefreshTokenEntityInterface
{
    use RefreshTokenTrait, EntityTrait;

    /**
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $identifier;

    /**
     * @ORM\ManyToOne(targetEntity="AccessToken")
     * @ORM\JoinColumn(name="access_token_id")
     */
    protected $accessToken;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $revoked;

    /**
     * @ORM\Column(type="datetime", name="expires_at")
     */
    protected $expiresAt;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;


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
     * Get the value of Revoked
     *
     * @return mixed
     */
    public function getRevoked()
    {
        return $this->revoked;
    }

    /**
     * Set the value of Revoked
     *
     * @param mixed revoked
     *
     * @return self
     */
    public function setRevoked($revoked)
    {
        $this->revoked = $revoked;

        return $this;
    }

    /**
     * Get the value of Expires At
     *
     * @return mixed
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Set the value of Expires At
     *
     * @param mixed expiresAt
     *
     * @return self
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

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
