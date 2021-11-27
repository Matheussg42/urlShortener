<p align="center"><a target="_blank" href="https://matheus.sgomes.dev"><img src="https://matheus.sgomes.dev/img/logo_azul.png"></a></p>

👤 **Matheus S. Gomes**

* Website: https://matheus.sgomes.dev
* Github: [@Matheussg42](https://github.com/Matheussg42)
* LinkedIn: [@matheussg](https://linkedin.com/in/matheussg)
---
## URL Shortener
##Tech
- [PHP](https://www.php.net/)
- [Lumen](https://lumen.laravel.com/docs/8.x)

##Project
This project is a URL shortener that counts how many access a shortened link receives, and shows the top 100 most frequently accessed URLs.

##Quick Start
- You need to have a working PHP environment with versions over 7.X that also run Laravel/Lumen framework.
- Clone the project from the github `git clone`.
- Execute the command `composer install`.
- Create a database for the project.
- Rename `.env.example` to `.env` and edit the database information.
- Run `php artisan migrate` to create the tables.
- Start the server with `php -S localhost:8000 -t public`.

##Endpoints
####/short - POST
This **POST** endpoint receives a string param named `url` and inserts a new row on the database. This URL will receive a token to serve as a short link, and then, get the title information of the received URL.

####/short/{short} - GET
This **GET** endpoint receives a string param named `short` and gets the original URL. This `short` is the token created on `/short - POST` endpoint, that will return the original url of this shortened link. Every request we increment in +1 the column `hint` on the database.

####/short/rank - GET
This **GET** endpoint shows the top 100 most frequently accessed URLs.

