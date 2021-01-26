<?php

namespace App\Controller;

use App\Entity\Ecosystem;
use App\Entity\User;
use App\Form\EcosystemType;
use App\Form\MembershipType;
use App\Repository\EcosystemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/deconnexion", name="app_logout")
     */
    public function logout(): Response
    {
        throw new LogicException(
            'This method can be blank - it will be intercepted by the logout key on your firewall.'
        );
    }

    /**
     * @Route("/formulaire-informations", name="membershipForm")
     * @param Request $request
     * @return Response
     */
    public function membershipForm(Request $request): Response
    {
        $ecosystem = new Ecosystem();
        /** @var User $user */
        $user = $this->getUser();
        if ($user->isVerified() == false) {
            $this->addFlash(
                'danger',
                'Vous devez activer votre compte grâce au lien qui vous a été envoyé par email avant d\'accéder
                à vos informations !'
            );
            return $this->redirectToRoute('home');
        }

        if (in_array("ROLE_MEMBER", $user->getRoles())) {
            return $this->redirectToRoute('app_profile');
        }

        $form = $this->createForm(MembershipType::class, $ecosystem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $ecosystem->setUser($user);
            $entityManager->persist($ecosystem);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vos informations ont bien été enregistrées. Votre demande d\'adhésion sera traitée dans les
                plus brefs délais.'
            );
            return $this->redirectToRoute('app_profile');
        }
        return $this->render('security/membershipForm.html.twig', [
            'ecosystem' => $ecosystem,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profil", name="app_profile")
     * @param EcosystemRepository $ecosystemRepository
     * @return RedirectResponse|Response
     */
    public function profile(EcosystemRepository $ecosystemRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $member = $ecosystemRepository->findOneBy(['user' => $user]);

        if (!in_array("ROLE_MEMBER", $user->getRoles())) {
            return $this->redirectToRoute('membershipForm');
        }

        return $this->render('security/profile.html.twig', [
            'user' => $user,
            'member' => $member
        ]);
    }
}
