<?php

namespace App\Controller;

use App\Entity\LegalNotice;
use App\Form\LegalNoticeType;
use App\Repository\LegalNoticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/mentions-legales", name="admin_")
 */
class AdminLegalNoticeController extends AbstractController
{
    /**
     * @Route("/", name="legal_notice_index", methods={"GET"})
     * @param LegalNoticeRepository $lnr
     * @return Response
     */
    public function index(LegalNoticeRepository $lnr): Response
    {
        return $this->render('admin/legal_notice/index.html.twig', [
            'legal_notice' => $lnr->findOneBy([]),
        ]);
    }

    /**
     * @Route("/{id}/edition", name="legal_notice_edit", methods={"GET","POST"})
     * @param Request $request
     * @param LegalNotice $legalNotice
     * @return Response
     */
    public function edit(Request $request, LegalNotice $legalNotice): Response
    {
        $form = $this->createForm(LegalNoticeType::class, $legalNotice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Les mentions légales ont bien été modifiées.');

            return $this->redirectToRoute('admin_legal_notice_index');
        }

        return $this->render('admin/legal_notice/edit.html.twig', [
            'legal_notice' => $legalNotice,
            'form' => $form->createView(),
        ]);
    }
}
