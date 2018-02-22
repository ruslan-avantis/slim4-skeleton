# Slim Framework 4 Skeleton Application & PHP 7.2.2

Use this skeleton application to quickly setup and start working on a new Slim Framework 4 application. This application uses the latest Slim 4 with the [Adapter\TemplateEngine](https://github.com/pllano/template-engine) template renderer. It also uses the Monolog logger.

This skeleton application was built for [AutoRequire](https://github.com/pllano/auto-require). This makes setting up a new Slim Framework application quick and easy.

## Demo URI
- [joomimart.com](https://joomimart.com/)
- https://joomimart.com/test
- https://joomimart.com/test/
- https://joomimart.com/test1/test2/12345
- https://joomimart.com/api/json/test-1
- https://joomimart.com/api/json/test-1/2018?param1=12345&param2=67890
 
## Additionally has:
- [AutoRequire](https://github.com/pllano/auto-require) to PSR-0 and PSR-4 standards.
- Multi [TemplateEngine](https://github.com/pllano/template-engine): [`Twig`](https://github.com/twigphp/Twig) [`PhpRenderer`](https://github.com/slimphp/PHP-View) [`Smarty`](https://github.com/smarty-php/smarty) [`Dwoo`](https://github.com/dwoo-project/dwoo) [`Fenom`](https://github.com/fenom-template/fenom)  [`Mustache`](https://github.com/bobthecow/mustache.php) [`Blade`](https://github.com/PhiloNL/Laravel-Blade)
- Caching through [Cache Adapter](https://github.com/pllano/cache): `Memcached`, `Memcache`, `Redis`, `Predis`, `Filesystem`, `JsonCache`
- [Controllers](https://github.com/pllano/slim4-skeleton/tree/master/vendor/app/Controllers)
- [Models](https://github.com/pllano/slim4-skeleton/tree/master/vendor/app/Models)
 
## Install the Application

Copy the files to the directory where you want to install the new Slim Framework application. Run the index.php

That's it! Now go build something cool.

## Configuration [settings.json](https://github.com/pllano/slim4-skeleton/blob/master/app/settings.json)
```json
{
    "template": {
        "front_end": {
            "template_engine": "twig",
            "template_package": "twig.twig",
            "cache": 0,
            "themes": {
                "template": "template_name",
                "templates": "templates",
                "dir_name": "\/..\/"
            }
        }
    },
    "db": {
        "master": "mysql",
        "slave": "elasticsearch",
        "mysql": {
            "host": "localhost",
            "dbname": "",
            "port": "",
            "charset": "utf8",
            "connect_timeout": "15",
            "user": "",
            "password": ""
        },
        "elasticsearch": {
            "host": "localhost",
            "port": "9200",
            "type": 1,
            "index": "apishop",
            "auth": 0,
            "user": "elastic",
            "password": "elastic_password"
        }
    },
    "cache": {
        "driver": "filesystem",
        "state": 0,
        "cache_lifetime": "3600",
        "dynamic": 0,
        "cpu": "80",
        "memory": "80",
        "vendor": "cache",
        "adapter": "apishop",
        "print": 0,
        "clear": 0,
        "filesystem": {
            "pool": "\\Cache\\Adapter\\Filesystem\\FilesystemCachePool",
            "filesystem_adapter": "\\League\\Flysystem\\Adapter\\Local",
            "filesystem": "\\League\\Flysystem\\Filesystem",
            "path": "cache\/_file_cache"
        },
        "json": {
            "pool": "\\ApiShop\\Adapter\\Cache\\JsonCache",
            "path": "cache\/_json_cache"
        },
        "memcached": {
            "pool": "\\Cache\\Adapter\\Memcached\\MemcachedCachePool",
            "host": "127.0.0.1",
            "port": "11211"
        },
        "predis": {
            "pool": "\\Cache\\Adapter\\Predis\\PredisCachePool",
            "host": "127.0.0.1",
            "port": "6379"
        },
        "memcache": {
            "pool": "\\Cache\\Adapter\\Memcache\\MemcacheCachePool",
            "host": "127.0.0.1",
            "port": "11211"
        },
        "redis": {
            "pool": "\\Cache\\Adapter\\Redis\\RedisCachePool",
            "host": "127.0.0.1",
            "port": "11211"
        }
    }
}

```

