# Usage

## Installation

1. Composer Dependency:

To leverage the functionalities offered by the `oscabrera/model-repository` package in your Laravel project, you'll need
to install it using Composer, the dependency management tool for PHP. Open your terminal or command prompt and navigate
to your project's root directory. Then, execute the following command:

```shell
composer require oscabrera/model-repository
```

This command instructs Composer to download the `oscabrera/model-repository` package from the Packagist repository and
include it in your project's dependencies.

### Generating the Repository (API)

2. Artisan Command:

Laravel provides a powerful command-line interface (CLI) known as Artisan. Within the Artisan suite,
the `make:repository` command serves as a convenient tool to generate a comprehensive set of code components that
constitute a fully functional RESTful API for your model.

To utilize this command and generate the API for your model (`DummyModel` in this example), execute the following
command in your terminal:

```shell
php artisan make:repository DummyModel --seed --migration --service --controller --request --resource --collection --factory
```

Alternatively, you can use the --all option to generate all available components at once:

```shell
php artisan make:repository DummyModel --all
```

This is an example of the output you'll see after running the command:

![Command Output](/src/images/make_repository.png)

## Command Breakdown:

php artisan: Invokes the Artisan CLI.
make:repository: Specifies the Artisan command for generating a repository.
DummyModel: Denotes the name of your model for which the API will be created.

### Optional Flags:

- **`--seed, -sd`**: Generates a seed file to populate your database with sample data for testing purposes.
- **`--migration, -m`**: Creates a migration file to define the database schema for your model.
- **`--factory, -f`**: Generates a factory class to generate dummy data for your model.
- **`--service, -s`**: Generates a service class to encapsulate business logic related to your model operations.
- **`--controller, -c`**: Creates a controller class that handles incoming API requests and interacts with the service
  layer.
- **`--request, -r`**: Generates request classes for validation and data formatting during API interactions.
- **`--all`**: Creates all structure for working with the Repository.
- **`--force`**: Overwrites existing files if they already exist.

### Customization:

The generated code files provide a solid foundation for your API. However, you might need to customize these files
further to tailor them to your specific project requirements. Review the generated code carefully and make modifications
where necessary to fine-tune the API's behavior and functionality.

### In the Model:

Is important use properties `$fillable` and `$hidden` in your model.

in `$hidden` you have to add `id` in your model.

```php
protected $hidden = [
        'id',
    ];
```

## Database Migration

3. Applying Database Schema Changes:

After generating the API components, it's crucial to apply the corresponding database schema changes outlined in the
generated migration file. To execute the migration and create the necessary tables in your database, run the following
Artisan command:

```shell
php artisan migrate
```

This command processes the generated migration file, instructing your database to create the tables required for your
model's data.

## Running the API

4. Ready for Action!

Upon successful installation, code generation, and database migration, your project is now equipped with a fully
functional RESTful API for your model (`DummyModel`). You can interact with this API using various tools and techniques,
depending on your preferences and testing strategies. Here are some potential approaches:

- Direct API Calls: Employ HTTP request tools like Postman, curl, or an HTTP client library within your code to send
  requests to the API endpoints for various operations (create, read, update, and delete) on your model's data.

- Laravel's Testing Mechanisms: If you're utilizing Laravel's built-in testing framework (PHPUnit), you can craft unit
  tests to verify the API's functionality and ensure its correct behavior under various conditions.

---

I hope this expanded documentation provides a comprehensive and informative guide for installing, generating, and
utilizing the `oscabrera/model-repository` package effectively in your Laravel project. 