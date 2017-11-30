<?php

namespace App\Service;

use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\PasswordGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use App\Repository\AccessTokenRepository;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use App\Repository\RefreshTokenRepository;
use App\Repository\ScopeRepository;

/**
 *
 */
class OauthServer
{

    private $server;

    public function __construct(
        ClientRepository $clientRepository,
        AccessTokenRepository $accessTokenRepository,
        ScopeRepository $scopeRepository,
        UserRepository $userRepository,
        RefreshTokenRepository $refreshTokenRepository
    )
    {
        $privateKey = 'file://' . __DIR__ . '/../../private.key';

        $encryptionKey = 'lxZFUEsBCJ2Yb14IF2ygAHI5N4+ZAUXXaSeeJm6+twsUmIen';

        $this->server = new AuthorizationServer(
            $clientRepository,
            $accessTokenRepository,
            $scopeRepository,
            $privateKey,
            $encryptionKey
        );

        // Enable the password grant on the server with a token TTL of 1 hour
        $passwordGrant = new PasswordGrant(
            $userRepository,
            $refreshTokenRepository
        );

        $passwordGrant->setRefreshTokenTTL(new \DateInterval('P1M'));

        $this->server->enableGrantType(
            $passwordGrant,
            new \DateInterval('PT1H')
        );

        // Enable the refresh token grant on the server
        $refreshTokenGrant = new RefreshTokenGrant($refreshTokenRepository);
        $refreshTokenGrant->setRefreshTokenTTL(new \DateInterval('P1M'));

        $this->server->enableGrantType(
            $refreshTokenGrant,
            new \DateInterval('PT1H')
        );

    }

    public function getServer()
    {
        return $this->server;
    }
}
