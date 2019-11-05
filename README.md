# Stock plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require allan/stock-cake-son
```

Update your 'config/bootstrap.php'.

```
 $this->addPlugin('Stock');
```


Run migrations

```
bin\cake migrations migrate --Plugin Stock
```