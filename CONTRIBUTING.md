# Contributing

Thank you for considering contributing to Laravel Tawseel! This document provides guidelines and instructions for contributing.

## Code of Conduct

By participating in this project, you agree to maintain a respectful and inclusive environment for everyone.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the issue list as you might find out that you don't need to create one. When you are creating a bug report, please include as many details as possible:

- **Laravel Version**: Which version of Laravel are you using?
- **PHP Version**: Which version of PHP are you using?
- **Package Version**: Which version of the package are you using?
- **Description**: A clear and concise description of what the bug is.
- **Steps to Reproduce**: Steps to reproduce the behavior.
- **Expected Behavior**: What you expected to happen.
- **Actual Behavior**: What actually happened.
- **Screenshots**: If applicable, add screenshots to help explain your problem.

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, please include:

- **Use Case**: A clear and concise description of the use case.
- **Proposed Solution**: A clear and concise description of what you want to happen.
- **Alternatives**: A clear and concise description of any alternative solutions or features you've considered.

### Pull Requests

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Add tests for your changes
5. Ensure all tests pass (`composer test`)
6. Ensure code style is correct (`composer format`)
7. Ensure static analysis passes (`composer analyse`)
8. Commit your changes (`git commit -m 'Add some amazing feature'`)
9. Push to the branch (`git push origin feature/amazing-feature`)
10. Open a Pull Request

## Development Setup

1. Clone the repository:
```bash
git clone https://github.com/mohamedhabibwork/laravel-tawseel.git
cd laravel-tawseel
```

2. Install dependencies:
```bash
composer install
```

3. Run tests:
```bash
composer test
```

4. Check code style:
```bash
composer format
```

5. Run static analysis:
```bash
composer analyse
```

## Coding Standards

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- Use PHP 8.3+ features where appropriate
- Write meaningful commit messages
- Add PHPDoc comments for all public methods
- Write tests for new features

## Testing

- All new features must include tests
- Tests should be written using Pest
- Aim for high test coverage
- Run tests before submitting a PR

## Code Style

- Code style is enforced using Laravel Pint
- Run `composer format` before committing
- The CI will automatically fix code style issues

## Static Analysis

- Static analysis is performed using PHPStan
- Run `composer analyse` before submitting a PR
- Ensure no PHPStan errors are introduced

## Commit Messages

- Use clear and descriptive commit messages
- Start with a capital letter
- Use the imperative mood ("Add feature" not "Added feature")
- Reference issues and pull requests when applicable

## Questions?

If you have any questions about contributing, please open an issue for discussion.

Thank you for contributing to Laravel Tawseel!
