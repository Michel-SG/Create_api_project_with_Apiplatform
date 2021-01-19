<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for($i=0; $i< 10; $i++){
            $user = new User();
            $hash = $this->encoder->encodePassword($user, 'plainPassword');
            $user->setEmail($faker->email);
            $user->setUserName($faker->userName);
            $user->setPassword($hash);
            $manager->persist($user);

            for($j=0; $j< random_int(5,15); $j++){
                $article = new Article();
                $article->setTitle($faker->sentence());
                $article->setContent($faker->paragraph());
                $article->setUser($user);
                $manager->persist($article);
            }
        }
       

        $manager->flush();
    }
}
