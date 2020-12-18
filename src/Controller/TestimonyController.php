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
