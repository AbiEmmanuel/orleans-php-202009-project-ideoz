<?php

namespace App\Controller;

use App\Repository\CompetenceRepository;
use App\Repository\EcosystemRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping\OrderBy;
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

    /**
     * @param ProjectRepository $projectRepository
     * @param CompetenceRepository $competenceRepository
     * @return Response
     * @Route ("/projects", name="projects")
     */
    public function showAllProjects(ProjectRepository $projectRepository, CompetenceRepository $competenceRepository)
    {
        return $this->render('cooperative/projects.html.twig', [
            'projects' => $projectRepository->findAll(),
            'competences' => $competenceRepository->findAll(),
        ]);
    }
}
