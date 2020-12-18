<?php

namespace App\Controller;

use App\Entity\Testimony;
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
}
