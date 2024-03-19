<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController extends AbstractController
{

    private array $messages = [
        "Hello", "Hi", "Bye!"
    ];

    #[Route('/message', name: 'app_message')]
    public function index(): Response
    {
        // return $this->render('hello/index.html.twig', [
        //     'controller_name' => 'HelloController',
        // ]);

        return new Response(implode(',',$this->messages));
    }

    #[Route('/messages/{id}', name: 'app_show_one')]
    public function showOne($id): Response
    {
        return new Response($this->messages[$id]);
    }
}
