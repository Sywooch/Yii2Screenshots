<p align="center">
    <h1 align="center">Yii2 Screenshots</h1>
    <br>
</p>

### Description
Yii2Screenshots is a Screenshot-Uploader as open-source project. It has a ShareX-Integration for easy uploading new taken screenshots. 
We want to provide a functional software for everyone - even easy to install.

### Requirements
You need at least a running Apache2-Webserver with running PHP 7.1
Even the packages for php: 
- php-common 
- php-dom 
- php-xml

### Installation
Put the cloned repository into your webserver-root and set the home-path to e.g. /var/www/html/screenshots/web/
The web-Folder is as you can see the index-path for the application.

Edit the following files:
- /config/web.php
- /config/db.php

Run this command in the webroot-Path (e.g. /var/www/html/screenshots) and accept it:
- php yii.php migrate

Now you're able to access this software! :)
