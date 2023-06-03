<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\CityRepository;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class LocationController extends AbstractController
{
    #[Route('/location', name: 'app_location')]
    public function index(LocationRepository $locationRepository): Response
    {
        return $this->render('location/index.html.twig', [
            'controller_name' => 'LocationController',
            'locations' => $locationRepository->findAll(),
        ]);
    }

    #[Route('/location/{id}', name: 'app_location/show')]
    public function show(Environment $twig, Location $location,): Response
    {
        return $this->render('location/show.html.twig', [
            'location' => $location,
        ]);
    }
}
