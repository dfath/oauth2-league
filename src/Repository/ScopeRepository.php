<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use App\Entity\Scope;

class ScopeRepository extends EntityRepository implements ScopeRepositoryInterface
{

  /**
   * Determine if the given scope has been defined.
   *
   * @param  string  $id
   * @return bool
   */
    public function hasScope($scopeIdentifier)
    {
        $scopeRecord = $this->findOneByIdentifier($scopeIdentifier);
        return !empty($scopeRecord);
    }

    /**
     * {@inheritdoc}
     */
    public function getScopeEntityByIdentifier($scopeIdentifier)
    {

        if (!$this->hasScope($scopeIdentifier)) {
            return;
        }

        $scope = new Scope();
        $scope->setIdentifier($scopeIdentifier);

        return $scope;
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
