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
        $encoderFactory = $this->get('security.encoder_factory');
        $passwordEncoder = $encoderFactory->getEncoder($user);
        $isPasswordValid = $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());

        if (!$isPasswordValid) {
            return;
        }

        $userEntity = new User();
        $userEntity->setIdentifier($user->getIdentifier());

        return $userEntity;
    }

    public function getUserEntityByUserIdentifier($identifier)
    {
        return $this->findOneByEmail($identifier);
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
