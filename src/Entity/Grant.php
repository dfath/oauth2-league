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

}
