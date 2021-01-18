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
}
