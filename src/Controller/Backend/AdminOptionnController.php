<?php

namespace App\Controller\Backend;

use App\Entity\Optionn;
use App\Form\OptionnType;
use App\Repository\OptionnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/optionn")
 */
class AdminOptionnController extends AbstractController
{
    /**
     * @Route("/", name="optionn_index", methods={"GET"})
     */
    public function index(OptionnRepository $optionnRepository): Response
    {
        return $this->render('optionn/index.html.twig', [
            'optionns' => $optionnRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="optionn_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $optionn = new Optionn();
        $form = $this->createForm(OptionnType::class, $optionn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($optionn);
            $entityManager->flush();

            return $this->redirectToRoute('optionn_index');
        }

        return $this->render('optionn/new.html.twig', [
            'optionn' => $optionn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="optionn_show", methods={"GET"})
     */
    public function show(Optionn $optionn): Response
    {
        return $this->render('optionn/show.html.twig', [
            'optionn' => $optionn,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="optionn_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Optionn $optionn): Response
    {
        $form = $this->createForm(OptionnType::class, $optionn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('optionn_index', [
                'id' => $optionn->getId(),
            ]);
        }

        return $this->render('optionn/edit.html.twig', [
            'optionn' => $optionn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="optionn_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Optionn $optionn): Response
    {
        if ($this->isCsrfTokenValid('delete'.$optionn->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($optionn);
            $entityManager->flush();
        }

        return $this->redirectToRoute('optionn_index');
    }
}
