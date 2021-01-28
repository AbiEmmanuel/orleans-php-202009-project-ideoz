<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/services", name="admin_")
 */
class AdminOfferController extends AbstractController
{
    /**
     * @Route("/", name="offer_index", methods={"GET"})
     * @param OfferRepository $offerRepository
     * @return Response
     */
    public function index(OfferRepository $offerRepository): Response
    {
        return $this->render('adminOffer/index.html.twig', [
            'offers' => $offerRepository->findBy([], ['number' => 'ASC']),
        ]);
    }

    /**
     * @Route("/{id<^[0-9]+$>}", name="offer_show", methods={"GET"})
     */
    public function show(Offer $offer): Response
    {
        return $this->render('adminOffer/show.html.twig', [
            'offer' => $offer,
        ]);
    }

    /**
     * @Route("/{id<^[0-9]+$>}/edition", name="offer_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Offer $offer
     * @return Response
     */
    public function edit(Request $request, Offer $offer): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Votre service a été modifié !');

            return $this->redirectToRoute('admin_offer_index');
        }

        return $this->render('adminOffer/edit.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }
}
