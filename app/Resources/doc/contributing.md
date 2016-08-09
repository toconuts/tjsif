Contributing
============

**Thank you** for your contributing!

Here are a few rules to follow in order to ease code reviews, and discussions before
maintainers accept and merge your work.

When you write codes, please follow the basic coding standard as follows:
  * [PSR-1](http://www.php-fig.org/psr/1/)
  * [PSR-2](http://www.php-fig.org/psr/2/)

and please, write [commit messages that make
sense](http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html).

Before submitting your Pull Request, you should 
  * run the test suite.
  * write or update unit tests.

Thank you!

## Running the test suite

Ensure that the required vendors are installed by running `composer install`.
The test suite requires the `php5-sqlite` extensions to be installed.

PHPUnit should be installed by composer. Run the tests with the
`./vendor/bin/phpunit` command.
