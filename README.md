# Processmaker Extended_pm_functions
This package provides the necessary base code to start the developing a package in ProcessMaker 4.

## Development
If you need to create a new ProcessMaker package run the following commands:

```
git clone https://github.com/ProcessMaker/extended_pm_functions.git
cd extended_pm_functions
php rename-project.php extended_pm_functions
composer install
npm install
npm run dev
```

## Installation
* Use `composer require processmaker/extended_pm_functions` to install the package.
* Use `php artisan extended_pm_functions:install` to install generate the dependencies.

## Navigation and testing
* Navigate to administration tab in your ProcessMaker 4
* Select `Skeleton Package` from the administrative sidebar

## Uninstall
* Use `php artisan extended_pm_functions:uninstall` to uninstall the package
* Use `composer remove processmaker/extended_pm_functions` to remove the package completely
