<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Article;
use App\Entity\Comment;
use DateTime;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {

        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');
        $user1 = new User();

        $user1->setEmail('user1@example.com');
        $user1->setFirstname($faker->firstName());
        $user1->setLastname($faker->lastName());
        $user1->setUsername($faker->userName());
        $password = $this->passwordHasher->hashPassword($user1, 'user1@example.com');
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setPassword($password);
        $user1->setPassword($faker->password());
        $user1->setAPropos($faker->word());
        $user1->setTelephone($faker->phoneNumber());

        $manager->persist($user1);

        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setUsername($faker->userName);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($faker->password());
            $user->setAPropos($faker->word());
            $user->setTelephone($faker->phoneNumber());
            $manager->persist($user);
            $users[] = $user;
        }
        //un utilisateur admin par defaut
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setFirstname('Admin');
        $admin->setLastname('Admin');
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $password = $this->passwordHasher->hashPassword($admin, 'admin');
        $admin->setPassword($password);
        $admin->setPassword($faker->password());
        $admin->setAPropos($faker->word());
        $admin->setTelephone($faker->phoneNumber());
        $users[] = $admin;

        // ...

        $categories = [];
        for ($i = 0; $i < 10; $i++) { // Créez 10 catégories fictives, vous pouvez ajuster le nombre selon vos besoins.
            $category = new Category();
            $category->setName($faker->word);
            $category->setDescription($faker->word);
            $category->setImage($faker->imageUrl()); // URL de l'image de la catégorie (vous pouvez ajuster cette partie si nécessaire)
            $manager->persist($category);
            $categories[] = $category;
        }
        $articles = [];
        for ($i = 0; $i < 100; $i++) {
            $article = new Article();
            $article->setTitle($faker->word);
            $article->setContent($faker->word);
            $article->setImage("https://i.dell.com/sites/csimages/App-Merchandizing_Images/all/laptop-category-latitude-14-9440-lf-rf-800x620.png");
            $article->setCategory($categories[$faker->numberBetween(0, 9)]);
            $article->setUser($users[$faker->numberBetween(0, 9)]);
            $manager->persist($article);
            $articles[] = $article;
        }



        $comments = [];
        for ($i = 0; $i < 9; $i++) { // Assurez-vous que la boucle se termine en incrémentant $i
            $comment = new Comment();
            $comment->setContent($faker->word);
            $comment->setUser($users[$faker->numberBetween(0, 9)]);
            // $comment->setCreatedAt(new DateTime());
            $comment->setArticle($articles[$faker->numberBetween(0, 14)]);
            $manager->persist($comment);
            $comments[] = $comment;
        }



        $manager->flush();
    }
}
