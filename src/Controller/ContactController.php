<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        $agreeTerms = $form->get('agreeTerms')->getData();

        if($form->isSubmitted() && $form->isValid() && $agreeTerms) {

            $entityManager->persist($contact);
            $entityManager->flush();

            return new Response('Contact  ' . $contact->getName() . ' with number ' . $contact->getId() . ' successfully created..');

        }

        return $this->render('contact/index.html.twig', [
            'contact_form' => $form,
            'controller_name' => 'ContactController'
        ]);
    }
}
