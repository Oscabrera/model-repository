# Laravel Model Repository Generator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/oscabrera/model-repository.svg?style=flat-square)](https://packagist.org/packages/oscabrera/model-repository)
[![Total Downloads](https://img.shields.io/packagist/dt/oscabrera/model-repository.svg?style=flat-square)](https://packagist.org/packages/oscabrera/model-repository)

[![VitePress](https://github.com/oscabrera/model-repository/actions/workflows/deploy.yml/badge.svg)](https://github.com/oscabrera/model-repository/actions/workflows/deploy.yml)
[![PHPStan](https://github.com/oscabrera/model-repository/actions/workflows/phpstan.yml/badge.svg)](https://github.com/oscabrera/model-repository/actions/workflows/phpstan.yml)
[![Pint](https://github.com/oscabrera/model-repository/actions/workflows/pint.yml/badge.svg)](https://github.com/oscabrera/model-repository/actions/workflows/pint.yml)
[![PHPMD](https://github.com/oscabrera/model-repository/actions/workflows/phpmd.yml/badge.svg)](https://github.com/oscabrera/model-repository/actions/workflows/phpmd.yml)

[![built with Codeium](https://codeium.com/badges/main)](https://codeium.com)


![model-repository](https://socialify.git.ci/Oscabrera/model-repository/image?language=1&name=1&owner=1&pattern=Floating%20Cogs&theme=Auto)

Please follow the documentation at [model-repository](https://oscabrera.github.io/model-repository/).

This package for Laravel greatly simplifies the process of creating a complete RESTful API for any model in your
application. By just running a command, you can generate all the files necessary to create, read, update and delete
instances of said model. This project is based on the Repository pattern, separating data access logic from business
logic, resulting in cleaner, more modular and easier to maintain code. In addition, it integrates services that manage
the business logic and serve to orchestrate operations on the repository, thus providing an additional layer of
abstraction and organization to the code.

## Main features:

- **Automated file generation:** When you run the `php artisan make:repository` command, the following files will be
  automatically generated:
    - Model (`Model`): The Eloquent model that defines the database table structure.
    - Repository to manage the model (`Repository`): Implements the repository pattern to encapsulate database access
      logic.
- **Option to Automated file generation**
    - Service for the repository (`Service`): Implements the business logic for the model.
    - Controller for the service (`Controller`): Defines API routes and uses the service for API logic.
    - Validation requests (`Request`): Validates input data for controller routes.
    - Seeder (`Seeder`): Populates the database with sample data for testing purposes.
    - Factory (`Factory`): Generates dummy data for testing purposes.
- **Predefined CRUD methods:** The generated `Repository`, `Service` and `Controller` implement the standard methods of
  a RESTful API:
    - `create`: Create a new instance of the model
    - `read`: Read a specific instance of the model
    - `update`: Update an existing instance of the model
    - `delete`: Delete an instance of the model
    - `list`: List all instances of the model
- **Defining routes with Laravel Route Attributes:** Use `spatie/laravel-route-attributes` to clearly and concisely
  define routes in the controller. For example:

```php
#[Get(uri: 'models/{id}', name: 'models.read')]
public function read(string $id): JsonResponse
{
    return response()->json($this->service->read($id));
}
```

## Benefits:

- **Fast and efficient:** Avoid repetition of tasks by automatically generating the files necessary to implement a
  RESTful API.

- **Clean and organized code:** By following the Repository pattern and separating data access logic from business
  logic, code consistency and maintainability is promoted.

- **Instant Functional API:** After running the command and performing the necessary migrations, your API will be ready
  to use immediately.

- **Flexibility and customization:** Although default files are generated, they can be modified according to the
  specific needs of the project.

## Usage

1. Install the package using Composer:

```shell
composer require oscabrera/model-repository
```

2. Run the command to generate the API:

```shell
php artisan make:repository DummyModel --seed --migration --service --controller --request --factory 
```

Alternatively, you can use the --all option to generate all available components at once:

```shell
php artisan make:repository DummyModel --all
```

3. Customize the generated code according to your needs.

### In the Model:

Is important use properties `$fillable` and `$hidden` in your model.

in `$hidden` you have to add `id` in your model.

```php
protected $hidden = [
        'id',
    ];
```

In `$fillable` you should add all the properties you want to be returned by your model.

4. Migrate the database:

```shell
php artisan migrate
```

5. And ready! You can now access your full RESTful API for the model.

## File location:

The files generated by the make:repository command are created inside a folder with the name of the given model.

```
├── app
│   ├── Contracts
│   │   ├── Repositories
│   │   │   └── Name
│   │   │       └── INameRepository.php
│   │   └── Services
│   │       └── Name
│   │           └── INameService.php
│   ├── Http
│   │   ├── Controllers
│   │   │     └── Name
│   │   │         └── NameController.php
│   │   └── Requests
│   │         └── Name
│   │             └── NameRequest.php
│   ├── Models
│   │   └── Name
│   │       └── Name.php
│   ├── Repositories
│   │   └── Name
│   │       └── NameRepository.php
│   └── Services
│       └── Name
│           └── NameService.php
├── database
│   ├── migrations
│   │   └── 2024_03_17_022718_create_names_table.php
│   ├── Seeders
│   │   └── NameSeeder.php
│   └── Factories
│       └── DummyModel
│           └── DummyModelFactory.php
```

**Benefits of organizing by folders:**

*Organization*: Keeps code organized and easy to find.

*Modularity*: Allows the logic of each component of the API to be separated.

*Maintenance*: Facilitates maintenance and updating of the code.

## **Conclusion:**

This Laravel package allows you to create complete Restful APIs quickly and easily, with a better development experience
thanks to Spatie Ignition.

## Description
This project provides a complete implementation of a model repository using the Laravel framework. The goal is to facilitate the development of complete RESTful APIs for your Laravel models, with CRUD (Create, Read, Update, Delete) functionality and filtering and sorting options.

## Technologies:

- Laravel
- VitePress
- PHP

## Characteristics:

- Automatic generation of complete RESTful API for your models.
- Support for CRUD (Create, Read, Update, Delete).
- Filtering and sorting options.
- Validation of input data.
- Complete documentation with VitePress.

## Use:

- The documentation is organized into sections and chapters.
- You can browse the documentation using the side menu or the search bar.
- Each section contains detailed information on a specific VitePress topic.
- The tutorials will guide you through the steps necessary to perform common tasks.
- The API reference provides you with complete information on all VitePress features and options.

## Contributions:

- Contributions to this project are appreciated.
- If you find any bugs or have any suggestions, feel free to create an issue on GitHub.

### keywords:

> Laravel, RESTful API, Repository Patter, CRUD,  API, Repositories, Services, File generation
 
## **Additional resources:**

- [Spatie Ignition](https://github.com/spatie/ignition)
- [Oscabrera JSON:API Format Paginate](https://oscabrera.github.io/laravel-json-api-format-paginate)
- [Oscabrera Query Filters](https://oscabrera.github.io/laravel-query-filters)
