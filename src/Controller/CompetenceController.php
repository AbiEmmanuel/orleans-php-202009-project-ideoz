<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/competences", name="admin_")
 */
class CompetenceController extends AbstractController
{
    /**
     * @Route("/", name="competence_index", methods={"GET"})
     * @param CompetenceRepository $competenceRepository
     * @return Response
     */
    public function index(CompetenceRepository $competenceRepository): Response
    {
        return $this->render('adminCompetence/index.html.twig', [
            'competences' => $competenceRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id<^[0-9]+$>}/edition", name="competence_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Competence $competence
     * @return Response
     */
    public function edit(Request $request, Competence $competence): Response
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Compétence mise à jour');
            return $this->redirectToRoute('admin_competence_index');
        }

        return $this->render('adminCompetence/edit.html.twig', [
            'competence' => $competence,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/ajout", name="competence_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($competence);
            $entityManager->flush();

            $this->addFlash('success', 'La compétence a bien été créé');

            return $this->redirectToRoute('admin_competence_index');
        }

        return $this->render('adminCompetence/new.html.twig', [
            'competence' => $competence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id<^[0-9]+$>}", name="competence_delete", methods={"DELETE"})
     * @param Request $request
     * @param Competence $competence
     * @return Response
     */
    public function delete(Request $request, Competence $competence): Response
    {
        if ($this->isCsrfTokenValid('delete' . $competence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($competence);
            $entityManager->flush();
        }

        $this->addFlash('danger', 'La compétence a bien été supprimée');

        return $this->redirectToRoute('admin_competence_index');
    }
}
