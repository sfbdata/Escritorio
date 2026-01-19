# Escritório Jurídico - Symfony + EasyAdmin + Docker

Este projeto é um sistema administrativo para escritório jurídico, desenvolvido em **Symfony 7.4** com **EasyAdmin** e rodando em **Docker**.

## 🚀 Funcionalidades
- Gestão de **Clientes**
- Gestão de **Funcionários**
- Gestão de **Processos**
- Gestão de **Documentos**
- Painel administrativo com EasyAdmin
- Relacionamentos entre entidades (Clientes ↔ Processos ↔ Documentos ↔ Funcionários)

## 🛠️ Tecnologias
- [Symfony 7.4](https://symfony.com/)
- [EasyAdmin Bundle](https://symfony.com/bundles/EasyAdminBundle/current/index.html)
- [Docker](https://www.docker.com/)
- [Doctrine ORM](https://www.doctrine-project.org/)

## 📦 Instalação

### 1. Clonar o repositório
git clone https://github.com/seu-usuario/seu-repo.git
cd seu-repo/app

## 2. Subir com Docker
docker compose up -d

## 3. Instalar dependências
Dentro do container:
docker compose exec php composer install

## 4. Configurar banco de dados
docker compose exec php php bin/console doctrine:database:create
docker compose exec php php bin/console doctrine:migrations:migrate

## 5. Popular dados iniciais (opcional)
docker compose exec php php bin/console doctrine:fixtures:load

🔑 Acesso ao painel administrativo
Após subir o projeto, acesse:

http://localhost:8080/admin

👉 O painel EasyAdmin estará disponível com os menus:
Clientes 👤

Funcionários 👥

Processos ⚖️

Documentos 📄

📖 Próximos passos
- Adicionar filtros e ordenações no EasyAdmin

- Criar dashboard com estatísticas (processos ativos, prazos próximos, documentos anexados)

- Configurar permissões de acesso por perfil (advogado, estagiário, administrador)

- Exportação de relatórios em PDF/Excel
