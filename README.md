<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Requisitos

[Composer](https://getcomposer.org/download/)

[Node >= 18 ](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)

[Myslq >= 8](https://dev.mysql.com/downloads/installer/) or [Myslq >= 8](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04)

## Clone o Projeto

git clone  https://github.com/Eldio-Neto/desafio_fullstack.git


## Rodando o Projeto

1. Acessar para a pasta onde o projeto foi clonado</p>
   <p> ~ cd desafio_fullstack</p>

2. Instalar dependencias do Projeto
    <p>~ npm install && composer install</p>

3. Configurar o Env
    <p>Por padrão o projeto está com o env.example, basta copiar e renomear para .env.</p>
     <p>  ~ Alterar as informações do banco de dados e nome do schema </p>
     <p>  ~ DB_DATABASE=desafio_fullstack</p>
     <p>  ~ DB_USERNAME=root</p>
     <p>  ~ DB_PASSWORD=123</p>

4. Abrir um terminal e executar comandos para start do laravel e Front-end
    <p> ~ cd desafio_fullstack </p>
    <p> ~ php artisan key:generate</p>
    <p> ~ php artisan storage:link</p>
    <p> ~ php artisan migrate</p>
    <p> ~ php artisan db:seed --class=CategorySeeder</p>
    <p> ~ npm run build</p>
    <p> ~ php artisan serve</p>

6. Acessar a link em que estiver rodando o laravel ex: (http://127.0.0.1:8000)

## Testando o Projeto

1. Para adicionar produtos faça login e clique em Menu.
   <H3>Pagina inicial</h3>
   ![image](https://github.com/Eldio-Neto/desafio_fullstack/assets/97411284/3e6255f7-04b2-4525-85da-5353ecf33e2e)   
   ![image](https://github.com/Eldio-Neto/desafio_fullstack/assets/97411284/7501b3fe-c4fa-4d7f-9747-3e7a64851921)
   ![image](https://github.com/Eldio-Neto/desafio_fullstack/assets/97411284/da06934b-9c3f-4962-b5f0-17b191683143)

3.  Criar anuncio, basta preencher o titulo, descrição, valor, categoria. A imagem é opcional.

    ![image](https://github.com/Eldio-Neto/desafio_fullstack/assets/97411284/d3e2719e-7c7d-4938-ae36-39956444844e)

5. Após criar o anuncio você será redirecionado para o Dashboard de meus produtos
 
    ![image](https://github.com/Eldio-Neto/desafio_fullstack/assets/97411284/d1635c52-29d1-462b-a8d5-96b77fdefe4c)

7. Para deletar ou editar o Anuncio basta clicar no anuncio e aparecerá o card do anuncio com as opçoes para deletar ou editar (caso o anuncio seja seu)

    ![image](https://github.com/Eldio-Neto/desafio_fullstack/assets/97411284/1b624eed-2bbb-47d5-abf4-492fd2556793)

9. A edição segue a mesma regra do Cadastro titulo, descrição, valor, categoria. A imagem é opcional.

   ![image](https://github.com/Eldio-Neto/desafio_fullstack/assets/97411284/87db31c7-11e7-4875-be20-4158492c0953)

11. A Pesquisa trás Anuncios que tiverem a palavra [termo] em seu titulo ou descrição.

    ![image](https://github.com/Eldio-Neto/desafio_fullstack/assets/97411284/abcb3bfd-0801-4362-8c7d-0381ced0b766)



    
