# Sobre o projeto

O projeto foi desenvolvido usando o framework lumen, para a construção da api. A interface foi construída usando bootstrap e jquery.

# Instalação

1) Clonar o repositório na raiz de um servidor apache, usando o comando git clone https://github.com/tiagodavanzo/_portalssp;

2) Importar a base de dados portalssp.sql para o banco de dados mysql local, usando phpmyadmin, MySQL Workbench ou outro gerenciador. Alterar o arquivo .env, informando o nome bo banco de dados (DB_DATABASE), usuário (DB_USERNAME) e a senha (DB_PASSWORD);

3) Abrir o cmd e ir até a pasta lumen (que se encontra dentro da pasta _portalssp), e rodar o comando php -S localhost:8000 -t public, para rodar a api;

4) Todos os usuários estão com a senha padrão 123456 para testes. As contas criadas foram: cliente1@gmail.com, cliente2@gmail.com, fornecedor1@gmail.com, fornecedor2@gmail.com e , fornecedor3@gmail.com.

6) Acessar o seguinte endereço no navegador: http://localhost/_portalssp/chamados/.
