## Requirements

 - A Linux OS running PHP 7+
 - Git
 - Composer

## Installation

Assuming you have the above requirements, in the terminal the following commands can be written.

```bash
git init
git pull git@github.com:kieron76/PayDateCSVGenerator.git
composer install
```
 
## Usage

Basic usage - this will write this month's pay dates and the next 11 month's dates
```bash
php application export
```

With a custom date - this will write the supplied month's pay dates and the following 11 month's dates
```bash
php application export 20-02-2024
```

## License

Open-source software licensed under the [MIT license]
