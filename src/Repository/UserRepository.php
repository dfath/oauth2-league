<?php

namespace App\Repository;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;
use App\Entity\User;

class UserRepository extends EntityRepository implements UserRepositoryInterface, UserLoaderInterface
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
        $user = $this->loadUserByUsername($username);
        if (!$user) {
            return;
        }

        // Verifies that a password matches a hash BCrypt
        if (!password_verify($password, $user->getPassword())) {
            return;
        }

        $userEntity = new User();
        $userEntity->setIdentifier($user->getIdentifier());

        return $userEntity;
    }

    public function getUserEntityByUserIdentifier($identifier)
    {
        return $this->loadUserByUsername($identifier);
    }

    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
