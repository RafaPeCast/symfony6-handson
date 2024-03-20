<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use function Symfony\Component\Clock\now;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $microPost1 = new MicroPost;
        $microPost1->setTitle('Welcome to Atexis!');
        $microPost1->setText('Welcome to Atexis again!');
        $microPost1->setCreated(new DateTime());
        $manager->persist($microPost1);

        $microPost2 = new MicroPost;
        $microPost2->setTitle('Welcome to Spain!');
        $microPost2->setText('Welcome to Spain again!');
        $microPost2->setCreated(new DateTime());
        $manager->persist($microPost2);

        $microPost3 = new MicroPost;
        $microPost3->setTitle('Welcome to Seville!');
        $microPost3->setText('Welcome to Seville again!');
        $microPost3->setCreated(new DateTime());
        $manager->persist($microPost3);

        $manager->flush();
    }
}
