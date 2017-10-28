var gulp = require("gulp"), // gulp task runner
    sass = require("gulp-sass"), // sass to css
    postcss = require('gulp-postcss'),
    cssnext = require('postcss-cssnext'),
    sassLint = require('gulp-sass-lint'), // lint
    csso = require('gulp-csso'), // compress sass
    uglify = require("gulp-uglify"), // compress
    merge = require('event-stream').merge, // task merge
    browser = require("browser-sync"), // auto reload browser
    plumber = require("gulp-plumber"), // non stop when error
    frontNote = require('gulp-frontnote'); // https://github.com/frontainer/frontnote


gulp.task("server", function() {
  browser({
    server: {
      baseDir: "./"
    }
  });
});
//**********************************************************************
// # gulp task 'gulp build'
//**********************************************************************
gulp.task("visi", function() {
  var processors = [
    cssnext()
  ];
  return merge(
    /* ### sass to css
    --------------------------------------------*/
    gulp.src(["visited/src/sass/*.scss"])
        .pipe(frontNote({
          out: '',
          assets: '',
          overview: './styleguide.md', // Overview page
          // css: './src/sass/style.scss' // style guide for css
        }))
        // .pipe(sassLint()) // lint
        // .pipe(sassLint.format())
        // .pipe(sassLint.failOnError())
        .pipe(plumber()) // non stop error
        .pipe(sass())
        .pipe(csso({ // compress
          restructure: false,
          sourceMap: true,
          debug: true
        }))
        .pipe(postcss(processors))
        //.pipe(autoprefixer()) // auto vender prefix
        .pipe(gulp.dest("./visited/src/css")),
    /* ### js minify
    --------------------------------------------*/
    gulp.src(["src/js/*.js"])
        .pipe(plumber()) // non stop error
        .pipe(uglify())
        .pipe(gulp.dest("./build/js"))
        .pipe(browser.reload({stream:true})) // browser auto reload
  );
});

gulp.task("ad", function() {
  var processors = [
    cssnext()
  ];
  return merge(
    /* ### sass to css
    --------------------------------------------*/
    gulp.src(["admin/src/sass/*.scss"])
        .pipe(frontNote({
          out: '',
          assets: '',
          overview: './styleguide.md', // Overview page
          // css: './src/sass/style.scss' // style guide for css
        }))
        // .pipe(sassLint()) // lint
        // .pipe(sassLint.format())
        // .pipe(sassLint.failOnError())
        .pipe(plumber()) // non stop error
        .pipe(sass())
        .pipe(csso({ // compress
          restructure: false,
          sourceMap: true,
          debug: true
        }))
        .pipe(postcss(processors))
        //.pipe(autoprefixer()) // auto vender prefix
        .pipe(gulp.dest("./admin/src/css")),
    /* ### js minify
    --------------------------------------------*/
    gulp.src(["src/js/*.js"])
        .pipe(plumber()) // non stop error
        .pipe(uglify())
        .pipe(gulp.dest("./build/js"))
        .pipe(browser.reload({stream:true})) // browser auto reload
  );
});

//**********************************************************************
// # gulp task 'gulp watch'
//**********************************************************************
gulp.task("watch", function() {
  gulp.watch(["visited/src/sass/*.scss"],["visi"]);
  gulp.watch(["admin/src/sass/*.scss"],["ad"]);
});
