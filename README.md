# wp-config.php boilerplate

PHP commandline script that fetches WP security salts from https://api.wordpress.org/secret-key/1.1/salt/ , the wp-config.php template from https://gist.github.com/dnaber-de/e4a78f2354c5c5c1503f and sticks both together in a `wp-config.php` file in your current working directory. Requires git PHP 5.6 and the [CURL extension](http://de2.php.net/manual/en/book.curl.php).

## Usage

```
$ wpconfig 
```
This will create a `wp-config.php` in your current working directory. It will not override an existing one.
 
```
$ wpconfig /path/to/wp-config.php
```
Creates the specified file, if not exists.

### Options

```
$ wpconfig -h|--help
```
Prints a helping message

```
$ wpconfig -q|--quiet
```
Suppress all output from the script, even error messages.

## Installation

### Git
Clone the repository and symlink `bin/wpconfig` into your binary directory (e.g. `/usr/local/bin` or ~/bin`).

### Composer

Run
```
$ composer global require dnaber/wp-config-boilerplate
```
 