'use strict';

module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    exec: {
      deploy: {
        command: 'bundle exec rake deploy',
        stdout: true,
        stderr: true,
        stdin: true
      },
      build: {
        command: 'bundle exec rake build',
        stdout: true,
        stderr: true
      },
      fixer: {
        command: 'php php-cs-fixer.phar fix index.php --level=all && ' +
                 'php php-cs-fixer.phar fix lib/ --level=all',
        stdout: true,
        stderr: true
      },
      lint: {
        command: 'php -l index.php && ' +
                 'find lib/**/*.php -exec php -l {} \\;',
        stdout: false,
        stderr: true
      }
    },
    jshint: {
      options: {jshintrc: '.jshintrc'},
      all: [
        'Gruntfile.js',
        'assets/javascripts/*.js'
      ]
    }
  });

  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-exec');

  grunt.registerTask('build', ['exec:build']);
  grunt.registerTask('deploy', ['exec:deploy']);
  grunt.registerTask('test', ['jshint', 'exec:lint', 'exec:fixer']);
};
