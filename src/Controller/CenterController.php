<?php

namespace App\Controller;

use App\Entity\Center;
use App\Repository\CenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

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

    #[Route('/center/{id}', name: 'app_center/show')]
    public function show(Environment $twig, Center $center,): Response
    {
        return $this->render('center/show.html.twig', [
           'center' => $center,
           'center.id' => $center->getId()
        ]);
    }

    #[Route('/center/search', name: 'app_center/search')]
    public function searchBar(){
        $form = $this->createFormBuilder()
            ->add('query', TextType::class)
            ->add('submit', SubmitType::class)
            ->getForm()
            ;

        return $this->render('center/search', [
            'form' => $form->createView(),
        ]);
    }

}
