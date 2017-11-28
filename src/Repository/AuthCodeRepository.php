<?php

namespace App\Repository;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use App\Entity\AuthCode;

class AuthCodeRepository implements AuthCodeRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function persistNewAuthCode(AuthCodeEntityInterface $authCode)
    {
        // persist the auth code to a database
        $em = $this->getEntityManager();

        $user = $em->getRepository(User::class)
                   ->getUserEntityByUserIdentifier($accessTokenEntity->getUserIdentifier());

        $authCode = new AuthCode();
        $authCode->setIdentifier($authCodeEntity->getIdentifier());
        $authCode->setUser($user);
        $authCode->setClient($authCodeEntity->getClient());
        $authCode->setScopes($authCodeEntity->getScopes());
        $authCode->setRevoked(false);
        $authCode->setExpiresAt($authCodeEntity->getExpiryDateTime());
        $authCode->setCreatedAt(new \DateTime);
        $authCode->setUpdatedAt(new \DateTime);

        $em->persist($authCode);
        $em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function revokeAuthCode($codeId)
    {
        // revoke the auth code in a database
        $em = $this->getEntityManager();

        $authCode = $em->getRepository(AuthCode::class)
                       ->findOneByIdentifier($codeId);
        $authCode->setRevoked(true);
        $authCode->setUpdatedAt(new \DateTime);

        $em->persist($authCode);
        $em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function isAuthCodeRevoked($codeId)
    {
        $em = $this->getEntityManager();

        $authCode = $em->getRepository(AuthCode::class)
                       ->findOneByIdentifier($codeId);
        if ($authCode) {
          return $authCode->getRevoked();
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewAuthCode()
    {
        return new AuthCode();
    }
}
