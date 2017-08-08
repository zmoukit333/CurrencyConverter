# Currency converter

## Introduction

Create secure currency converter. Without page reload. Performance optimized.

It's one page in browser with controls in a row. They are numerical input for converted amount, dropdown with given currencies, dropdown with desired currencies, button to swap currencies (given and desired). 

Calculated result and history of last 5 conversations must be showed above row with controls. 

Result and history looks like : ```{CURRENCY_IN} {amount} -> {result} {CURRENCY_OUT}```. All content vertically and horizontally positioned in the center of page. Use AJAX to retrieve results from server. Validate user inputs via javascript.

## Apache setup

To setup apache, setup a virtual host to point to the public/ directory of the project and you should be ready to go! It should look something like below:

```
<VirtualHost *:80>
    ServerName currencyconverter
    DocumentRoot /path/to/currencyconverter/public
    <Directory /path/to/currencyconverter/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

## Database

We will also need to store our conversations history into a database. We will only need one table.

1 - Please create a new Database in your Mysql Server :

```
CREATE DATABASE currency
```

2 - Import data/currency.sql file.

## application.ini

Please change the usename & password in application/configs/application.ini

```
resources.db.params.username = YOUR_USERNAME
resources.db.params.password = YOUR_PASSWORD
```

