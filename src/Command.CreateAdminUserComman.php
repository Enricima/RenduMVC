<?php
namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class CreateAdminUserCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setName('app:create-admin-user')
            ->setDescription('Créer un utilisateur administrateur avec mot de passe déjà haché')
            ->addOption('username', null, InputOption::VALUE_REQUIRED, 'Nom d\'utilisateur de l\'administrateur')
            ->addOption('password', null, InputOption::VALUE_REQUIRED, 'Mot de passe déjà haché de l\'administrateur');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getOption('username');
        $password = $input->getOption('password');

        if (!$username || !$password) {
            $output->writeln('Erreur : Veuillez fournir un nom d\'utilisateur et un mot de passe.');
            return Command::FAILURE;
        }

        $adminUser = new User();
        $adminUser->setPassword($password); // Notez que le mot de passe est déjà haché

        $this->entityManager->persist($adminUser);
        $this->entityManager->flush();

        $output->writeln('Utilisateur administrateur créé avec succès.');

        return Command::SUCCESS;
    }
}
