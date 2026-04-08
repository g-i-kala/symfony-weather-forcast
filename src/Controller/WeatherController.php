<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    #[Route('weatehr/highlander-says')]
    public function highlanderSays(): Response
    {
        $draw = random_int(0, 100);
        $forecast = $draw < 50 ? 'Rain' : "Sunny";

        return $this->render('weather/highlander-says.html.twig', [
          'forecast' => $forecast,
        ]);
    }
}
