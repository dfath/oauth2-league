<?php

namespace App\Controller;

use League\Event\EmitterAwareInterface;
use League\Event\EmitterAwareTrait;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\GrantTypeInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use League\OAuth2\Server\RequestTypes\AuthorizationRequest;
use League\OAuth2\Server\ResponseTypes\BearerTokenResponse;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use App\Service\OauthServer;

class OauthController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, OauthServer $oauthServer)
    {
        $response = new Response();
        $psr7Factory = new DiactorosFactory();
        $psrRequest = $psr7Factory->createRequest($request);
        $psrResponse = $psr7Factory->createResponse($response);

        $server = $oauthServer->getServer();
        // $server = $this->container->get('App\Service\OauthServer');

        $httpFoundationFactory = new HttpFoundationFactory();

        try {

            // Try to respond to the access token request
            $psrResponse = $server->respondToAccessTokenRequest($psrRequest, $psrResponse);

            return $httpFoundationFactory->createResponse($psrResponse);
        } catch (OAuthServerException $exception) {

            return new Response($exception->getMessage());
            // All instances of OAuthServerException can be converted to a PSR-7 response
            // dump($exception);
            // return $exception->generateHttpResponse($response);
        } catch (\Exception $exception) {

            // Catch unexpected exceptions
            // dump($exception);
            // $body = $response->getBody();
            return new Response($exception->getMessage());
            // $body->write($exception->getMessage());
            //
            // return $response->withStatus(500)->withBody($body);
        }

        return new Response('Hello');
    }
}
