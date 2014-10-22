'use strict';
module.exports = function (grunt) {

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({

        // watch for changes and trigger compass, jshint, uglify and livereload
        watch: {
            options: {
                livereload: true
            },
            sass: {
                files: ['assets/scss/**/*.scss'],
                tasks: ['sass', 'autoprefixer']
            },
            js: {
                files: ['assets/js/source/*.js'],
                tasks: ['uglify:dist']
            },
            jsdeps: {
                files: ['assets/js/source/deps/*.js'],
                tasks: ['uglify:deps']
            },
            livereload: {
                files: ['**/*.html', '**/*.php', 'assets/images/**/*.{png,jpg,jpeg,gif,webp,svg}']
            }
        },

        // compass and scss
        sass: {
            dist: {
                options: {
                    outputStyle: 'expanded',
                    imagePath: 'assets/images'
                },
                files: {
                    'assets/css/frontend.main.min.css': 'assets/scss/frontend.main.scss'
                }
            }
        },

        autoprefixer: {
            dist: {
                expand: true,
                flatten: true,
                src: 'assets/css/**/*.css',
                dest: 'assets/css/',
                options: {
                    browsers: ['last 2 version', 'ie 8', 'ie 9']
                }
            }
        },

        // uglify to concat, minify, and make source maps
        uglify: {
            dist: {
                files: {
                    'assets/js/frontend.main.min.js': [
                        'assets/js/source/*.js'
                    ]
                }
            },
            deps: {
                files: {
                    'assets/js/frontend.deps.min.js': [
                        'assets/js/source/deps/fastclick.js',
                        'assets/js/source/deps/jquery.cookie.js',
                        'assets/js/source/deps/placeholder.js',
                        'assets/js/source/deps/foundation.min.js'
                    ]
                }
            }
        }

    });

    // register task
    grunt.registerTask('Watch', ['watch']);

};