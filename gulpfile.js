var gulp = require("gulp"), // gulp task runner
    sass = require("gulp-sass"), // sass to css
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
// # gulp task 'gulp visi' and 'gulp ad'
//**********************************************************************
gulp.task("visi", function() {
  gulp.src(["visitor/src/sass/*.scss"])
      .pipe(frontNote({
        overview: './styleguide.md', // Overview page
      }))
      .pipe(plumber()) // non stop error
      .pipe(sass())
      .pipe(gulp.dest("./visitor/src/css"))
});

gulp.task("ad", function() {
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
        .pipe(plumber()) // non stop error
        .pipe(sass())
        .pipe(gulp.dest("./admin/src/css"))
  );
});

//**********************************************************************
// # gulp task 'gulp watch'
//**********************************************************************
gulp.task("watch", function() {
  gulp.watch(["visitor/src/sass/*.scss"],["visi"]);
  gulp.watch(["admin/src/sass/*.scss"],["ad"]);
});
