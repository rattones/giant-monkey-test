# Test for Giant Monkey Robot

## Tecnology used
- PHP 7.4
- Laravel/Lumen framework
- SQLite 3

## Intruction to run

- Copy/clone this project to a folder 

- Change this line in **.env** file 

  > DB_DATABASE=/dados/Projects/pessoal/giant-monkey-test/database/db-files.db 

  for 

  > DB_DATABE=/your project folder/database/db-files.db

- In the root project folder run: `php -S http:localhost:8080 -t ./public`

## Rest API endpoints
`http://localhost:8080`

- in the root folder, there is a file named *Insomnia.json* with these endpoint implemented


**Clients**

- `POST`:/clients
  + Create => params expected: 
    - **name** *(string)*
    > Create a client ID to post jobs 

- `GET`/clients/{id}
  + Get => query param: 
    - **id** *(integer)*
    > Return client data

- `GET`/clients
  + List 
    > Return a list of clients

**Processors**

- `POST`/processors
  + Create => params expected: 
    - **name** *(string)*
    > Create a processor ID to acquire jobs 

- `GET`/processors/{id} 
  + Get => query param:
    - **id** *(integer)*
    > Return processor data

- `GET`/processors
  + List 
  > Return a list of processors

**Jobs**

- `POST`/jobs
  + Create => params expected: 
    - **clients_id**        *(integer)*
    - **processors_id**     *(integer)* **processor can not be set while creating the job**
    - **command**           *(string)*
    - **status**            *(string): 'open', 'processing' or 'done'* default: 'open'
    - **priority**          *(string): 0, 1, 2, 3 or 4* default: 0, where 0 is the highest priority and 4 the lowest
    > Create a Job ID

- `GET`/jobs
  + Get/{id} => query param:
    - **id** *(integer)*
    > Return Job data

- `GET`/jobs
  + List 
  > Return a list of jobs order by priority and date of creation

- `PUT`/jobs
  + Update => any one of this:
    - **clients_id**        *(integer)*
    - **processors_id**     *(integer)*
    - **command**           *(string)*
    - **status**            *(string): 'open', 'processing' or 'done'*
    - **priority**          *(string): 0, 1, 2, 3 or 4*
    > Return new Job data

- `GET`/jobs/getStatus/{id}
  + Get Status => query param:
    - **id** *(integer)*

- `GET`/pick
  + Pick the highest job in the jobs queue assign the processor to the job and setting job status to: *processing*
    - Barer Token expectd: **processors_id** *(integer)*

- `PATCH`/done/{id}
  + Set job status to: *done*
    - Barer Token expectd: **processors_id** *(integer)*

---
---

# Official Readme of Lumen

## Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

### Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

### Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

### Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
