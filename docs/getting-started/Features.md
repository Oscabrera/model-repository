# Features:

- **Automated file generation:** When you run the `php artisan make:repository` command, the following files will be
  automatically generated:
    - Model (`Model`): The Eloquent model that defines the database table structure.
    - Repository to manage the model (`Repository`): Implements the repository pattern to encapsulate database access
      logic.
- **Option to Automated file generation**
    - Service for the repository (`Service`): Implements the business logic for the model.
    - Controller for the service (`Controller`): Defines API routes and uses the service for API logic.
    - Validation requests (`Request`): Validates input data for controller routes.
    - Response resource (`Resource`): Makes it easier to create JSON responses for controller routes.
    - Resource collection (`Collection`): Defines the structure of the JSON response for the resource list.
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
#[Get(uri: 'model/{id}', name: 'model.read')]
public function read(string $id): JsonResponse
{
    return response()->json($this->service->read($id));
}
```