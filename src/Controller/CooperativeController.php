<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use App\Repository\CompetenceRepository;
use App\Repository\EcosystemRepository;
use App\Repository\ProjectRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace-cooz", name="cooperative_")
 */
class CooperativeController extends AbstractController
{
    /**
     * @Route("/entreprise", name="companies")
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
     * @Route ("/projet", name="projects")
     */
    public function showAllProjects(ProjectRepository $projectRepository, CompetenceRepository $competenceRepository)
    {
        return $this->render('cooperative/projects.html.twig', [
            'projects' => $projectRepository->findAll(),
            'competences' => $competenceRepository->findAll(),
        ]);
    }

    /**
     * @param Project $project
     * @return Response
     * @Route("/projet/{id<^[0-9]+$>}", name="project_sheet", methods={"GET"})
     */
    public function showProject(Project $project): Response
    {
        return $this->render('cooperative/projectSheet.html.twig', [
            'project' => $project,
        ]);
    }

    /**
     * @param Project $project
     * @param MailerInterface $mailer
     * @param EcosystemRepository $ecosystemRepository
     * @return Response
     * @throws TransportExceptionInterface
     * @Route("/projet/{id<^[0-9]+$>}/participer", name="project_participation", methods={"GET"})
     */
    public function participateProject(
        Project $project,
        MailerInterface $mailer,
        EcosystemRepository $ecosystemRepository
    ): Response {
        /** @var User $user */
        $user = $this->getUser();
        $company = $ecosystemRepository->findOneBy(['user' => $user]);
        $email = (new Email())
            ->from((string)$user->getEmail())
            ->to($this->getParameter('mailer_admin'))
            ->subject('Un membre souhaite participer à un projet')
            ->html($this->renderView('cooperative/projectEmail.html.twig', [
                'project' => $project,
                'ecosystem' => $company,
            ]));
        $mailer->send($email);

        $this->addFlash('success', 'Votre demande de participation a bien été enregistrée.');

        return $this->redirectToRoute('cooperative_project_sheet', [
            'id' => $project->getId(),
        ]);
    }
}
