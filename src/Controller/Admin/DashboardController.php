<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Country;
use App\Entity\Current;
use App\Entity\City;
use App\Entity\Depth;
use App\Entity\Region;
use App\Entity\Type;
use App\Entity\Visibility;
use App\Entity\Zone;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(CategoryCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(CountryCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(CurrentCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(DepthCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(CityCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(RegionCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(TypeCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(VisibilityCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(ZoneCrudController::class)->generateUrl();
                return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SCUBAbook');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToUrl('Back To the Website', 'fas fa-home', $this->generateUrl('app_home'));
        yield MenuItem::section('Attributes');
        yield MenuItem::linkToCrud('Categories', 'fa fa-bacon', Category::class);
        yield MenuItem::linkToCrud('Currents', 'fa fa-tags', Current::class);
        yield MenuItem::linkToCrud('Depths', 'fas fa-download', Depth::class);
        yield MenuItem::linkToCrud('Types', 'fas fa-feather-alt', Type::class);
        yield MenuItem::linkToCrud('Visibility', 'fas fa-eye', Visibility::class);




        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        yield MenuItem::section('Resource');
        yield MenuItem::linkToCrud('Cities', 'fas fa-map-marker', City::class);
        yield MenuItem::linkToCrud('Countries', 'fas fa-flag', Country::class);
        yield MenuItem::linkToCrud('Regions', 'fas fa-map-marked-alt', Region::class);
        yield MenuItem::linkToCrud('Zones', 'fas fa-globe', Zone::class);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }


}
