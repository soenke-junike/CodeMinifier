Requirements:
PHP with Namespaces (do not know which Version)

For Building documentation:
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