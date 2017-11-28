<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use App\Utility\Slugger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
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
        $username = isset($item['username']) ? $item['username'] : '';
        $email = isset($item['email']) ? $item['email'] : '';
        $password = isset($item['password']) ? $item['password'] : '';
        $status = isset($item['status']) ? $item['status'] : '';

        $instance = new User();
        $instance->setUsername($username);
        $instance->setEmail($email);
        $instance->setPassword($password);
        $instance->setStatus($status);
        $instance->setCreatedAt(new \DateTime);
        $instance->setUpdatedAt(new \DateTime);

        $this->entityManager->persist($instance);
        $this->entityManager->flush();

        $slug = Slugger::slugify($username);
        $this->addReference($slug, $instance);
    }

    private function getData()
    {
        $data = file_get_contents(__DIR__.'/data/users.json');
        return json_decode($data, true);
    }
}
