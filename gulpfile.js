/*
 * Copyright (C) 2016  Andreas Nurbo
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/*global require, use strict*/

var gulp = require('gulp');
var watch = require('gulp-watch');
var rename = require('gulp-rename');
var plumber = require('gulp-plumber');
var phpunit = require('gulp-phpunit');
var shell = require('gulp-shell');

gulp.task('css', function () {
  var stylus = require('gulp-stylus');
  var nano = require('gulp-cssnano');
  var postcss = require('gulp-postcss');
  var sourcemaps = require('gulp-sourcemaps');

  return gulp.src('./assets-src/css/**/*.styl')
    .pipe(plumber())
    .pipe(stylus())
    .pipe(sourcemaps.init())
    .pipe(postcss([require('autoprefixer'), require('precss')]))
    .pipe(gulp.dest('./assets/css'))
    .pipe(nano())
    .pipe(rename({extname: '.min.css'}))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./assets/css'));
});
gulp.task('js', function () {
  var uglify = require('gulp-uglify');
  var sourcemaps = require('gulp-sourcemaps');

  return gulp.src('./assets-src/js/**/*.js')
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(gulp.dest('./assets/js/'))
    .pipe(uglify())
    .pipe(rename({extname: '.min.js'}))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./assets/js/'));
});

gulp.task("watch", function () {
  watch("assets-src/**/*.styl", function () {
    gulp.start("css");
  });
  watch("assets-src/**/*.js", function () {
    gulp.start("js");
  });
});

gulp.task("test", function () {
  watch(["src/**/*.php", "tests/unit/**/*.php"], function () {
    gulp.start("phpunit");
  });
});

gulp.task('phpunit', function () {
  var options = {
    debug: false,
    statusLine: false
  };
  gulp.src('phpunit.xml')
    .pipe(phpunit('bin/phpunit --testsuite=unit', options));
});
