<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use App\Entity\Scope;

class ScopeRepository extends EntityRepository implements ScopeRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function getScopeEntityByIdentifier($scopeIdentifier)
    {

        return $this->findOneByIdentifier($scopeIdentifier);

    }

    /**
     * {@inheritdoc}
     */
    public function finalizeScopes(
        array $scopes,
        $grantType,
        ClientEntityInterface $client,
        $userIdentifier = null
    ) {
        // TODO programatically modifying the final scope of the access token
        return $scopes;
    }
}
