<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsCommand(
    name: 'app:test-mailer',
    description: 'Envia um email de teste para verificar configuração do Mailer',
)]
class TestMailerCommand extends Command
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        parent::__construct();
        $this->mailer = $mailer;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = (new Email())
            ->from('jusprime.samuel@gmail.com')
            ->to('jusprime.samuel@gmail.com')
            ->subject('Teste de Mailer Symfony')
            ->text('Este é um email de teste enviado pelo Symfony Mailer.');

        $this->mailer->send($email);

        $output->writeln('Email de teste enviado com sucesso!');
        return Command::SUCCESS;
    }
}
