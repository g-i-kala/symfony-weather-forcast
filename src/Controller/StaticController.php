<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StaticController extends AbstractController
{
    #[Route('weather/highlander-says', name: 'This is highlander', methods: 'GET')]
    public function highlanderSays(): Response
    {
        $draw = random_int(0, 100);
        $forecast = $draw < 50 ? 'Rain' : "Sunny";

        return $this->render('weather/highlander-says.html.twig', [
          'forecast' => $forecast,
        ]);
    }

    #[Route('/', name: 'home route')]
    public function home(): Response
    {
        $text = "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus, perferendis consectetur vero omnis temporibus enim labore distinctio magnam placeat totam explicabo et itaque consequuntur tenetur nihil! Eos alias deserunt possimus.";

        return $this->render('static/home.html.twig', [
          'text' => $text
          ]);
    }
}
