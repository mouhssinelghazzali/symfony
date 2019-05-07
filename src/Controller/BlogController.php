<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Entity\Comment;


class BlogController extends AbstractController
{

    
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/{id}/edit", name="blog_edit")
     */

    public function form(Article $article =null,Request $request,ObjectManager $manager)
    {
    
           // $article = new Article();
           
            if (!$article) {
                $article = new Article();
            }
            // $form = $this->createFormBuilder($article)
            //             ->add('title')
            //             ->add('content')
            //             ->add('image')
            //             ->getForm();

            $form = $this->createForm(ArticleType::class,$article);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                if (!$article->getId()) {
                    $article->setCreatedAt(new \DateTime());
                }
        
                $manager->persist($article);
                $manager->flush();

                return $this->redirectToRoute('blog_show',[
                    'id' => $article->getId()
                    ]);
            }


        return $this->render('blog/create.html.twig',[
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !==null,

        ]);

    }


    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article,Request $request,ObjectManager $manager)
    {   $comment = new Comment();
        $form = $this->createForm(CommentType::class,$comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                    ->setArticles($article);
            $manager->persist($comment);
            $manager->flush();

          return  $this->redirectToRoute('blog_show',['id' =>$article->getId()]);
            }
        return $this->render('blog/show.html.twig',[

            'article' => $article,
            'commentForm' => $form->createView()
        ]);

    }

}
