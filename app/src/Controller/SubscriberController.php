<?php

namespace App\Controller;

use App\Entity\Subscriber;
use App\Service\SubscriberService;
use App\Form\SubscriberFormType;
use App\Repository\SubscriberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscriberController extends AbstractController
{
    public function __construct(private SubscriberService $subscriberService, private SubscriberRepository $subscriberRepository)
    {
        
    }


    #[Route('/show/subscriber', name: 'subscriber', methods: ['GET', 'POST'])]
    public function show(Request $request)
    {
        $form = $this->createForm(SubscriberFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->subscriberService->register($form->getData());
        }

        $subscriberList = $this->subscriberRepository->findAll();

        return $this->render('subscriber/show.html.twig', [
            'subscriber_form' => $form,
            'subscribers' => $subscriberList
        ]);
    }

}