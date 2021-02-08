<?php

namespace App\Controller;

use App\Entity\Ecosystem;
use App\Entity\User;
use App\Form\EcosystemType;
use App\Form\StatusFilterType;
use App\Repository\EcosystemRepository;
use App\Repository\StatusRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ecosysteme", name="ecosystem_")
 */
class AdminEcosystemController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET","POST"})
     * @param EcosystemRepository $ecosystemRepository
     * @param Request $request
     * @param StatusRepository $statusRepository
     * @return Response
     */
    public function index(
        EcosystemRepository $ecosystemRepository,
        Request $request,
        StatusRepository $statusRepository
    ): Response {
        $form = $this->createForm(StatusFilterType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $statusName = $form->getData()['status'];
            if ($statusName) {
                $status = $statusRepository->findOneBy(['name' => $statusName]);
                $ecosystems = $ecosystemRepository->findBy(
                    ['status' => $status, 'isValidated' => true],
                    ['name' => 'ASC']
                );
            }
        }

        $ecosystems ??= $ecosystemRepository->findBy(['isValidated' => true], ['name' => 'ASC']);

        return $this->render('admin/ecosystem/index.html.twig', [
            'ecosystems' => $ecosystems,
            'form' => $form->createView(),
            'page' => 'ecosystem',
        ]);
    }

    /**
     * @Route("/adhesion", name="adhesion_index", methods={"GET","POST"})
     * @param EcosystemRepository $ecosystemRepository
     * @param Request $request
     * @param StatusRepository $statusRepository
     * @return Response
     */
    public function adhesionIndex(
        EcosystemRepository $ecosystemRepository,
        Request $request,
        StatusRepository $statusRepository
    ): Response {
        $form = $this->createForm(StatusFilterType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $statusName = $form->getData()['status'];
            if ($statusName) {
                $status = $statusRepository->findOneBy(['name' => $statusName]);
                $ecosystems = $ecosystemRepository->findBy(
                    ['status' => $status, 'isValidated' => false],
                    ['name' => 'ASC']
                );
            }
        }

        $ecosystems ??= $ecosystemRepository->findBy(['isValidated' => false], ['name' => 'ASC']);

        return $this->render('admin/ecosystem/index.html.twig', [
            'ecosystems' => $ecosystems,
            'form' => $form->createView(),
            'page' => 'adhesion',
        ]);
    }

    /**
     * @Route("/ajout", name="new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $ecosystem = new Ecosystem();
        $form = $this->createForm(EcosystemType::class, $ecosystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ecosystem);
            $entityManager->flush();

            $this->addFlash('success', 'L\'entreprise a bien été ajoutée à l\'écosystème.');

            return $this->redirectToRoute('ecosystem_index');
        }

        return $this->render('admin/ecosystem/new.html.twig', [
            'ecosystem' => $ecosystem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     * @param Ecosystem $ecosystem
     * @return Response
     */
    public function show(Ecosystem $ecosystem): Response
    {
        return $this->render('admin/ecosystem/show.html.twig', [
            'ecosystem' => $ecosystem,
        ]);
    }

    /**
     * @Route("/{id<^[0-9]+$>}/edition", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Ecosystem $ecosystem
     * @return Response
     */
    public function edit(Request $request, Ecosystem $ecosystem): Response
    {
        $form = $this->createForm(EcosystemType::class, $ecosystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var User $user */
            $user = $ecosystem->getUser();
            if (!in_array("ROLE_MEMBER", $user->getRoles()) && $ecosystem->getIsValidated() === true) {
                $user->setRoles(["ROLE_MEMBER"]);
            }
            $entityManager->flush();
            $this->addFlash('success', 'L\'entreprise a bien été modifiée.');

            if ($ecosystem->getIsValidated() === true) {
                return $this->redirectToRoute('ecosystem_index');
            } else {
                return $this->redirectToRoute('ecosystem_adhesion_index');
            }
        }

        return $this->render('admin/ecosystem/edit.html.twig', [
            'ecosystem' => $ecosystem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id<^[0-9]+$>}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Ecosystem $ecosystem
     * @return Response
     */
    public function delete(Request $request, Ecosystem $ecosystem): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ecosystem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ecosystem);
            $entityManager->flush();

            $this->addFlash('danger', 'L\'entreprise a bien été retirée de l\'écosystème.');
        }

        if ($ecosystem->getIsValidated() === true) {
            return $this->redirectToRoute('ecosystem_index');
        } else {
            return $this->redirectToRoute('ecosystem_adhesion_index');
        }
    }
}
