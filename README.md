# Deepwater Project

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

## Development

To build the angular app and check for changes while development use the following:

```bash
ng build --watch
```
