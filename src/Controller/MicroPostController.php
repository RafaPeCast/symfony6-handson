<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        return $this->render('micro_post/index.html.twig', [
            'posts' => $posts->findAll(),
        ]);
    }

    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post):Response
    {
        return $this->render("micro_post/show.html.twig",[
            "post" => $post,
        ]);
    }

    // #[Route('/micro-post/create', name: 'app_micro_post_create')]
    // public function createMicroPost(EntityManagerInterface $entityManager): Response
    // {
    //     $microPost = new MicroPost();
    //     $microPost->setTitle("It comes from controller");
    //     $microPost->setText("Hi!");
    //     $microPost->setCreated(new DateTime());

    //     $entityManager->persist($microPost);
    //     $entityManager->flush();

    //     // dd($posts->findOneBy(["title"=>"Welcome to Atexis!"]));
    //     return $this->render('micro_post/index.html.twig', [
    //         'response' => "Saved new micro post with id ". $microPost->getId(),
    //     ]);
    // }


}
