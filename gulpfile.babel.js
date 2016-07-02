// Libs
import gulp from 'gulp'
import webserver from 'gulp-webserver'
import minify from 'gulp-minify'
import sass from 'gulp-sass'
import autoprefixer from 'gulp-autoprefixer'
import concat from 'gulp-concat'
import babel from 'gulp-babel'

// Scripts
gulp.task('scripts', ['compress'])

// Scripts watch
gulp.task('scripts:watch', () => {
  return gulp.watch('src/**/*.js', ['scripts']);
})

// Script compress
gulp.task('compress', () => {
  // return gulp.src(['src/skitter.js', 'src/animations/*.js', 'src/*.js'])
    // .pipe(babel())
    // .pipe(concat('jquery.skitter.js', { newLine: ';' }))
  return gulp.src('src/*.js')
    .pipe(minify({
      mangle: false,
      ext:{
        src: '.js',
        min: '.min.js'
      }
    }))
    .pipe(gulp.dest('dist'))
})

// Styles
gulp.task('sass', () => {
  return gulp.src('./scss/**/*.scss')
    .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(gulp.dest('./dist'));
})

// Styles watch
gulp.task('sass:watch', () => {
  return gulp.watch('./scss/**/*.scss', ['sass']);
})

// Webserver
gulp.task('ws', ['scripts:watch', 'sass:watch'], () => {
  return gulp.src('.')
    .pipe(webserver({
      host: '0.0.0.0',
      port: 3000,
      livereload: true,
      directoryListing: false,
      open: true,
      fallback: 'index.html'
    }));
})

// Build
gulp.task('dist', ['scripts', 'sass'])
