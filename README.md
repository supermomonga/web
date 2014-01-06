Ranyuen web site
================
This is [Ranyuen web site](http://ranyuen.com/) application.

Contribute
==========
You MUST understand what we do, and what you do.

Developing tools we use
-----------------------
- Vagrant
- EditorConfig
- Git
- Apache
- JSHint
- Composer
- Bundler
- Grunt
- PHP
- npm
- PSR
- Bower

Directory structure
-------------------
```
./
  Vagrantfile
  ranyuen_web/
    .editorconfig     Configuration file for EditorConfig.
    .gitignore        Configuration file for Git to ignore files.
    .htaccess         Configuration file for Apache to redirect HTTP request to index.php
    .jshintrc         Configuration file for JSHint.
    composer.json     Configuration file for Composer.
    composer.lock
    composer.phar
    Gemfile           Configuration file for Bundler.
    Gemfile.lock
    Gruntfile.js      Configuration file for Grunt.
    index.php         Entry point of this Web site.
    package.json      Configuration file for npm.
    php-cs-fixer.phar
    Rakefile          Configuration file for rake.
    README.md
    .bundle/
    .git/
    .sass-cache/
    assets/
      bower.json Configuration file for Bower.
      bower_components/
      images/
      javascripts/
      stylesheets/
    config/
    lib/
    logs/
    node_modules/
    templates/
    vendor/
```

Classes
-------
```
\Ranyuen
  \Ranyuen\App
  \Ranyuen\Config
  \Ranyuen\Helper
  \Ranyuen\Logger
  \Ranyuen\Renderer
```
