# Shoe Distribution Database
#### An exercise in PHP and MySQL databases | 07.21.17

by Max Scher

## Description
This program allows the user to track shoe brands as well as the store locations at which they are available for purchase. User can add/edit/delete entries for both store and brand list items.

## Setup
Download and Install MAMP:
* Download the free version of MAMP from the [MAMP Downloads Page](https://www.mamp.info/en/downloads). Both Mac OS X and Windows are available. (You'll need to have version 4.1.0 or higher for Mac and 3.3.0 or higher for Windows).
* Once downloaded, open the file:
    * For Mac: This is a.pkg file.
    * For Windows: This is an .exe file.
* At this point, Mac installation is actually complete.
* Windows users will be prompted with an installation wizard. The default values and settings suggested at each step are just fine (You may specify a different location for your MAMP installation, if you prefer, just remember exactly where it is; we'll need to locate our MAMP installation in the next step).

Configure Port Numbers:  
_You must configure Apache and MySQL to use the correct port numbers in MAMP._

* Launch your newly-installed MAMP program.
* A popup may appear upon first launch. If so, uncheck the option reading Check for MAMP Pro when starting MAMP (You may upgrade to MAMP Pro later, but the free version meets all requirements for our course) then click Launch MAMP.
* When MAMP launches you will be greeted by a small window with several options. Click Preferences.
* In the Preferences window, select the Ports tab.
* Set the Apache Port to 8888.
* Set the MySQL Port to 8889.
* Click OK to save your new port configurations.

Access Project Repository & Open Project
* Open GitHub site on your browser: https://github.com/maxobaxo/shoes
* Select the green dropdown menu to clone this repository.
* Copy the link for the GitHub repository.
* Open Terminal on your computer.
* In Terminal, perform the following steps:
    * type 'cd desktop' and press enter
    * type 'git clone' then paste the repository link, and press enter
    * type 'cd shoes' to access the path on your computer
    * type 'composer install' in terminal to download dependencies
* In MAMP, perform the following steps:
    * Select the Start Servers option.
    * Go to preferences>web server and click on the folder icon next to 'document root'.
    * Click on 'web' folder of project and hit 'select'.
    * Hit ok at the bottom of the preferences window.
* Open a new window in your browser, enter the URL: localhost:8888/phpMyAdmin
    * Choose the Import tab and select the shoes.sql.zip file and click Go.
    * It's important to make sure you're not importing to a database that already exists, so make sure that a database with the name shoes doesn't already exist locally.
* In your browser, enter the url 'localhost:8888' to view the webpage.

## Specifications
* It can allow the user to do the following:
    * add and edit store information.
    * add a new (or associate an existing) brand to a given store.
    * edit brand information.
    * delete a store from the database.
    * delete a brand from the database.
    * delete all of the brands at a given store.
    * delete all stores in the database.
    * delete all brands in the database.
* It will not allow duplicate entries of brand names or repeat combinations of store name & city.
* It will not allow empty entries for store name or brand name.

## Languages/Technologies Used
Git, HTML, PHP, Silex, Twig, PHPUnit, CSS, SQL, MySQL, Apache, MAMP

## License Information
This application is licensed under the MIT license.

Copyright &copy; Max Scher 2017
