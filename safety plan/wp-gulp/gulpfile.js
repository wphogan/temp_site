//
// Configuration:
// Use user's gulpfile config if it exists, else use default config
//

var config = require('./gulpfile_config').config;


//
// Define Gulp and auto-plugin loader
//
var gulp        = require('gulp'),
    plugins     = require('gulp-load-plugins')();

//
// Returns task.js file
//
function getTask(task) {
    return require('./tasks/' + task)(gulp, plugins, config);
}


//
// Gulp tasks:
//



// gulp images
gulp.task('images', getTask('gulp-images.js'));

// gulp js
gulp.task('js', getTask('gulp-js.js'));

// gulp styles
gulp.task('styles', getTask('gulp-styles.js'));

// gulp comb -- configure settings in /config/sass_lint_config.yml
gulp.task('comb', getTask('gulp-comb.js'));

// gulp lint -- configure settings in /config/sass_lint_config.yml
gulp.task('lint', getTask('gulp-lint.js'));

// gulp compass -- for sites using compass libraries
gulp.task('compass', getTask('gulp-compass.js'));

// gulp clean
gulp.task('clean', ['comb','lint','images']);

// gulp pxtorem
gulp.task('pxtorem', getTask('gulp-pxtorem.js'));

// gulp uncss
gulp.task('uncss', getTask('gulp-uncss.js'));

// gulp audit
gulp.task('audit', plugins.shell.task('pa11y localhost'));


// gulp -- set default task to 'watch'
gulp.task('default', ['styles', 'watch']);

// gulp watch
gulp.task('watch', function() {
  plugins.livereload.listen();
  gulp.watch(config.source.styles.sass_dir + '/**/*.+(scss|sass)', ['styles']);
  gulp.watch([config.source.theme_dir + '/**/*.+(php|js|css|scss|sass)'], function (files){
    plugins.livereload.changed(files)
  });
});


gulp.task('css', function() {
  gulp.src('css/style.css')
  gulp.src(config.destination  + '/**/*.+(css)')
    .pipe(plugins.pixrem())
    .pipe(gulp.dest(config.destination  +'/public/css/'));
});