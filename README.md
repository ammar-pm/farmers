# Mzr3ty
This is a short description on the farmers registry
## Necessary Software

* MySQL8+
* PHP 7.2+
* Apache

## Clone repository to your machine

## Setup instructions

### 1. Create .env file with the command ```cp .env.example ./.env```
### 2. Open .env and update it to the appropriate variables
### 3. Retrieve missing 'private' variables from dev leads
### 4. Generate encryption key for laravel ```php artisan key:generate```
### 5. Restore DB from backup get this from dev leads
### 6. Add the functions that are not in the database backup
```
DELIMITER $$
           CREATE FUNCTION rownum ()
           RETURNS int
           NO SQL NOT DETERMINISTIC
           BEGIN
             SET @var := @var + 1;
             return @var;
           END$$
           DELIMITER ;




create function p2() returns JSON DETERMINISTIC NO SQL return @p2;
```
### 7. Point apache to /public directory of code repository


## Log locations

The logs for Laravel can be found at /storage/logs

## Known Errors
Here are some known issues you may run into and work arounds. 

### If you get the error 'Error in query (1030): Got error 168 from storage engine' see 

For Mac:
https://gist.github.com/tombigel/d503800a282fcadbee14b537735d202c


### The server requested authentication method unknown to the client

After creating a MySQL user for your application change the authentication to native mysql using the command below. Change user_id and user_password.

```
ALTER USER 'user_id'@'%' IDENTIFIED WITH mysql_native_password BY 'user_password';```
```


## Necessary changes to plotly files 

to support Arabic style maps you should add this line : 
```
mapboxgl.setRTLTextPlugin('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.0/mapbox-gl-rtl-text.js');
```
to  

.\node_modules\plotly.js\src\plots\mapbox\index.js 

under 

```
'use strict';

var mapboxgl = require('mapbox-gl');
```

then 

```
npm run production 
```

## To minify produced assests 

Install  uglify-es which supports ecma 6 

```
npm install uglify-es -g
```

then run

```
uglifyjs --compress --mangle -- public/js/app.js > public/js/app.min.js
uglifyjs --mangle  -- public/js/vendor.js > public/js/vendor.min.js
```





"# mzr3ty test" 
