<?php

namespace App\Repository;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use App\Entity\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $grantType,
        ClientEntityInterface $client
    ) {
        $user = $this->getEntityManager()
                    ->getRepository(User::class)
                    ->findOneByUsername($username);

        return $user;
    }

    public function getUserEntityByUserIdentifier($identifier)
    {
        return $this->getEntityManager()
                    ->getRepository(User::class)
                    ->findOneByEmail($identifier);
    }
}
