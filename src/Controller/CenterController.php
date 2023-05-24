<?php

namespace App\Controller;

use App\Repository\CenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CenterController extends AbstractController
{
    #[Route('/center', name: 'app_center')]
    public function index(CenterRepository $centerRepository): Response
    {
        return $this->render('center/index.html.twig', [
            'controller_name' => 'CenterController',
            'centers' => $centerRepository->findAll(),

        ]);
    }

}
