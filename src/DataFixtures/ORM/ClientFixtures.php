<?php

namespace App\DataFixtures\ORM;

use App\Entity\Client;
use App\Utility\Slugger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ClientFixtures extends Fixture
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
        $name = isset($item['name']) ? $item['name'] : '';
        $identifier = isset($item['identifier']) ? $item['identifier'] : '';
        $secret = isset($item['secret']) ? $item['secret'] : '';
        $redirectUri = isset($item['redirectUri']) ? $item['redirectUri'] : '';
        $status = isset($item['status']) ? $item['status'] : '';

        $instance = new Client();
        $instance->setName($name);
        $instance->setIdentifier($identifier);
        $instance->setSecret($secret);
        $instance->setRedirectUri($redirectUri);
        $instance->setStatus($status);
        $instance->setCreatedAt(new \DateTime);
        $instance->setUpdatedAt(new \DateTime);

        $this->entityManager->persist($instance);
        $this->entityManager->flush();

        $slug = Slugger::slugify($name);
        $this->addReference($slug, $instance);
    }

    private function getData()
    {
        $data = file_get_contents(__DIR__.'/data/clients.json');
        return json_decode($data, true);
    }
}
