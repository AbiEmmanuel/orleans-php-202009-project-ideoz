<?php

namespace App\Controller;

use App\Entity\Testimony;
use App\Repository\EcosystemRepository;
use App\Repository\StatusRepository;
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
     * @param EcosystemRepository $ecosystemRepository
     * @return Response
     */

    public function index(
        TestimonyRepository $testimonyRepository,
        OfferRepository $offerRepository,
        EcosystemRepository $ecosystemRepository,
        StatusRepository $statusRepository
    ): Response {
        $client = $statusRepository->findOneBy(['name' => 'Client']);
        $partner = $statusRepository->findOneBy(['name' => 'Partenaire']);

        return $this->render('home/index.html.twig', [
            'services' => $offerRepository->findAll(),
            'testimonies' => $testimonyRepository->findBy([], ['id' => 'DESC'], 4),
            'clients' => $ecosystemRepository->findBy(['status' => $client], ['id' => 'ASC'], 10),
            'partners' => $ecosystemRepository->findBy(['status' => $partner], ['id' => 'ASC'], 10),
        ]);
    }
}
