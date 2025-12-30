# 🐳 Guia Docker - FitPlan Academy

Este guia explica como rodar o projeto usando Docker, o que elimina problemas de configuração de ambiente local (como versões de PHP ou drivers faltando).

## 📋 Pré-requisitos

- **Docker Desktop** instalado e rodando.

## 🚀 Como Rodar

1.  **Abra o terminal na pasta do projeto.**

2.  **Suba os containers:**
    ```bash
    docker-compose up -d --build
    ```
    *O `--build` garante que as alterações no Dockerfile sejam aplicadas.*

3.  **Instale as dependências (apenas na primeira vez):**
    ```bash
    docker-compose exec app composer install
    ```

4.  **Gere a chave da aplicação (apenas na primeira vez):**
    ```bash
    docker-compose exec app php artisan key:generate
    ```

5.  **Rode as migrações e seeders:**
    ```bash
    docker-compose exec app php artisan migrate --seed
    ```

6.  **Acesse o projeto:**
    - Aplicação: [http://localhost:8000](http://localhost:8000)
    - phpMyAdmin (Banco de Dados): [http://localhost:8080](http://localhost:8080)

## 🛑 Parar o Projeto

Para parar os containers e liberar memória:
```bash
docker-compose down
```

## 🔧 Comandos Úteis

- **Entrar no terminal do container:**
  ```bash
  docker-compose exec app bash
  ```
- **Ver logs:**
  ```bash
  docker-compose logs -f
  ```
- **Limpar cache:**
  ```bash
  docker-compose exec app php artisan optimize:clear
  ```

## ⚙️ Configuração do Banco de Dados (.env)

Ao usar Docker, seu arquivo `.env` deve apontar para o container do banco, não para `localhost` ou `127.0.0.1`.

Certifique-se de que seu `.env` tenha estas configurações:

```env
DB_CONNECTION=mysql
DB_HOST=mysql      <-- Nome do serviço no docker-compose.yml
DB_PORT=3306
DB_DATABASE=fitplan_academy
DB_USERNAME=root
DB_PASSWORD=root
```
