<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use App\Entity\AccessToken;
use App\Entity\User;

class AccessTokenRepository extends EntityRepository implements AccessTokenRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function persistNewAccessToken(AccessTokenEntityInterface $accessToken)
    {
        // save the access token to a database
        $em = $this->getEntityManager();

        $user = $em->getRepository(User::class)
                   ->getUserEntityByUserIdentifier($accessTokenEntity->getUserIdentifier());

        $accessToken = new AccessToken();
        $accessToken->setIdentifier($accessTokenEntity->getIdentifier());
        $accessToken->setClient($accessTokenEntity->getClient());
        $accessToken->setUser($user);
        $accessToken->setScopes($accessTokenEntity->getScopes());
        $accessToken->setRevoked(false);
        $accessToken->setType(AccessToken::BEARER);
        $accessToken->setExpiresAt($accessTokenEntity->getExpiryDateTime());
        $accessToken->setCreatedAt(new \DateTime);
        $accessToken->setUpdatedAt(new \DateTime);

        $em->persist($accessToken);
        $em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function revokeAccessToken($tokenId)
    {
        $em = $this->getEntityManager();
        // revoke the access token
        $accessToken = $this->findOneByIdentifier($tokenId);
        $accessToken->setRevoked(true);
        $accessToken->setUpdatedAt(new \DateTime);

        $em->persist($accessToken);
        $em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function isAccessTokenRevoked($tokenId)
    {
        $em = $this->getEntityManager();
        // Access token revoked status
        $accessToken = $this->findOneByIdentifier($tokenId);
        if ($accessToken) {
            return $accessToken->getRevoked();
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewToken(ClientEntityInterface $client, array $scopes, $userIdentifier = null)
    {
        $accessToken = new AccessToken();
        $accessToken->setClient($client);
        foreach ($scopes as $scope) {
            $accessToken->addScope($scope);
        }
        $accessToken->setUserIdentifier($userIdentifier);

        return $accessToken;
    }

}
