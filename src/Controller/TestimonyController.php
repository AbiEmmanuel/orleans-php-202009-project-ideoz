<?php

namespace App\Controller;

use App\Repository\TestimonyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Testimony;

/**
 * Class TestimonyController
 * @package App\Controller
 * @Route ("/testimonies", name="testimony_")
 */
class TestimonyController extends AbstractController
{
    /**
     * @Route ("/index", name="index")
     * @param TestimonyRepository $testimonyRepository
     * @return Response
     */
    public function index(TestimonyRepository $testimonyRepository): Response
    {
        return $this->render('testimonies/testimonies.html.twig', [
            'testimonies' => $testimonyRepository->findAll(),
        ]);
    }
}
