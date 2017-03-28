module.exports = function(grunt){

require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

/*Automate after save check*/
			watch: {
		    html: {
		        files: ['index.html'],
		        tasks: ['htmlhint']
		    },
		    js: {
		        files: ['assets/js/*.js'],
		        tasks: ['uglify']
		    },
		    css: {
		        files: ['assets/sass/**/*.scss'],
		        tasks: ['buildcss']
		    },
		    concat: {
		        files: ['assets/css/*.css'],
		        tasks: ['concat']
		    }

		},
/*Automate after save check*/

/*Minify JS*/
		uglify: {
		    build: {
		        files: {
		            'assets/js/concat/logic.min.js': ['assets/js/logic.js']
		        }
		    }
		},

/*Minify JS*/
		concat: {
		    options: {
		      separator: '/* anotehr style */'
		    },
		    dist: {
		      src: [
		      'assets/css/common.css',
		      'assets/css/new-styles.css',
		      'assets/css/font-awesome.css',
		      'assets/css/styles.css',
			  'assets/css/fonts.css'],
		      dest: 'assets/css/concat/template.concat.css'
		    }
		  },
		  concatjs: {
		    options: {
		      separator: ';'
		    },
		    dist: {
		      src: ['assets/css/template.css','assets/css/normalize.css'],
		      dest: 'assets/css/concat/template.concat.css'
		    }
		  },
		cssc: {
		    build: {
		        options: {
					debugInfo: true,
					sortSelectors: true,
					lineBreaks: true,
					sortDeclarations:true,
					consolidateViaDeclarations:true,
					consolidateViaSelectors:false,
					consolidateMediaQueries:true,
		        },
		        files: {
		            'assets/css/new-styles.css': 'assets/css/new-styles.css'
		        }
		    }
		},
		cssmin: {
		    dist: {
		      src: ['assets/css/concat/template.concat.css'],
		      dest: 'assets/css/concat/template.concat.min.css'
		    }
		  },

		sass: {
		    build: {
		        files: {
		            'assets/css/new-styles.css': 'assets/sass/styles.scss'
		        }
		    }
		},

		// Use to automatically include the bower managed
        // dependencies(vendor libraries) in the index.html
        wiredep : {
            target : {
                src : [
                    'index.php'
                ]
            }
        },
		bower_concat: {
			all: {
				dest: 'assets/js/concat/bower.js',
				cssDest: 'assets/css/concat/_bower.css',
				exclude: [
					"jquery"
				],
				dependencies: {
					"font-awesome":'jquery'
				},
				bowerOptions: {
					relative: false
				}
			}
		}
    });

    grunt.registerTask('bower_concat', ['bower_concat']);
    grunt.registerTask('buildcss',  ['sass', 'cssc', 'concat','cssmin']);
    grunt.registerTask('wiredeps', ['wiredep']);
};