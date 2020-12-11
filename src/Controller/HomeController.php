<?php

namespace App\Controller;

use App\Entity\Testimony;
use App\Repository\TestimonyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param TestimonyRepository $testimonyRepository
     * @return Response
     */
    public function index(TestimonyRepository $testimonyRepository): Response
    {


        return $this->render('home/index.html.twig', [
            'testimonies' => $testimonyRepository->findBy([], ['id' => 'DESC'], 4)]);
    }
}
