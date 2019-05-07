<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Entity\Category;
use App\Entity\Comment;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('fr_FR');


        //FAKER CATEGORY 

        for($i=0;$i<3;$i++)
        {
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());

            $manager->persist($category);
        }


        for($j=0;$j< mt_rand(4,6);$j++)
        {
            $article = new Article();
            $content =  '<p>'. join($faker->paragraphs(5),'<p></p>').'</p>';

            $article->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($category);
                    $manager->persist($article);
                    
        }

        for($k=0;$k< mt_rand(4,10);$k++)
        {
            
            $content =  '<p>'. join($faker->paragraphs(2),'<p></p>').'</p>';
            $now = new \DateTime();
            $inteval =$now->diff($article->getCreatedAt());
            $days = $inteval->days;
            $minimum = '-'. $days . 'days';
            $comment = new Comment();
            $comment->setAuthor($faker->name())
                    ->setContent($content)
                    ->setCreatedAt($faker->dateTimeBetween($minimum))
                    ->setArticles($article);

                    $manager->persist($comment);

        }

        $manager->flush();
    }
}
