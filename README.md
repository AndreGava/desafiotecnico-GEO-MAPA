# Desafio Técnico GEO MAPA

Este é o repositório do código-fonte do projeto GEO MAPA, uma aplicação web para upload e visualização de dados geoespaciais em um mapa interativo.

## Funcionalidades

O projeto é dividido em duas partes principais:

1.  **Painel de Administração**: Uma interface para fazer o upload de arquivos no formato `.geojson`. Cada arquivo enviado se torna uma nova camada de dados no mapa.
2.  **Visualização de Mapa**: Uma página pública que exibe um mapa interativo com todas as camadas geoespaciais que foram carregadas através do painel.

## Tecnologias Utilizadas

-   **Backend**: PHP 8.2+ / Laravel 11
-   **Frontend**: Livewire 3, Blade, TailwindCSS, Bootstrap, Vite
-   **Banco de Dados**: SQLite
-   **Processamento Geoespacial**: `clickbar/laravel-magellan`

---

## Como Executar o Projeto

Siga os passos abaixo para configurar e executar o projeto em seu ambiente de desenvolvimento local.

### Pré-requisitos

-   PHP >= 8.2
-   Composer
-   Node.js e NPM

### Instalação

1.  **Clone o repositório:**
    ```bash
    git clone <URL_DO_SEU_REPOSITORIO>
    cd desafiotecnicogeo
    ```

2.  **Instale as dependências do PHP:**
    ```bash
    composer install
    ```

3.  **Configure o arquivo de ambiente:**
    -   Copie o arquivo de exemplo `.env.example` para um novo arquivo chamado `.env`.
    -   Defina uma senha para o painel de administração no arquivo `.env`, na variável `PANEL_PASSWORD`.

    ```bash
    cp .env.example .env
    ```
    *Edite o arquivo `.env` e adicione a linha:*
    ```
    PANEL_PASSWORD=sua-senha-segura
    ```

4.  **Gere a chave da aplicação Laravel:**
    ```bash
    php artisan key:generate
    ```

5.  **Crie o arquivo do banco de dados SQLite:**
    ```bash
    touch database/database.sqlite
    ```

6.  **Execute as migrações do banco de dados:**
    ```bash
    php artisan migrate
    ```

7.  **Instale as dependências do Node.js:**
    ```bash
    npm install
    ```

### Execução

Para iniciar o servidor de desenvolvimento e o compilador de assets, você pode executar os comandos separadamente ou usar o script `dev` configurado no `composer.json`.

**Opção 1: Comando unificado (Recomendado)**

Este comando irá iniciar o servidor PHP, o processo da fila, o log e o Vite simultaneamente.

```bash
composer run-script dev
```

**Opção 2: Comandos separados**

Abra dois terminais:
- No primeiro, inicie o servidor Vite:
  ```bash
  npm run dev
  ```
- No segundo, inicie o servidor Laravel:
  ```bash
  php artisan serve
  ```

---

## Demonstração Funcional

Após a execução, a aplicação estará disponível em `http://localhost:8000`.

### 1. Adicionando Camadas (Layers)

-   Acesse o painel de administração em: **[http://localhost:8000/painel](http://localhost:8000/painel)**
-   O navegador solicitará uma autenticação (HTTP Basic Auth). Use o usuário `admin` e a senha que você definiu em `PANEL_PASSWORD` no arquivo `.env`.
-   Na página do painel, clique em "Escolher arquivo", selecione um arquivo `.geojson` do seu computador e clique em "Upload".
-   A nova camada aparecerá na lista de camadas existentes.


### 2. Visualizando o Mapa

-   Acesse a página principal da aplicação em: **[http://localhost:8000/](http://localhost:8000/)**
-   O mapa será exibido, carregando e mostrando todas as camadas que foram adicionadas através do painel de administração.

<img width="1865" height="996" alt="image" src="https://github.com/user-attachments/assets/63774577-613e-4f26-90c8-f3ef3baa31fb" />

<img width="1865" height="996" alt="image" src="https://github.com/user-attachments/assets/16b09058-8f42-4174-bc8d-b00e23e3d0eb" />
