Ranyuen web site
================
This is [Ranyuen web site](http://ranyuen.com/) application.

Install on a production machine
===============================
1. Clone this repository. `git clone https://github.com/Ranyuen/web.git`
2. Install PHP dependencies. `./composer.phar install --no-dev`
2. Attache Apache DocumentRoot to the repo's root directory.

That's all.

Install for development
=======================
1. Install PHP, node.js, Ruby and Git on your Linux VM.
2. Clone this repository.
3. Install dependencies.

   ```bash
   ./composer.phar install
   npm install
   npm install -g bower
   ```
4. Start the server. `sudo php -S 0.0.0.0:80 index.php`

Contribute
==========
You MUST understand what we do, and what you do.

Build files.

```bash
bundle exec rake build
```

Lint and run tests.

```bash
bundle exec rake test
```

Deploy.

```bash
bundle exec rake deploy
```
