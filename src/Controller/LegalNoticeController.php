<?php

namespace App\Controller;

use App\Repository\LegalNoticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticeController extends AbstractController
{
    /**
     * @Route("/mentions-legales", name="legal_notice_index", methods={"GET"})
     * @param LegalNoticeRepository $lnr
     * @return Response
     */
    public function index(LegalNoticeRepository $lnr): Response
    {
        return $this->render('legal_notice/legalNotice.html.twig', [
            'legal_notice' => $lnr->findOneBy([]),
        ]);
    }
}
