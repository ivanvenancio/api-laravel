
# api-laravel

Exemplo de API Simples com Laravel

  

# Instalação

1. Clonar o projeto

https://github.com/ivanvenancio/api-laravel.git

2. Baixar as dependências com o composer

```composer update```

3. Fazer uma cópia do arquivo .env-default na raiz do projeto e renomear para .env

4. Atualizar o .env com as credênciais do base mysql

5. Rodar o comando para criar as tabelas necessárias e caso queira popular com dados fictícios, comandos:

```php artisan migrate``` ---só as tabelas

caso queira popular com dados fictícios

```php artisan migrate --seed``` ---tabelas e dados fictícios

6. Precisa criar o usuário padrão para usar a API ( logar e gerar o token), caso tenha rodado a seeds o user foi criado, caso não, execute somente a seed do usuário:

```php artisan db:seed --class=UsersTableSeeder```

usuário: user@user.com

password: 123mudar

7. No .env-default renomeado já tem o jwt secret, mas caso queira mudar, execute o comando:

```php artisan jwt:secret```