<?php

namespace App\Controller;

use App\Repository\EcosystemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     * @param EcosystemRepository $ecosystemRepository
     * @return Response
     */
    public function index(EcosystemRepository $ecosystemRepository): Response
    {
        return $this->render('admin/home/index.html.twig', [
            'members' => $ecosystemRepository->findBy(['isValidated' => false], ['id' => 'DESC'], 8),
        ]);
    }
}
