<?php

namespace App\Controller;

use App\Entity\Testimony;
use App\Repository\TestimonyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/testimony")
*/
class TestimonyController extends AbstractController
{
    /**
    * @Route("/admin", name="admin_testimony_index", methods={"GET"})
    * @param TestimonyRepository $testimonyRepository
    * @return Response
    */
    public function index(TestimonyRepository $testimonyRepository): Response
    {
        return $this->render('adminTestimony/index.html.twig', [
        'testimonies' => $testimonyRepository->findAll(),
        ]);
    }
}
