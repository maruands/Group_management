<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Group Management system

This system provide a platform for a collection of group of people to manage there finacial statement through contribution by each member. It contains the following features

- Admin login
- Admin register new member with a default login given by admin
- Finace section for contibution and finacial status
- Account section to monitor members balance
- Dairy platform for posting daily contibution from dairy


## How it works
    Initial admin login is provided on seeder section [upload to the database to access dashboard section]
- Members
    Admin registers member and provide them with a defaul logins
- Finance
    1. A contibution topic is created
    2. Member to contribute to the topic above are added
    3. Member can pay for the amount needed and if the amount exceed its being saved in the account section
    4. Members can also contribute to the topic using the amount in the accont
- Accounts
    Provide a platform where the exceede amount information will be saved
    Member can also topup to its account
- Dairy
    After accounting for dairy collection, the information is feed to the system for record keeping.
    
## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

find -type f -exec chmod -v 0644 {} \;
