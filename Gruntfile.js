module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    coffee: {
      compile: {
        expand: true,
        cwd: 'src/js',
        src: ['**/*.coffee'],
        dest: '.tmp/js',
        ext: '.js'
      }
    },
    copy: {
      dev: {
        files: [{
          expand: true,
          cwd: 'src',
          src: ['**/*.{jpg,ico,gif,png,js,eot,svg,ttf,woff,php}'],
          dest: 'dist'
        }, {
          expand: true,
          cwd: 'src',
          src: ['**/*.html'],
          dest: 'dist/pages'
        }, {
          expand: true,
          cwd: 'bower_components/font-awesome/fonts',
          src: ['**'],
          dest: 'dist/font'
        }, {
          expand: true,
          cwd: '.tmp/js',
          src: ['**/*.js'],
          dest: 'dist/js'
        }, {
          src: 'bower_components/fit.js/fit.js',
          dest: 'dist/js/fit.js'
        }]
      },
      dist: {
        files: [{
          expand: true,
          cwd: 'src',
          src: ['**/*.{ico,eot,woff,ttf,php}'],
          dest: 'dist'
        }, {
          expand: true,
          cwd: 'src',
          src: ['**/*.html'],
          dest: 'dist/pages'
        }, {
          expand: true,
          cwd: 'bower_components/font-awesome/fonts',
          src: ['*.{eot,ttf,woff}'],
          dest: 'dist/font'
        }, {
          src: 'bower_components/fit.js/fit.min.js',
          dest: 'dist/js/fit.js'
        }]
      }
    },
    imagemin: {
      dist: {
        files: [{
          expand: true,
          cwd: 'src',
          src: ['img/**/*.{png,gif,jpg}'],
          dest: 'dist',
        }]
      }
    },
    less: {
      dev: {
        options: {
          cleancss: false
        },
        files: [{
          expand: true,
          cwd: 'src',
          src: ['css/style.less'],
          dest: 'dist',
          ext: '.css'
        }]
      },
      dist: {
        options: {
          cleancss: true
        },
        files: [{
          expand: true,
          cwd: 'src',
          src: ['css/*.less'],
          dest: 'dist',
          ext: '.css'
        }]
      }
    },
    svgmin: {
      dist: {
        files: [{
          expand: true,
          cwd: 'src',
          src: ['**/*.svg'],
          dest: 'dist',
        }, {
          expand: true,
          cwd: 'bower_components/font-awesome/fonts',
          src: ['*.svg'],
          dest: 'dist/font'
        }]
      }
    },
    uglify: {
      dist: {
        options: {
          banner: '/* Copyright <%= grunt.template.today("yyyy") %> */\n'
        },
        files: [{
          expand: true,
          cwd: 'src',
          src: ['js/*.js'],
          dest: 'dist',
          ext: '.js'
        }, {
          expand: true,
          cwd: '.tmp/js',
          src: ['**/*.js'],
          dest: 'dist/js',
          ext: '.js'
        }]
      }
    },
    
    compress: {
      pack: {
        options: {
          archive: 'dist.zip'
        },
        files: [{
          expand: true,
          cwd: 'dist',
          src: ['**'],
          dest: '/',
        }]
      }
    },
    concurrent: {
      dev: ['copy:dev', 'less:dev'],
      dist: ['copy:dist', 'less:dist', 'imagemin:dist', 'uglify:dist', 'svgmin:dist'],
      watch: ['watch:copy', 'watch:less', 'watch:coffee']
    },
    clean: {
      statics: ['dist/css', 'dist/img', 'dist/font', 'dist/js', 'dist/pages'],
      pack: ['dist.zip'],
      postbuild: ['.tmp']
    },
    watch: {
      copy: {
        files: ['src/**/*.{jpg,ico,gif,png,js}'],
        tasks: ['copy:dev']
      },
      coffee: {
        files: ['src/js/**/*.coffee'],
        tasks: ['coffee:compile', 'copy:dev']
      },
      less: {
        files: ['src/css/*.less'],
        tasks: ['less:dev']
      }
    },
  });

  grunt.loadNpmTasks('grunt-concurrent');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-svgmin');

  grunt.registerTask('default', ['clean:statics', 'coffee:compile', 'concurrent:dev', 'clean:postbuild']);
  grunt.registerTask('spy', ['clean:statics', 'coffee:compile', 'concurrent:dev', 'concurrent:watch', 'clean:postbuild']);

  grunt.registerTask('dist', ['clean:statics', 'coffee:compile', 'concurrent:dist', 'clean:postbuild']);
  grunt.registerTask('pack', ['clean:statics', 'clean:pack', 'coffee:compile', 'concurrent:dist', 'compress:pack', 'clean:postbuild']);

};