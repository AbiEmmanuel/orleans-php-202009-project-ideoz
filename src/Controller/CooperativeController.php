<?php

namespace App\Controller;

use App\Entity\EcosystemSearch;
use App\Form\EcosystemSearchType;
use App\Repository\CompetenceRepository;
use App\Repository\EcosystemRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @return Response
     */
    public function showAllCompanies(EcosystemRepository $ecosystemRepository, Request $request): Response
    {
        $ecosystemSearch = new EcosystemSearch();
        $form = $this->createForm(EcosystemSearchType::class, $ecosystemSearch);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $companies = $ecosystemRepository->findLikeName($ecosystemSearch);
        }

        return $this->render('cooperative/companies.html.twig', [
            'companies' => $companies ?? $ecosystemRepository->findAll(),
            'form' => $form->createView(),
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
