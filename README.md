# ToLiso App

**Controle financeiro pessoal feito pra quem tá no limite.**

ToLiso é um app simples e direto para gerenciar finanças pessoais. Com ele, o usuário pode registrar ganhos, despesas, metas e visualizar sua saúde financeira em tempo real.

## Tecnologias

* [Laravel 11](https://laravel.com/)
* [Docker](https://www.docker.com/)
* [MySQL 8](https://www.mysql.com/)
* Blade (view engine)
* [RabbitMQ](https://www.rabbitmq.com/) (filas e notificações assíncronas)
* [Mailgun](https://www.mailgun.com/) (envio de emails)

## Funcionalidades principais

### Dashboard

* Visualização geral do saldo, metas e histórico de gastos.
* Gráficos e indicadores para facilitar a leitura dos dados.

### Adicionar Gastos

* Botão para adicionar novos gastos de forma rápida.
* Formulário com os seguintes campos obrigatórios:

  * Título
  * Categoria (ex: alimentação, transporte, etc.)
  * Valor
  * Data do gasto

### Análises e Previsões

* Listagem dos maiores gastos.
* Previsão de gastos com base no histórico.
* Geração de alertas para gastos excessivos.

### Notificações

* Envio de alertas por email usando Mailgun.
* Integração com Telegram para notificações diretas.

### Cofrinho

* Funcionalidade opcional para guardar valores recorrentes como economia.
* Exibição do progresso mensal no cofre.

### Login e Autenticação

* Login com autenticação tradicional.
* Sistema de roles (admin e usuário comum).

### Extras e Expansões Futuras

* Login com GoogleAuth e via sms.
* Registro de gastos parcelados com previsão mensal.
* Entrada de gastos via bot do Telegram.
* App Mobile contendo as mesmas informações.

## Pré-requisitos

* Docker e Docker Compose instalados
* Make (Linux/macOS) ou scripts no Windows

## Subindo o projeto

```bash
cp .env.example .env
docker-compose up -d --build
docker exec -it toliso-app php artisan key:generate
docker exec -it toliso-app php artisan migrate
```

## Comandos úteis

* Acessar container:

```bash
docker exec -it toliso-app bash
```

* Rodar queue worker (RabbitMQ):

```bash
php artisan queue:work
```

## RabbitMQ

A fila será usada para processar tarefas em segundo plano, como envio de emails, notificações de alerta de saldo ou relatórios periódicos.

* Painel do RabbitMQ: [http://localhost:15672](http://localhost:15672)
* Usuário padrão: `guest`
* Senha padrão: `guest`

## Mailgun

Configuração no `.env`:

```
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=sua-domain.mailgun.org
MAILGUN_SECRET=sua-chave-api
MAIL_FROM_ADDRESS=no-reply@tolisoapp.com
MAIL_FROM_NAME="ToLiso App"
```

> Certifique-se de configurar corretamente seu domínio no painel da Mailgun e verificar os DNS.

## Funcionalidades previstas

* ⏳ Cadastro de receitas e despesas
* ⏳ Dashboard com saldo atual
* ⏳ Metas mensais
* ⏳ Alertas de gastos excessivos (via fila)
* ⏳ Relatórios semanais/mensais
* ⏳ Exportação de dados (.csv)
* ⏳ Envio de emails com Mailgun
* ⏳ Notificações via Telegram
* ⏳ Login com Google e roles
* ⏳ API pública para mobile

---

**Feito com 💸 por quem sabe o que é ficar liso.**
