# 🛡️ Testes Automatizados

Bem-vindo ao guia de configuração do projeto *Testes Automatizados*. Este documento foi criado para ajudá-lo a configurar o ambiente necessário para subir o projeto e rodar os testes.

## 📖 Sobre o Projeto

Este projeto foi construído utilizando o [PHP](https://www.php.net/) e visa resolver os exercicios propostos no curso se testes automatizados.

## 📋 Pré-requisitos

Antes de prosseguir, é necessário que as seguintes ferramentas estejam instaladas em seu sistema:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## 🚀 Instalação e Execução

Siga os passos abaixo para configurar o projeto em sua máquina:

### 1. Clone o Repositório

Inicie clonando o repositório do projeto para sua máquina local utilizando o seguinte comando no terminal:

```bash
git clone https://github.com/webthiagosilva/testes-automatizados.git
```

### 2. Crie os Containers Docker

Dentro do diretório raiz do projeto clonado, execute o Docker Compose para construir e iniciar os containers necessários, o processo de build ja realiza a instalação das depencias do projeto:

```bash
docker-compose up --build -d
```

### 3. Acessar o log de Testes

Se tudo estiver configurado corretamente, você poderá acessar o log da execução dos testes pelo seguinte endereço:

🔗 [http://localhost:8000/public/index.php](http://localhost:8000/public/index.php)

Caso prefira, tambem podera rodar os testes via Makefile com o seguinte comando:
```bash
make test
```
---
