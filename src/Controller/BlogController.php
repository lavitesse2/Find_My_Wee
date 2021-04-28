<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blog(): Response
    {
        return $this->render('blog/blog.html.twig');
    }
        /**
         * @Route("/",name="index")
         */
    public function index()
    {
        return $this->render('blog/index.html.twig');
    }
    /**
     * @Route("/inscription",name="inscription")
     */
    public function inscription ( Request $request)
    {       
        $article= new Article();

        $form =$this->createFormBuilder($article)
                    ->add('title')
                    ->add('n')
                    ->add('image')
                    ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $article->setCreatedAt(new \DateTime());

                $article=$form->getData();
                return $this->redirectToRoute('index'); 

        }

        return $this->render('inscription.html.twig', [

        'formarticle' => $form->createView()
        ]);
    }

    /**
     * @Route("/show",name="show")
     */
    public function show(){
        return $this->render('show.html.twig');
    }
}
