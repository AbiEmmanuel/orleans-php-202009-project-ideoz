<?php

namespace App\Controller;

use App\Entity\Ecosystem;
use App\Entity\User;
use App\Repository\CompetenceRepository;
use App\Repository\EcosystemRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function workWithCompany(Ecosystem $ecosystem, MailerInterface $mailer): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $email = (new Email())
            ->from($user->getEmail())
            ->to($this->getParameter('mailer_admin'))
            ->subject($user->getUsername() . ' souhaite être mis en relation avec une entreprise')
            ->html($this->renderView('cooperative/companyEmail.html.twig', [
                'ecosystem' => $ecosystem
            ]));

        $mailer->send($email);
        $this->addFlash('success', 'Votre demande de mise en relation à bien été envoyée');

        return $this->redirectToRoute('cooperative_companies');
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
