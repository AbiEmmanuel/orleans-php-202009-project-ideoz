<?php

namespace App\Controller;

use App\Entity\Ecosystem;
use App\Entity\Project;
use App\Entity\User;
use App\Entity\EcosystemSearch;
use App\Form\EcosystemSearchType;
use App\Repository\CompetenceRepository;
use App\Repository\EcosystemRepository;
use App\Repository\ProjectRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/{id}", name="show", methods={"GET"})
     * @param Ecosystem $ecosystem
     * @return Response
     */
    public function showCompanie(Ecosystem $ecosystem): Response
    {
        return $this->render('cooperative/show_company.html.twig', [
            'company' => $ecosystem
        ]);
    }

    /**
     * @Route("/{id}/mise_en_relation", name="company_work")
     * @param Ecosystem $ecosystem
     * @param EcosystemRepository $ecosystemRepository
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function workWithCompany(
        Ecosystem $ecosystem,
        EcosystemRepository $ecosystemRepository,
        MailerInterface $mailer
    ): Response {
        /** @var User $user */
        $user = $this->getUser();
        $company = $ecosystemRepository->findOneBy(['user' => $user]);
        $email = (new Email())
            ->from($user->getEmail())
            ->to($this->getParameter('mailer_admin'))
            ->subject('Un membre souhaite être mis en relation avec une entreprise')
            ->html($this->renderView('cooperative/companyEmail.html.twig', [
                'ecosystem' => $ecosystem,
                'company' => $company
            ]));

        $mailer->send($email);
        $this->addFlash('success', 'Votre demande de mise en relation à bien été envoyée');

        return $this->redirectToRoute('cooperative_companies');
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
                'ecosystem' => $company
            ]));
        $mailer->send($email);
        $this->addFlash('success', 'Votre demande de participation a bien été enregistrée.');

        return $this->redirectToRoute('cooperative_project_sheet', [
            'id' => $project->getId(),
        ]);
    }
}
