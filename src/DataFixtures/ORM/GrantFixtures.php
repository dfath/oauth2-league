<?php

namespace App\DataFixtures\ORM;

use App\Entity\Grant;
use App\Utility\Slugger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GrantFixtures extends Fixture
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
        $identifier = isset($item['identifier']) ? $item['identifier'] : '';
        $description = isset($item['description']) ? $item['description'] : '';

        $instance = new Grant();
        $instance->setIdentifier($identifier);
        $instance->setDescription($description);
        $instance->setCreatedAt(new \DateTime);
        $instance->setUpdatedAt(new \DateTime);

        $this->entityManager->persist($instance);
        $this->entityManager->flush();

        $slug = Slugger::slugify($identifier);
        $this->addReference($slug, $instance);
    }

    private function getData()
    {
        $data = file_get_contents(__DIR__.'/data/grants.json');
        return json_decode($data, true);
    }
}
