<?php

namespace App\DataFixtures;

use App\Entity\Cliente;
use App\Entity\Processo;
use App\Entity\Documento;
use App\Entity\Funcionario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Criar alguns clientes
        $cliente1 = new Cliente();
        $cliente1->setNome('Maria Silva');
        $cliente1->setEmail('maria.silva@example.com');
        $cliente1->setTelefone('11999999999');
        $cliente1->setEndereco('Rua das Flores, 123 - São Paulo');
        $manager->persist($cliente1);

        $cliente2 = new Cliente();
        $cliente2->setNome('João Souza');
        $cliente2->setEmail('joao.souza@example.com');
        $cliente2->setTelefone('21988888888');
        $cliente2->setEndereco('Av. Brasil, 456 - Rio de Janeiro');
        $manager->persist($cliente2);

        // Criar alguns funcionários
        $funcionario1 = new Funcionario();
        $funcionario1->setNome('Carlos Pereira');
        $funcionario1->setCargo('Advogado');
        $funcionario1->setEmail('carlos.pereira@example.com');
        $funcionario1->setTelefone('31977777777');
        $manager->persist($funcionario1);

        $funcionario2 = new Funcionario();
        $funcionario2->setNome('Ana Costa');
        $funcionario2->setCargo('Assistente Jurídica');
        $funcionario2->setEmail('ana.costa@example.com');
        $funcionario2->setTelefone('41966666666');
        $manager->persist($funcionario2);

        // Criar um processo
        $processo1 = new Processo();
        $processo1->setNumero('PROC-001');
        $processo1->setDescriçcao('Processo trabalhista contra Empresa X');
        $processo1->setStatus('Em andamento');
        $processo1->setData(new \DateTime('2026-01-18'));
        $processo1->setProximoPrazo(new \DateTime('2026-02-01'));

        // Relacionar clientes e funcionários ao processo
        $processo1->getCliente()->add($cliente1);
        $processo1->getCliente()->add($cliente2);
        $processo1->getResponsavel()->add($funcionario1);
        $processo1->getResponsavel()->add($funcionario2);

        $manager->persist($processo1);

        // Criar documentos relacionados ao processo e clientes
        $documento1 = new Documento();
        $documento1->setTitulo('Petição Inicial');
        $documento1->setArquivo('peticao_inicial.pdf');
        $documento1->setProcesso($processo1);
        $documento1->getCliente()->add($cliente1);
        $manager->persist($documento1);

        $documento2 = new Documento();
        $documento2->setTitulo('Contestação');
        $documento2->setArquivo('contestacao.pdf');
        $documento2->setProcesso($processo1);
        $documento2->getCliente()->add($cliente2);
        $manager->persist($documento2);

        // Salvar tudo no banco
        $manager->flush();
    }
}
