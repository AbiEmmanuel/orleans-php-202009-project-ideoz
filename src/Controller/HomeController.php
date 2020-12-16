<?php

namespace App\Controller;

use App\Entity\Testimony;
use App\Repository\TestimonyRepository;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param TestimonyRepository $testimonyRepository
     * @param OfferRepository $offerRepository
     * @return Response
     */
    public function index(TestimonyRepository $testimonyRepository, OfferRepository $offerRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'services' => $offerRepository->findAll(),
          'testimonies' => $testimonyRepository->findBy([], ['id' => 'DESC'], 4),
        ]);
    }
}
