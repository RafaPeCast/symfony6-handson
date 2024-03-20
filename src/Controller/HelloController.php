<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\UserProfile;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserProfileRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{

    private array $messages = [
        ['message' => 'Hello', 'created' => '2023/06/12'],
        ['message' => 'Hi', 'created' => '2023/04/12'],
        ['message' => 'Bye!', 'created' => '2022/05/12']
    ];

    #[Route('/messages', name: 'app_message')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Create a new MicroPost and comment and assign the comment to it

        // $post = new MicroPost();
        // $post->setTitle('Hello');
        // $post->setText('Hello');
        // $post->setCreated(new DateTime());

        // $post = $entityManager->getRepository(MicroPost::class)->find(11);
        // $comment = $post->getComments()[0];

        // $post->removeComment($comment);

        // $entityManager->persist($post);
        // $entityManager->flush();


        // $comment = new Comment();
        // $comment->setText('Hello');
        // $comment->setPost($post);
        // // $post->addComment($comment);

        // // $entityManager->persist($post);

        // Create a new user and assign it to a new profile

        // $user = new User();
        // $user->setEmail('email@email.com');
        // $user->setPassword('12345678');

        // $profile = new UserProfile();
        // $profile->setUser($user);
        // $entityManager->persist($profile);
        // $entityManager->flush();

        // // $profile = $entityManager->getRepository(UserProfile::class)->find(1);
        // // $entityManager->remove($profile);
        // // $entityManager->flush();

        return $this->render(
            'hello/index.html.twig',
            [
                'messages' => $this->messages,
                'limit' => 3
            ]
        );
    }

    #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
    public function showOne(int $id): Response
    {
        return $this->render(
            'hello/show_one.html.twig',
            [
                'message' => $this->messages[$id]
            ]
        );
    }
}
