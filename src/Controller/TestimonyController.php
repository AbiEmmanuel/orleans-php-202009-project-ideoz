<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use App\Entity\Testimony;
use App\Form\TestimonyType;
use App\Repository\TestimonyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestimonyController
 * @package App\Controller
 * @Route ("/testimonies", name="testimony_")
 */
class TestimonyController extends AbstractController
{
    /**
     * @Route ("/", name="index")
     * @param TestimonyRepository $testimonyRepository
     * @param CompanyRepository $companyRepository
     * @return Response
     */
    public function index(TestimonyRepository $testimonyRepository, CompanyRepository $companyRepository): Response
    {
        return $this->render('testimonies/testimonies.html.twig', [
            'testimonies' => $testimonyRepository->findAll(),
            'informations' => $companyRepository->findAll()

        ]);
    }

   /**
    * @Route("/admin", name="admin_index", methods={"GET"})
    * @param TestimonyRepository $testimonyRepository
    * @return Response
    */
    public function adminIndex(TestimonyRepository $testimonyRepository): Response
    {
        return $this->render('adminTestimony/index.html.twig', [
        'testimonies' => $testimonyRepository->findAll(),
        ]);
    }

   /**
    * @Route("/admin/{id}", name="admin_delete", methods={"DELETE"})
    * @param Request $request
    * @param Testimony $testimony
    * @return Response
    */
    public function delete(Request $request, Testimony $testimony): Response
    {
        if ($this->isCsrfTokenValid('delete' . $testimony->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($testimony);
            $entityManager->flush();
        }

        return $this->redirectToRoute('testimony_admin_index');
    }

    /**
     * @Route("/admin/new", name="admin_testimony_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $testimony = new Testimony();
        $form = $this->createForm(TestimonyType::class, $testimony);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($testimony);
            $entityManager->flush();

            return $this->redirectToRoute('admin_testimony_index');
        }

        return $this->render('adminTestimony/new.html.twig', [
            'testimony' => $testimony,
            'form' => $form->createView(),
          ]);
    }

   /**
    * @Route("/admin/{id}/edit", name="admin_edit", methods={"GET","POST"})
    * @param Request $request
    * @param Testimony $testimony
    * @return Response
    */
    public function edit(Request $request, Testimony $testimony): Response
    {
        $form = $this->createForm(TestimonyType::class, $testimony);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_testimony_index');
        }

        return $this->render('adminTestimony/edit.html.twig', [
            'testimony' => $testimony,
            'form' => $form->createView(),
        ]);
    }
}
