# Using CustomException

The CustomException can be used to throw exceptions with additional information about the error, such as a title and
input data that caused the error.

## Example of Use

```php
<?php

use Oscabrera\JsonApiFormatPaginate\Exception\CustomException;

try {
    throw new CustomException(
        'Error in validation',
        'name is required',
        ['name' => null]
    );
} catch (CustomException $e) {
    echo $e->getTitle();
    echo $e->getMessage();
    print_r($e->getInput());
}
```

# CustomException Methods

- **__construct**: Initializes the exception with a title, a message, optional input data, an error code, and an
  optional previous exception.
- **getInput**: Returns the input data associated with the exception.
- **getTitle**: Returns the title of the exception.
- **__toString**: Returns a string representation of the exception, including the class name, error code, and error
  message.
  This class provides a structured way to handle and report errors in your application, making it easier to diagnose and
  correct problems.