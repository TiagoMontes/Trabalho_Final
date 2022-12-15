<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SlugTestController extends AbstractController
{
    #[Route('/slug-test/{slug}')]
    public function slug($slug): Response
    {
        return $this->render('slug-test.html.twig', compact('slug'));
    }

}
