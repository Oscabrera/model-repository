# Ensuring code quality in the package

In Laravel application development, maintaining code quality is crucial to ensure the project's stability, readability,
and maintainability. To achieve this, you can leverage static analysis tools like **PHPStan** and Laravel **Pint**.

## PHPStan

[PHPStan](https://phpstan.org/) is a static analyzer for PHP that detects type errors, logic issues, and code
violations. It's a powerful tool
to guarantee code reliability and security.

You can use [larastan/larastan](https://github.com/larastan/larastan) to analyze your code.

## Laravel Pint

Laravel Pint is a code formatting tool that enforces Laravel's code style conventions on your project. It helps maintain
consistent and easily readable code.

in this project we use [PSR-12](https://www.php-fig.org/psr/psr-12/) for code formatting.

## Using PHPStan and Laravel Pint Together

By using PHPStan and Laravel Pint together, you can ensure your Laravel code is error-free, consistent with Laravel's
code style, and easy to maintain. PHPStan catches type errors and logic issues, while Laravel Pint takes care of code
formatting.

Utilizing these tools can significantly improve your Laravel code quality and reduce the risk of errors and
inconsistencies.

## Benefits of Using PHPStan and Laravel Pint

- **Reduced Errors**: PHPStan detects type errors and logic problems before code execution, saving you debugging time
  and
  effort.
- **More Consistent Code**: Laravel Pint enforces Laravel's code style conventions, making your code easier for other
  developers to read and understand.
- **Easier Code Maintenance**: Well-formatted and documented code is simpler to maintain and update.
- **Increased Confidence in Code Quality**: Using PHPStan and Laravel Pint allows you to have greater confidence in the
  quality of your Laravel code.

## Conclusion

PHPStan and Laravel Pint are valuable tools for ensuring code quality in Laravel projects. By using these tools in
combination, you can enhance the reliability, readability, and maintainability of your codebase.