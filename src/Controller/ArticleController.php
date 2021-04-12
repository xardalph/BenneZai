<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * \class ArticleController
 * \brief Contrôleur de l'entité Article avec CRUD.
 * @Route("/article")
 */

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article")
     * @param ArticleRepository $articleRepository
     * @param UserInterface|null $user
     * @return Response
     */
    public function index(ArticleRepository $articleRepository, ?UserInterface $user): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articleRepository->findAll(),
        ]);
    }


    /**
     * Crée un article.
     * @Route("/new", name="article_new", methods={"GET","POST"})
     * @param Request $request
     * @param UserInterface|null $user
     * @return Response
     */
    public function new(Request $request, ?UserInterface $user): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $article->setCreatedAt(new \DateTime());
            $article->setUpdatedAt(new \DateTime());
            //$article->setDisplay(1);

            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash('success', "L'article {$article->getTitle()} a bien été créé.");
            return $this->redirectToRoute('article');

        } else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', "L'article n'a pas pû être créé.");
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
            'user' => $user
        ]);
    }


    /**
     * Affiche un article.
     * @Route("/{id}", name="article_show", methods={"GET"})
     * @param Article $article
     * @param UserInterface|null $user
     * @return Response
     */
    public function show(Article $article, ?UserInterface $user): Response
    {
        if (!$article) {
            throw $this->createNotFoundException("Cet article n'existe pas");
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'user' => $user
        ]);
    }


    /**
     * Édite un article.
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Article $article
     * @param UserInterface|null $user
     * @return Response
     */
    public function edit(Request $request, Article $article, ?UserInterface $user): Response
    {
        if (!$article) {
            throw $this->createNotFoundException("Cet article n'existe pas");
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "L'article {$article->getTitle()} a bien été modifié.");
            return $this->redirectToRoute('article');
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * Supprime l'article'.
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function delete(Request $request, Article $article): Response
    {
        if (!$article) {
            throw $this->createNotFoundException("Cet article n'existe pas");
        }

        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $deletedRef = $article->getTitle();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
            $this->addFlash('success', "L'article {$deletedRef} a bien été supprimé.");
        }

        return $this->redirectToRoute('article');
    }
}
