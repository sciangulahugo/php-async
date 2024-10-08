# Biblioteca PHP Async

Esta biblioteca proporciona una forma sencilla de ejecutar código PHP de manera asíncrona. Permite crear y ejecutar tareas en segundo plano sin bloquear el hilo de ejecución principal.

## Características principales:
- Crear tareas asíncronas utilizando closures
- Ejecutar tareas en segundo plano
- Ligera y fácil de usar

## Ejemplo de uso:

```php
require_once __DIR__ . '/vendor/autoload.php';

use SciangulaHugo\Closure\Async;

$start = microtime(true);

$async = new Async();

$async->create(function () {
    sleep(10);
    file_put_contents('output.txt', 'Hello World');
});

$async->run();

$end = microtime(true);

print_r("Time of execution: " . ($end - $start) . " seconds" . PHP_EOL);

// Imprime "Tiempo de ejecución: 0.006659984588623 segundos"
// El archivo output.txt se creó a las 10.006129026413 segundos después
```

En este ejemplo, se crea una tarea asíncrona que simula una operación de larga duración. La tarea se ejecuta en segundo plano mientras el script principal continúa ejecutándose.

## Instalación:

Para instalar esta biblioteca, puedes usar Composer:

```bash 
composer require sciangulahugo/php-async
```

## Contribución:

Si encuentras algún problema o tienes sugerencias para mejorar esta biblioteca, por favor, abre un issue en el repositorio de GitHub.

## Licencia:

Esta biblioteca está bajo la licencia MIT.
