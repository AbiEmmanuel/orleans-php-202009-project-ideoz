<?php

namespace App\Controller;

use App\Entity\Ecosystem;
use App\Form\EcosystemType;
use App\Repository\EcosystemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ecosystem", name="ecosystem_")
 */
class AdminEcosystemController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @param EcosystemRepository $ecosystemRepository
     * @return Response
     */
    public function index(EcosystemRepository $ecosystemRepository): Response
    {
        return $this->render('admin/ecosystem/index.html.twig', [
            'ecosystems' => $ecosystemRepository->findBy([], ['name' => 'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ecosystem = new Ecosystem();
        $form = $this->createForm(EcosystemType::class, $ecosystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ecosystem);
            $entityManager->flush();

            return $this->redirectToRoute('ecosystem_index');
        }

        return $this->render('admin/ecosystem/new.html.twig', [
            'ecosystem' => $ecosystem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @param Ecosystem $ecosystem
     * @return Response
     */
    public function show(Ecosystem $ecosystem): Response
    {
        return $this->render('admin/ecosystem/show.html.twig', [
            'ecosystem' => $ecosystem,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ecosystem $ecosystem): Response
    {
        $form = $this->createForm(EcosystemType::class, $ecosystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ecosystem_index');
        }

        return $this->render('admin/ecosystem/edit.html.twig', [
            'ecosystem' => $ecosystem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ecosystem $ecosystem): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ecosystem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ecosystem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ecosystem_index');
    }
}
