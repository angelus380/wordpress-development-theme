## ABOUT

A simple wordpress development environment with gulp.
I use it to create wordpress templates with SCSS and compiling JS and CSS files into minifid versions.


## Installing node and npm

If you don't have [node.js](https://nodejs.org/) install it from their website.
Then install the latest version of [npm](https://www.npmjs.com/) with the command bellow.

	npm install npm -g

## Installing dependencies

Run this command to install all dependencies. Warning that it may take some time depending on your machine.

	npm install


## Working with this environment

After installing node.js and npm you have to make some file changes.

1. Clone or download this repo into "wp-content" folder and name it whatever you wish,
2. In gulp.js change "your-theme-name" into the name of the theme of your choice,
3. In style.css and package.json change the theme information,
4. In gulp.js in the "JavaScript processing" section you can remove 2 parts of the code to prevent js comment removal and/or concatenation into a single file named scritp.js,
5. Put your files into the right folder,
6. Run "gulp" command.

Your development environment "src" folder should have these folders:

* fonts
* img
* js
* scss
* template (all wordpress php files should go here)
** screenshot.png
** style.css
* vendor

OBS:
Template folder is for all the php files like you would in a wordpress template (index, footer, header, etc). Vendor is for any framework you would put an minified version of (like Bootstrap or jQuery plugins). You could use npm for those frameworks anyway, but if you are not used to npm like me you can use "vendor" folder for know.

When you run the command "gulp" it will create a normal wordpress theme sctructure:

* css
** fonts
* img
* js
* all php files
* style.css
* screenshot.png

Cheers.