CodeMinifier
============

Extendable PHP classes to minify different types of sourcecode like JavaScript, CSS, PHP, Java, and others.

Reason for another code minifier: I looked around the web and found a lot minifier for different types of code. All of them where quite complicated and most of them not working correctly. I wanted to build a simple to use AND simple to understand AND extendable minifier.

## How it woks

The Heart of all minifiers in this project is the function AMinifier::getMinifiedCode($code). This function will strip the code by proceed the following steps:
* remove all strings from code and replace them with constants so we can replace constants back later
* replace comments, linebreaks, douple whitespaces
* remove whitespace before and after special character like (,),{,} and so on. For each type of code you have different special characters.
* replace back all constants with the corresponding string saved befor

See also: https://github.com/soenke-junike/CodeMinifier/blob/master/doc/overview.png

## How to use

In your 


## How to extend

## Additional comments

The Project is written in PHP but you can convert it within a couple of minutes into every other object oriented language.

## Requirements:
PHP with Namespaces (do not know which Version)
In Static function AMinifier::minify the function get_called_class() will be called. This function appeared in PHP 5.3 the first time.


For building documentation:
doxgen
graphviz


How to Build Documentation?
On Command-Line run:
$ cd PathToMinifier/
$ doxygen minifier.doxyfile

In Eclipse: 
- Install eclox (http://home.gna.org/eclox/) via update-Site
- right click on minifier.doxyfile
- Build Documentation.

You may see the created documentation in Webbrowser: file://PathToMinifier/doc/html/index.html


### Testing ###
run the script PathToMinifier/test/minifiertest on console or in webbrowser
$ php minifiertest.php


### How To Use ###
first you have to crate an instance of your Codeminifier - for example $cssMinifier = new CSSMinifier(); The Constructor is empty
