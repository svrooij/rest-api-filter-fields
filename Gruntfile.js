module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		wp_readme_to_markdown: {
			your_target: {
				files: {
					'readme.md': 'readme.txt'
				}
			}
		}
	});

	grunt.loadNpmTasks( 'grunt-wp-readme-to-markdown' );
	grunt.registerTask( 'build', [
		'wp_readme_to_markdown'
	] );

};
