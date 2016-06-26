// Libs
var gulp = require('gulp');
var webserver = require('gulp-webserver');
var minify = require('gulp-minify');
var sass = require('gulp-sass');

// Scripts
gulp.task('scripts', ['compress']);

// Scripts watch
gulp.task('scripts:watch', function () {
  return gulp.watch('src/*.js', ['scripts']);
});

// Script compress
gulp.task('compress', function() {
  return gulp.src('src/*.js')
    .pipe(minify({
      ext:{
        src: '-debug.js',
        min: '.min.js'
      }
    }))
    .pipe(gulp.dest('dist'))
});

// Styles
gulp.task('sass', function () {
  return gulp.src('./scss/**/*.scss')
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(gulp.dest('./dist'));
});

// Styles watch
gulp.task('sass:watch', function () {
  gulp.watch('./scss/**/*.scss', ['sass']);
});

// Webserver
gulp.task('ws', ['scripts:watch', 'sass:watch'], function() {
  return gulp.src('.')
    .pipe(webserver({
      host: '0.0.0.0',
      port: 3000,
      livereload: true,
      directoryListing: false,
      open: true,
      fallback: 'index.html'
    }));
});

// Dist
gulp.task('dist', ['scripts', 'sass']);
