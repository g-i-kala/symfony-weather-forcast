<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\HighlanderDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

//#[Route('/weatehr')]
class StaticController extends AbstractController
{
    // #[Route('weather/highlander-says/{threshold<\d+>?50}', methods: ['GET', 'POST'], host: 'api.localhost')]
    public function highlanderSaysApi(#[MapQueryString] ?HighlanderDTO $dto): Response
    {
        if (!$dto) {
            $dto = new HighlanderDTO();
            $dto->threshold = 50;
            $dto->trials = 1;
        };
        $forecasts = [];
        for ($i = 0; $i < $dto->trials; $i++) {
            $draw = random_int(0, 100);
            $forecast = $draw < $dto->threshold ? 'Rain' : "Sunny";
            $forecasts[] = $forecast;
        }

        $json = [
            'forecasts' => $forecasts,
            'threshold' => $dto->threshold,
            'self' => $this->generateUrl(
                'weather_highlander_says_api',
                ['threshold' => $dto->threshold],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
        ];
        return new JsonResponse($json);
    }

    #[Route('weather/highlander-says/{threshold<\d+>?50}', methods: ['GET', 'POST'])]
    public function highlanderSays(int $threshold, Request $request): Response
    {
        $trials = $request->query->get('trials', 1);

        $forecasts = [];
        for ($i = 0; $i < $trials; $i++) {
            $draw = random_int(0, 100);
            $forecast = $draw < $threshold ? 'Rain' : "Sunny";
            $forecasts[] = $forecast;
        }

        return $this->render('weather/highlander-says.html.twig', [
          'forecasts' => $forecasts,
        ]);
    }

    // #[Route('weather/highlander-says/{guess}', methods: ['GET', 'POST'])]
    public function highlanderSaysGuess(string $guess): Response
    {
        $forecast = $guess;

        $availableGuesses = ['snow', 'hail', 'rain'];
        if (!in_array($guess, $availableGuesses)) {
            throw $this->createNotFoundException('Not found');
        }

        return $this->render('weather/highlander-says.html.twig', [
          'forecasts' => [$forecast],
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
