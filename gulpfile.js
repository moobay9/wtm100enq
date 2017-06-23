var gulp        = require("gulp");
var loadPlugins = require('gulp-load-plugins');
var $           = loadPlugins();
var browserSync = require("browser-sync");
var browserify  = require("browserify");
var config      = require("./config");
var glob        = require("glob");
var source      = require('vinyl-source-stream')

// Plugin to function
function cached(task){ return $.cached(task);}
function using(){ return $.using();}
function sass(obj){ return $.sass(obj);}
function notify(){ return $.notify.onError(config.notify.errormsg);}

// browser-sync option
function bsinit(path, port, open, uiport){
  path   = path   || config.virtualhost.vhost;
  port   = port   || config.virtualhost.browserSyncPort;
  open   = open   || false;
  uiport = uiport || 8070;

  browserSync.init({
    proxy:  path,
    port:   port, // Port 1024 ~ 65535
    logPrefix: config.virtualhost.vhost,  // Console logging prefix
    notify: true,
    open:   open, // Option : true, false, "external", "tunnel"
    snippetOptions: {
      ignorePaths: "fuel/app/logs/**/*.php",
    },
    // startPath: "/list/",// base open directory
    ui: false
    // ui: {
    //   port: uiport // port change
    // }
  });
}

// setting local server
gulp.task("bs-init", function(){
  bsinit();
});

// setting vagrant server
gulp.task("bs-init-live", function(){
  bsinit(config.virtualhost.vhostLive);
});

// setting vagrant server
gulp.task("bs-init-builtin", function(){
  bsinit(config.virtualhost.vhostBuiltin);
});

// browser sync
gulp.task("bs-reload", function() {
  browserSync.reload();
});

// Sass
gulp.task('sass', function(){
  gulp.src(config.sass.src + '*.scss')
    .pipe(sass({
      outputStyle: 'compressed',
      indentWidth: 4
    }).on('error', notify()))
    .pipe($.autoprefixer({
      autoprefixer: { browsers: config.prefixBrowsers}
    }))
    .pipe(gulp.dest(config.sass.dst))
    .pipe(browserSync.stream());
});

// React
gulp.task('react', function(){
  return browserify({
              entries: glob.sync(config.react.src),
              extensions: ['jsx', 'js'],
              transform: ['reactify']
         })
         .bundle()
         .on('error', notify())
         .pipe(source(config.react.output))
         .pipe(gulp.dest(config.react.dst))
});


// Directory watch
gulp.task('watch', function () {
    gulp.watch(config.watch.sass_src, ['sass']);
    gulp.watch(config.watch.react_src, ['react']);
    gulp.watch(config.watch.target, ['bs-reload']);
});


// gulpfile watch
var spawn = require('child_process').spawn;
    gulp.task('default', function() {
        var process;
        function restart() {
            if (process) {
              process.kill();
            }
            process = spawn('gulp', ['default-task'], {stdio: 'inherit'});
        }
    gulp.watch('gulpfile.js', restart);
    restart();
});

var builtin = require('child_process').exec;
gulp.task('builtin-sv', function (cb) {
  builtin('php -S ' + config.virtualhost.vhostBuiltin + ' -t ' + config.documentRoot, function (err, stdout, stderr) {
    cb(err);
  });
})

// start
gulp.task('gulp-start', function (){
  $.run('echo Gulp Start').exec()
  .pipe($.notify(config.notify.msg));
});

// default task
gulp.task("default-task", [
    "gulp-start",
    "bs-init",
    "watch"
]);

// vagrant task
gulp.task("live", [
    "gulp-start",
    "bs-init-live",
    "watch"
]);

// vagrant task
gulp.task("self", [
    "builtin-sv",
    "gulp-start",
    "bs-init-builtin",
    "watch"
]);
