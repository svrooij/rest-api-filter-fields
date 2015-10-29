module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		wp_readme_to_markdown: {
			your_target: {
				files: {
					'readme.md': 'readme.txt'
				}
			}
		},
		copy: {
			main: {
				files:[
					{expand: true, nonull: true, src: ['readme.txt','LICENSE','*.php'], dest: 'build/'}
				]
			}
		},
		wp_deploy: {
			deploy: {
				options: {
					plugin_slug: 'rest-api-filter-fields',
					svn_user: 'svrooij',
					build_dir: 'build',
				}
			}
		}
	});

	grunt.loadNpmTasks( 'grunt-wp-readme-to-markdown' );
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-wp-deploy');

	grunt.registerTask( 'build', [
		'wp_readme_to_markdown',
		'copy',
	] );

	grunt.registerTask('deploy' ,[
		'wp_readme_to_markdown',
		'copy',
		'wp_deploy'
	]);

};
