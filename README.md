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

[Myslq >= 8](https://dev.mysql.com/downloads/installer/) or (https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04)

## Clone o Projeto

git clone  https://github.com/Eldio-Neto/desafio_fullstack.git


## Rodando o Projeto

1. Acessar para a pasta onde o projeto foi clonado</p>
   <p> ~ cd desafio_fullstack

2. Instalar dependencias do Projeto
    <p>~ npm install && composer install</p>

3. Configurar o Env
    <p>Por padrão o projeto está com o env.example, basta copiar e renomear para .env.</p>
     <p>~ Alterar as informações do banco de dados e nome do schema </p>
      <p>  ~ DB_DATABASE=desafio_fullstack</p>
     <p>   ~ DB_USERNAME=root</p>
      <p>  ~ DB_PASSWORD=123</p>

4. Abrir um terminal e executar comandos para start do laravel
   <p> ~ cd desafio_fullstack </p>
   <p> ~ php artisan key:generate</p>
   <p> ~ php artisan storage:link</p>
    <p>~ php artisan db:seed --class=CategorySeeder</p>
    <p>~ php artisan serve</p>

5. Abrir outro terminal e executar comandos para start do vue
   <p> ~ cd desafio_fullstack </p>
    <p>~ npm run dev</p>


6. Acessar a link em que estiver rodando o laravel ex: (http://127.0.0.1:8000)
