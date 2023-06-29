#API Laravel
Essa API trabalha com autenticação de usuários via JWT;

### Requisitos do Sistema
PHP >= 7.4
Composer
Banco de dados MySQL
### Configuração
1.  Clone o repositório para sua máquina local:


`git clone https://github.com/seu-usuario/api-laravel.git`

2.  Acesse o diretório do projeto:


`cd nome-do-repositorio`

3. Instale as dependências do projeto usando o Composer:

`composer install`

4. Copie o arquivo de configuração .env.example para .env:

`cp .env.example .env`

5.   Configure as variáveis de ambiente no arquivo .env, como as credenciais do banco de dados.

6.  Gere uma nova chave de aplicação:

`php artisan key:generate`

7.  Execute as migrações para criar as tabelas no banco de dados:

`php artisan migrate`

8.  (Opcional) Execute os seeders para adicionar registros de exemplo ao banco de dados:

`php artisan db:seed`

### Executando a API
1. Inicie o servidor embutido do PHP:

`php artisan serve`

A API estará disponível em http://localhost:8000.

### Endpoints
**/api/login (POST):** Autenticar usuário.
**/api/usuarios (GET):** Obter todos os usuários.
**/api/usuarios/{id} (GET):** Obter um usuário específico pelo ID.

### Documentação da API
A documentação da API foi gerada utilizando o Swagger e está disponível em http://localhost:8000/api/documentation. Acesse esse URL para ver os detalhes dos endpoints, parâmetros, respostas e outros detalhes da API.
