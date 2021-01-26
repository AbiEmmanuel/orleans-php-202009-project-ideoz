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
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\StatusRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_MEMBER")
 * @Route("/espace-cooz", name="cooperative_")
 */
class CooperativeController extends AbstractController
{
    private const RESULT_PAGE = 16;
    /**
     * @Route("/entreprise", name="companies", methods={"GET","POST"})
     * @param EcosystemRepository $ecosystemRepository
     * @param Request $request
     * @param StatusRepository $statusRepository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function showAllCompanies(
        EcosystemRepository $ecosystemRepository,
        Request $request,
        StatusRepository $statusRepository,
        PaginatorInterface $paginator
    ): Response {
        $partner = $statusRepository->findOneBy(['name' => 'Partenaire']);
        $ecosystemSearch = new EcosystemSearch();
        $form = $this->createForm(EcosystemSearchType::class, $ecosystemSearch);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $companies = $ecosystemRepository->findLikeName($ecosystemSearch);
        } else {
            $companies = $ecosystemRepository->findBy(
                ['status' => $partner, 'isValidated' => true],
                ['name' => 'ASC']
            );
        }
        $companies = $paginator->paginate(
            $companies,
            $request->query->getInt('page', 1),
            self::RESULT_PAGE
        );
        return $this->render('cooperative/companies.html.twig', [
            'companies' => $companies,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("entreprise/{id<^[0-9]+$>}", name="show", methods={"GET"})
     * @param Ecosystem $ecosystem
     * @return Response
     */
    public function showCompany(Ecosystem $ecosystem): Response
    {
        return $this->render('cooperative/show_company.html.twig', [
            'company' => $ecosystem
        ]);
    }

    /**
     * @Route("entreprise/{id<^[0-9]+$>}/mise-en-relation", name="company_work")
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
     * @Route ("/projet", name="projects", methods={"GET"})
     */
    public function showAllProjects(
        ProjectRepository $projectRepository,
        CompetenceRepository $competenceRepository
    ): Response {
        return $this->render('cooperative/projects.html.twig', [
            'projects' => $projectRepository->findAll(),
            'competences' => $competenceRepository->findBy([], ['name' => 'ASC']),
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

        return $this->redirectToRoute('cooperative_projects', [
            'id' => $project->getId(),
        ]);
    }
}
