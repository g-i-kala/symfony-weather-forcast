<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{
    // #[Route('weather/{countryCode}/{city}', methods: ['GET'])]
    public function forecast(string $countryCode, string $city): Response
    {
        return $this->render('weather/country-city.html.twig', [
          'countryCode' => $countryCode,
          'city' => $city,
        ]);
    }
}
