<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Creates a new user account',
)]
class CreateUserCommand extends Command
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'User e-mail')
            //->addArgument('password', InputArgument::REQUIRED, 'User password')
        ;
    }

    public function askHidden(string $question, ?callable $validator = null): mixed
    {
        $question = new Question($question);

        $question->setHidden(true);
        $question->setValidator($validator);

        return $question;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $io->askHidden('Insert a password');

        if (empty($password)) {
            $io->error(sprintf('Password required'));
            return Command::FAILURE;
            // $io->error(sprintf('Password cannot be empty.'));
            // $password = $io->askHidden('Insert a password');
        };

        $user = new User();
        $user->setEmail($email);
        $user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user,
                $password
            )
        );
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success(sprintf('User %s account was created!', $email));

        return Command::SUCCESS;
    }
}
