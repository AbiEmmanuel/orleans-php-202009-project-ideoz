<?php

namespace App\Controller;

use App\Repository\EcosystemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cooperative", name="cooperative_")
 */
class CooperativeController extends AbstractController
{
    /**
     * @Route("/companies", name="companies")
     * @param EcosystemRepository $ecosystemRepository
     * @return Response
     */
    public function showAllCompanies(EcosystemRepository $ecosystemRepository): Response
    {

        return $this->render('cooperative/companies.html.twig', [
            'companies' => $ecosystemRepository->findAll(),
        ]);
    }
}
