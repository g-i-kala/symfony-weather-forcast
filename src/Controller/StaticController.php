<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

//#[Route('/weatehr')]
class StaticController extends AbstractController
{
    // #[Route('weather/highlander-says/{threshold<\d+>?50}', methods: ['GET', 'POST'], host: 'api.localhost')]
    public function highlanderSaysApi(int $threshold): Response
    {
        $draw = random_int(0, 100);
        $forecast = $draw < $threshold ? 'Rain' : "Sunny";

        $json = [
            'forecast' => $forecast,
            'self' => $this->generateUrl(
                'weather_highlander_says_api',
                ['threshold' => $threshold],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
        ];
        return new JsonResponse($json);
    }

    #[Route('weather/highlander-says/{threshold<\d+>?50}', methods: ['GET', 'POST'])]
    public function highlanderSays(int $threshold): Response
    {
        $draw = random_int(0, 100);
        $forecast = $draw < $threshold ? 'Rain' : "Sunny";

        return $this->render('weather/highlander-says.html.twig', [
          'forecast' => $forecast,
        ]);
    }

    // #[Route('weather/highlander-says/{guess}', methods: ['GET', 'POST'])]
    public function highlanderSaysGuess(string $guess): Response
    {
        $forecast = $guess;

        return $this->render('weather/highlander-says.html.twig', [
          'forecast' => $forecast,
        ]);
    }

    // #[Route('/', name: 'home route')]
    public function home(): Response
    {
        $text = "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus, perferendis consectetur vero omnis temporibus enim labore distinctio magnam placeat totam explicabo et itaque consequuntur tenetur nihil! Eos alias deserunt possimus.";

        return $this->render('static/home.html.twig', [
          'text' => $text
          ]);
    }
}
