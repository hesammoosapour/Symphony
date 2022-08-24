<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i=0 ; $i<10;$i++)
        {
            $microPost = new MicroPost();
            $microPost->setText('some random text'.rand(1,100));
            $microPost->setTime(new \DateTime('2021-03-15'));
            $manager->persist($microPost);
        }
        $manager->flush();
    }
}
