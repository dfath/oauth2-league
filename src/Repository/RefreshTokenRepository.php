<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use App\Entity\RefreshToken;
use App\Entity\AccessToken;

class RefreshTokenRepository extends EntityRepository implements RefreshTokenRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        // persist the refresh token in a database
        $em = $this->getEntityManager();

        $accessTokenId = $refreshTokenEntity->getAccessToken()->getIdentifier();
        $accessToken = $em->getRepository(AccessToken::class)
                          ->findOneByIdentifier($accessTokenId);

        $refreshToken = new RefreshToken();
        $refreshToken->setIdentifier($refreshTokenEntity->getIdentifier());
        $refreshToken->setAccessToken($accessToken);
        $refreshToken->setRevoked(false);
        $refreshToken->setExpiresAt($refreshTokenEntity->getExpiryDateTime());
        $refreshToken->setCreatedAt(new \DateTime);
        $refreshToken->setUpdatedAt(new \DateTime);

        $em->persist($refreshToken);
        $em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function revokeRefreshToken($tokenId)
    {
        $em = $this->getEntityManager();

        // revoke the refresh token in a database
        $refreshToken = $this->findOneByIdentifier($tokenId);
        $refreshToken->setRevoked(true);
        $refreshToken->setUpdatedAt(new \DateTime);

        $em->persist($refreshToken);
        $em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function isRefreshTokenRevoked($tokenId)
    {
        $refreshToken = $this->findOneByIdentifier($tokenId);

        if ($refreshToken) {
            return $refreshToken->getRevoked();
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewRefreshToken()
    {

        return new RefreshToken();
    }
}
