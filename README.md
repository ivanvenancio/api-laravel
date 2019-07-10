
  

  

# api-laravel

  

  

Exemplo de API Simples com Laravel, CRUD de Escritórios e Especificadores.

Duas tabelas com um relacionamente many to many, sendo que um especificador pode ter em seu histórico com vários escritórios mas estar ativo em apenas 1.

  

# Instalação

  

1. Clonar o projeto

https://github.com/ivanvenancio/api-laravel.git

  

2. Baixar as dependências com o composer

```composer update```

  

3. Fazer uma cópia do arquivo .env-default na raiz do projeto e renomear para .env

  

4. Atualizar o .env com as credênciais do mysql

  

5. Executar o comando migrate para criar as tabelas necessárias e caso queira popular com dados fictícios, comandos:

```php artisan migrate``` (só as tabelas)

  

caso queira popular com dados fictícios

```php artisan migrate --seed``` (tabelas e dados fictícios)

  

6. Precisa criar o usuário padrão para usar a API ( logar e gerar o token), caso tenha rodado a seeds o user foi criado, caso não, execute somente a seed do usuário:

```php artisan db:seed --class=UsersTableSeeder```

  

``` 
usuário: user@user.com
password: 123mudar 
```

  

7. No .env-default renomeado já tem o jwt secret, mas caso queira mudar, execute o comando:

```php artisan jwt:secret```

  

# Documentação API

## Login

Para usar a API é necessário gerar o token que tem duração de 1 hora.

EndPoint = [POST]

``` /api/v1/login```

  

No body da requisição, enviar o JSON abaixo

``` 
{
"email": "user@user.com",
"password": "123mudar"
} 
```

Para qualquer endpoint passar o token no Authorization do Header, exemplo no Postman:

```markdown

| Key | Value |

|---------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|

| Accept | application/json |

| Authorization | Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC93d3cuZGV2LmFwaWxhcmF2ZWwuY29tLmJyXC9hcGlcL3YxXC9sb2dpbiIsImlhdCI6MTU2Mjc2NDIyMSwiZXhwIjoxNTYyNzY3ODIxLCJuYmYiOjE1NjI3NjQyMjEsImp0aSI6IjI5YWVEUnp3ZHFwSHZ2ZDMiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEiLCJlbWFpbCI6InVzZXJAdXNlci5jb20iLCJuYW1lIjoiSXZhbiBWZW5hbmNpbyJ9.8TbJcahAo2EdojCpnCqb5Jmjx2tQXse_i5NGpECNcF8 |

```

## Offices

Os escritórios tem paginação, trazendo 15 por página.

### EndPoints:

1. Buscar todos os Escritórios [GET]:

  

``` /api/v1/offices ```

  

2. Buscar todos os escritórios das próximas páginas [GET]:

  

```/api/v1/offices?page=2 ```

  

3. Buscar um escritório por ID [GET]:

  

```/api/v1/offices/{office_id} ```

  

4. Criar um escritório [POST]:

enviar somente númerso no cnpj e no zip_code

```/api/v1/offices/{office_id} ```

No body da requisição, enviar o JSON como o exemplo:

  

``` 
{
"cnpj" : "90599911565250",
"fantasy_name":"Teste",
"social_name":"Teste",
"zip_code":"02971101"
} 
```

5. Atualizar um escritório[PUT]:

no update o cnpj não precisa ser enviado, e mesmo que envie não será alterado, pois é único.

  

```/api/v1/offices/{office_id} ```

  

No body da requisição, enviar o JSON como o exemplo:

``` 
{
"fantasy_name":"Teste",
"social_name":"Teste",
"zip_code":"02971101"
} 
```

6. Deletar um escritório[DELETE]:

```/api/v1/offices/{office_id} ```

  

## Specifier

Os especificadores tem paginação, trazendo 15 por página.

### EndPoints:

1. Buscar todos os Especificadores [GET]:

``` /api/v1/specifiers ```

  

2. Buscar todos os especificadores das próximas páginas [GET]:

```/api/v1/specifiers?page=2 ```

  

3. Buscar um especificador por ID [GET]:

```/api/v1/specifiers/{office_id} ```

  

4. Criar um especificador [POST]:

enviar somente númerso no cpf, phone e no zip_code

no date_birth enviar no formato yyyy-mm-dd ou yyyy/mm/dd

```/api/v1/specifiers/{specifier_id} ```

  

No body da requisição, enviar o JSON como o exemplo:

``` 
{
"cpf" : "12345678998",
"first_name":"Teste",
"last_name":"Teste",
"profession":"Teste",
"date_birth":"1978-04-09",
"phone":"11996487953",
"zip_code":"02971101",
"state":"SP",
"city":"São Paulo"
} 
```

  

5. Atualizar um escritório[PUT]:

no update o cpf não precisa ser enviado, e mesmo que envie não será alterado, pois é único.

```/api/v1/specifiers/{specifier_id} ```

  

No body da requisição, enviar o JSON como o exemplo:

``` 
{
"first_name":"Teste",
"last_name":"Teste",
"profession":"Teste",
"date_birth":"1978-04-09",
"phone":"11996487953",
"zip_code":"02971101",
"state":"SP",
"city":"São Paulo"
} 
```

  

6. Deletar um escritório[DELETE]:

```/api/v1/specifiers/{specifier_id} ```

7. Associar um especificador a um escritório, para essa operação a regra implementada foi que um especificador só pode estar ativo em 1 escritório, mas pode ter no histórico, mais que um.

Sendo assim, quando é feita uma associação nova, todas as outras são inativadas.

``` /api/v1/specifiers/{specifier_id}/{office_id} ```