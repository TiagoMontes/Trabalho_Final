<?php

namespace App\Service;

use App\Repository\SubscriberRepository;
use App\Entity\Subscriber;

class SubscriberService
{
    public function __construct(private SubscriberRepository $subscriberRepository)
    {
        
    }

    public function register(array $form): Subscriber
    {

        $subscriber = new Subscriber();
        $subscriber->setFirstName($form['firstName']);
        $subscriber->setLastName($form['lastName']);
        $subscriber->setEmail($form['email']);
        $this->subscriberRepository->save($subscriber, true);
    
        return $subscriber;
    }
}