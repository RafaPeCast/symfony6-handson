<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use App\Entity\MicroPost;
use Doctrine\Persistence\ObjectManager;

use function Symfony\Component\Clock\now;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('test@test.com');
        $user1->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user1,
                '12345678'
            )
        );
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('rafa@test.com');
        $user2->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user2,
                '12345678'
            )
        );
        $manager->persist($user2);


        $microPost1 = new MicroPost;
        $microPost1->setTitle('Welcome to Atexis!');
        $microPost1->setText('Welcome to Atexis again!');
        $microPost1->setCreated(new DateTime());
        $microPost1->setAuthor($user1);
        $manager->persist($microPost1);

        $microPost2 = new MicroPost;
        $microPost2->setTitle('Welcome to Spain!');
        $microPost2->setText('Welcome to Spain again!');
        $microPost2->setCreated(new DateTime());
        $microPost2->setAuthor($user1);
        $manager->persist($microPost2);

        $microPost3 = new MicroPost;
        $microPost3->setTitle('Welcome to Seville!');
        $microPost3->setText('Welcome to Seville again!');
        $microPost3->setCreated(new DateTime());
        $microPost3->setAuthor($user2);
        $manager->persist($microPost3);

        $manager->flush();
    }
}
