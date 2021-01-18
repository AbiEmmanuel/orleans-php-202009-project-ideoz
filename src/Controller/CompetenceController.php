<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/competence", name="admin_")
 */
class CompetenceController extends AbstractController
{
    /**
     * @Route("/", name="competence_index", methods={"GET"})
     * @param CompetenceRepository $competenceRepository
     * @return Response
     */
    public function index(CompetenceRepository $competenceRepository): Response
    {
        return $this->render('adminCompetence/index.html.twig', [
            'competences' => $competenceRepository->findAll(),
        ]);
    }
}
