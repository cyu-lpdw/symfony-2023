<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ColorController extends AbstractController
{
    #[Route('/color/{color}', name: 'app_color', requirements: [ 'color' => '[0-9a-fA-F]{6}'])]
    public function index(string $color): Response
    {
        return $this->render('color/index.html.twig', [
            'color' => $color,
        ]);
    }
}
