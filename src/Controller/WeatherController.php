<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\WeatherDummyData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    // #[Route('weather/{country}/{city}', methods: ['GET'])]
    public function forecast(string $countryCode, string $city): Response
    {
        $weatherDummyData = [
            [
                'city' => 'Szczecin',
                'countryCode' => 'PL',
                'forecasts' => [
                    [
                        'date' => '2026-04-19',
                        'temperature' => 13,
                        'condition' => 'Cloudy',
                        'description' => 'Grey skies with light wind',
                        'humidity' => 67,
                        'windSpeed' => 18,
                    ],
                    [
                        'date' => '2026-04-20',
                        'temperature' => 16,
                        'condition' => 'Sunny',
                        'description' => 'Bright sun, pleasant afternoon',
                        'humidity' => 52,
                        'windSpeed' => 10,
                    ],
                    [
                        'date' => '2026-04-21',
                        'temperature' => 14,
                        'condition' => 'Rainy',
                        'description' => 'Showers expected most of the day',
                        'humidity' => 78,
                        'windSpeed' => 22,
                    ],
                ],
            ],
            [
                'city' => 'Warsaw',
                'countryCode' => 'PL',
                'forecasts' => [
                    [
                        'date' => '2026-04-19',
                        'temperature' => 15,
                        'condition' => 'Partly Cloudy',
                        'description' => 'Mix of sun and clouds',
                        'humidity' => 60,
                        'windSpeed' => 12,
                    ],
                    [
                        'date' => '2026-04-20',
                        'temperature' => 18,
                        'condition' => 'Sunny',
                        'description' => 'Warm and dry day',
                        'humidity' => 45,
                        'windSpeed' => 8,
                    ],
                    [
                        'date' => '2026-04-21',
                        'temperature' => 11,
                        'condition' => 'Windy',
                        'description' => 'Cooler air with stronger wind',
                        'humidity' => 58,
                        'windSpeed' => 26,
                    ],
                ],
            ],
        ];

        $emptyForecastData = [
        'city' => 'Please specify a city',
        'countryCode' => 'In a specific country',
        'forecasts' => [
            ['date' => 'Example data',
            'temperature' => '23',
            'condition' => 'Windy AF',
            'description' => 'Cooler air with stronger wind',
            'humidity' => 85,
            'windSpeed' => 56,]
        ]];

        $forecastData = [];
        if ($weatherDummyData) {
            foreach ($weatherDummyData as $data) {
                if (in_array($city, $data) && in_array($countryCode, $data)) {
                    $forecastData = $data;
                } else {
                    $forecastData = $emptyForecastData;
                }
            }
        }

        return $this->render('weather/country-city.html.twig', [
          'forecastData' => $forecastData
        ]);
    }
}
