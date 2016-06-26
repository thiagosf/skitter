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
      livereload: true,
      // livereload: {
      //   enable: true,
      //   filter: function(fileName) {
      //     if (fileName.match(/(src|gulpfile|live)/)) {
      //       return false;
      //     }
      //     return true;
      //   }
      // },
      directoryListing: false,
      open: true,
      fallback: 'index.html'
    }));
});

// Dist
gulp.task('dist', ['scripts', 'sass']);









// Default 
// gulp.task('default', ['sass', 'compress']);

// // Modulos 
// import gulp from 'gulp';
// // import sass from 'gulp-sass';
// import webserver from 'gulp-webserver';
// import gutil from 'gulp-util';
// import concat from 'gulp-concat';
// import minify from 'gulp-minify';
// // import babel from "gulp-babel";
// // import babelify from 'babelify';
// import browserify from 'browserify';
// import rename from 'gulp-rename';
// import sourcemaps from 'gulp-sourcemaps';
// import source from 'vinyl-source-stream';
// import buffer from 'vinyl-buffer';
// import watchify from 'watchify';
// import { assign } from 'lodash';

// // Configuration for Gulp
// const config = {
//   js: {
//     src: './src/index.jsx',
//     watch: ['./src/**/*', './src/**/**/*'],
//     outputDir: './public/js/',
//     outputFile: 'app.js',
//   },
//   css: {
//     watch: ['./sass/**/*'],
//     outputDir: './public/css/',
//   }
// };

// // Scripts
// function bundle() {
//   return b.bundle()
//     .on('error', gutil.log.bind(gutil, 'Browserify Error'))
//     .pipe(source(config.js.outputFile))
//     .pipe(buffer())
//     .pipe(sourcemaps.init({ loadMaps: true }))
//     .pipe(sourcemaps.write('./'))
//     .pipe(gulp.dest(config.js.outputDir));
// }
// const customOpts = {
//   entries: [config.js.src],
//   debug: true,
//   extensions: ['.jsx']
// };
// const opts = assign({}, watchify.args, customOpts);
// let b = watchify(browserify(opts), { poll: true });
// b.transform(babelify);
// b.on('update', bundle);
// b.on('log', gutil.log);
// gulp.task('scripts', bundle);

// // Sass
// gulp.task('sass', () => {
//   return gulp.src(config.css.watch)
//     .pipe(sass({ outputStyle: 'compressed' }).on('error', gutil.log))
//     .pipe(gulp.dest(config.css.outputDir));
// });
// gulp.task('sass:watch', () => {
//   return gulp.watch(config.css.watch, ['sass']);
// });

// // Minify
// gulp.task('compress', ['scripts'], () => {
//   return gulp.src(config.js.outputDir + config.js.outputFile)
//     .pipe(minify({
//       ext: { min:'.min.js' }
//     }))
//     .pipe(gulp.dest(config.js.outputDir))
// });

// // Webserver
// gulp.task('ws', ['sass:watch', 'scripts'], () => {
//   return gulp.src('public')
//     .pipe(webserver({
//       host: '0.0.0.0',
//       livereload: true,
//       directoryListing: false,
//       open: true,
//       fallback: 'index.html'
//     }));
// });

// // Default 
// gulp.task('default', ['sass', 'compress']);
