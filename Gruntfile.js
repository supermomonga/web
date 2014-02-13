'use strict';

module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
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

  grunt.registerTask('test', ['jshint']);
};
