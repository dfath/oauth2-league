<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Tests\KernelTestBase;

class UserRepositoryTest extends KernelTestBase
{

    public function testGetUserEntityByUserIdentifier()
    {
        $user = $this->em
            ->getRepository(User::class)
            ->getUserEntityByUserIdentifier("badu@example.com");

        $this->assertObjectHasAttribute('email', $user);
    }

    public function testLoadUserByUsername()
    {
        $user = $this->em
            ->getRepository(User::class)
            ->loadUserByUsername("badu");

        $this->assertObjectHasAttribute('email', $user);
    }

}
