<?php

namespace App\Controller;

use App\Form\HomeFilterFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $form = $this->createForm(HomeFilterFormType::class);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'filtering_form'      => $form->createView()

        ]);
    }
}
