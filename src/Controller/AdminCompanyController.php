<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/company", name="admin_")
 */
class AdminCompanyController extends AbstractController
{
    /**
     * @Route("/", name="company_index", methods={"GET"})
     * @param CompanyRepository $companyRepository
     * @return Response
     */
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('adminCompany/index.html.twig', [
            'companies' => $companyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="company_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Company $company
     * @return Response
     */
    public function edit(Request $request, Company $company): Response
    {
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminCompany_index');
        }

        return $this->render('company/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }
}
