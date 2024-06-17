# Installing dependencies

Enable the following extensions:
- [PHP cURL](https://www.php.net/manual/en/book.curl.php) 
- [DOM](https://www.php.net/manual/en/book.dom.php)
- [Multibyte String](https://www.php.net/manual/en/book.mbstring.php)

On Linux (Ubuntu): 

```
apt-get install php-curl
apt-get install php-dom
apt-get install php-mbstring
```

# Running tests


```
vendor/bin/phpunit --bootstrap tests/bootstrap.php --no-configuration tests/sharepoint
```
