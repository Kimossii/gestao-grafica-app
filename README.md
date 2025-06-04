<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

# Sistema de Gestão de uma Gráfica (Laravel)

Este sistema foi desenvolvido com o framework Laravel e tem como objetivo fornecer uma solução completa de gestão de uma Gráfica, com foco em organização, eficiência e controle de dados e operações.

## 🧰 Tecnologias Utilizadas

- Laravel 10+
- PHP 8+
- MySQL
- Bootstrap ou TailwindCSS 
- Blade Templates
- Eloquent ORM
- Auth com Laravel Breeze 

## ✅ Requisitos Funcionais

O sistema possui os seguintes módulos de gestão:

- **Usuários**  
  - Cadastro, edição, desativação e gerenciamento de permissões.
  
- **Clientes**  
  - Registro de dados pessoais e histórico de compras.

- **Fornecedores**  
  - Gestão de parceiros e responsáveis por fornecimento de produtos ou serviços.

- **Serviços**  
  - Cadastro de serviços oferecidos, com valores, descrição e categorias.

- **Produtos**  
  - Controle de estoque, preços, categorias e fornecedores vinculados.

- **Perfil do Usuário**  
  - Atualização de informações pessoais, senha, e preferências.

- **Faturas e Recibos**  
  - Emissão de faturas com possibilidade de gerar recibos automáticos.
  - Visualização de Fatura/Recibo individualmente.

- **Recibo Simples**  
  - Geração de recibos independentes de fatura, como comprovantes de recebimento.

- **Fluxo de Caixa**  
  - Relatório geral de entradas e saídas com saldo atualizado.
  - Visão de movimentações financeiras agrupadas por período.

## 📊 Relatórios Disponíveis

O sistema oferece relatórios gerenciais com filtros por período:

- **Relatório de Vendas**
  - Diário
  - Semanal
  - Mensal
  - Semestral
  - Anual

- **Relatório de Caixa**
  - Total de entradas e saídas por tipo de transação
  - Exportação em PDF/Excel (Em desenvolvimento)

## Instalação

- git clone https://https://github.com/Kimossii/gestaografica.git
- cd seu-projeto
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan serve
##

## ✉️ Contato
- Para dúvidas, sugestões ou contribuições, entre em contato pelo
- ** Email: eluckimossi@gmail.com


## 🧪 Testes

Para rodar os testes:
```bash
php artisan test

