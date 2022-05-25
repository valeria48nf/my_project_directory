<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use http\QueryString;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

class AppFixtures extends Fixture
{
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'qa12345'
        );
        $user->setPassword($hashedPassword);
        $user->setEmail('QA@mail.ru');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $question= new Question();
        $question->setHeading('Заголовок');
        $question->setContent("Как сделать сайт Когда у тебя 24 ч и не знаешь с чего начать");
        $question->setDate(new \DateTime());
        $question->setCategory('web');
        $manager->persist($question);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
