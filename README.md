![Dashboard do Sistema](public/images/gitt.png)


# Sistema de Gestão de uma Gráfica (Laravel)

Este sistema foi desenvolvido com o framework Laravel e tem como objetivo fornecer uma solução completa de gestão de uma Gráfica, com foco em organização, eficiência e controle de dados e operações.

## 🧰 Tecnologias Utilizadas

- Laravel 12
- PHP 8.2
- MySQL
- TailwindCSS 
- Blade Templates
- Eloquent ORM
- Auth com Laravel Breeze 
## 📦 Módulos
- Gestão de clientes e fornecedores  
- Emissão de faturas, recibos e fluxo de caixa  
- Controle de contas a pagar e a receber  
- Cadastro de produtos, serviços e categorias  
- Gestão de usuários  

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

- **Relatório de Vendas em desenvolvimento**
  - Diário
  - Semanal
  - Mensal
  - Semestral
  - Anual

- **Relatório de Caixa em desenvolvimento**
  - Total de entradas e saídas por tipo de transação
  - Exportação em PDF/Excel (Em desenvolvimento)

## Instalação
```bash
- git clone https://github.com/Kimossii/gestao-grafica-app.git
- cd seu-projeto
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- npm run dev
- npm run build
- php artisan serve
```
#### O projeto estará acessível em: http://localhost:8000

##### NB: Alterar os dados das tuas credencias do Banco de Dodos com base as configuranções da tua máquina. 
##


## 🔐 Acesso
O sistema usa autenticação.

* Email:teste@gmail.com
* Senha: 111111
## 🧪 Testes

Para rodar os testes:
```bash
php artisan test
```
## 🤝 Contribuição
Pull requests são bem-vindos! Para grandes mudanças, por favor abra uma issue primeiro para discutir o que você gostaria de mudar.

## 📞 Contato
- Para dúvidas, sugestões ou contribuições, entre em contato pelo
- **Email:** eluckimossi@gmail.com  
- **LinkedIn:** [Eluki Júnior](https://www.linkedin.com/in/eluki-baptista/)  
- **GitHub:** [Eluki Júnior](https://github.com/Kimossii) 

