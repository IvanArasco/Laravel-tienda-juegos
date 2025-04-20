module.exports = function(grunt) {
    // 1) Configuración de las tareas
    grunt.initConfig({
      // Compilar SCSS → CSS
      sass: {
        dist: {
          options: {
            implementation: require('sass') 
          },
          files: {
            'public/css/app.css': 'resources/sass/app.scss'
          }
        }
      },
  
      // Minificar CSS → app.min.css
      cssmin: {
        target: {
          files: {
            'public/css/app.min.css': ['public/css/app.css']
          }
        }
      },
  
      // Uglify JS → app.min.js
      uglify: {
        target: {
          files: {
            'public/js/app.min.js': ['resources/js/app.js']
          }
        }
      },
  
      // Vigilar cambios y recompilar
      watch: {
        styles: {
          files: ['resources/sass/**/*.scss'],
          tasks: ['sass', 'cssmin'],
          options: { spawn: false }
        },
        scripts: {
          files: ['resources/js/**/*.js'],
          tasks: ['uglify'],
          options: { spawn: false }
        }
      }
    });
  
    // 2) Cargar los plugins de Grunt
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
  
    // 3) Registrar tareas
    // `grunt` compila + minifica CSS y JS
    grunt.registerTask('default', ['sass', 'cssmin', 'uglify']);
    // `grunt dev` inicia el watch
    grunt.registerTask('dev', ['watch']);
  };
  