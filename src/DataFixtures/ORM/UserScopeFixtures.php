<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserScopeFixtures extends Fixture
{

    private $entityManager;

    public function load(ObjectManager $manager)
    {
        $this->entityManager = $manager;

        $data = $this->getData();
        foreach ($data as $key => $value) {
            $this->insert($value);
        }
    }

    private function insert(Array $item)
    {
        $user = isset($item['user']) ? $item['user'] : '';
        $scope = isset($item['scope']) ? $item['scope'] : '';

        $user = $this->getReference($user);
        $scope = $this->getReference($scope);

        $user->addScope($scope);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    private function getData()
    {
        $data = file_get_contents(__DIR__.'/data/user_scopes.json');
        return json_decode($data, true);
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            ScopeFixtures::class
        );
    }
}
