# Deepwater Project

A web app to manage sports activities. More to come !

Based on CakePHP 3.5 & Angular 5

## Install & configure Cake

```bash
composer install 
```  
```bash
cp config/app.default.php config/app.php && cp config/.env.default config/.env
```

Read and edit `config/app.php` and setup the `'Datasources'`.

## Install && configure Angular

```bash
npm -g install angular-cli
```  
```bash
npm install
```

## Web server configuration

Be sure to point your web server to webroot/index.php and not webroot/index.html otherwise you will get Angular only.

## Development

To build the angular app and check for changes while development use the following:

```bash
ng build --watch
```
