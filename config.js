// 参考
// https://github.com/greypants/gulp-starter/tree/master/gulp/tasks

var cmnDir = 'public/assets/';

module.exports = {
  documentRoot: 'public',

  virtualhost: {
    vhost:           "wtm100",
    vhostLive:       "192.168.67.23",
    vhostBuiltin:    "127.0.0.1:10080",
    browserSyncPort: "1063"
  },

  // sass
  sass: {
    src: cmnDir + 'sass/',
    dst: cmnDir + 'css/'
  },

  // react
  react: {
    src: cmnDir + "browserify/*",
    dst: cmnDir + "js/",
    output: 'bundle.js'
  },

  notify: {
    msg: {
      message: 'Gulp Start',
      sound:   'Submarine'
    },
    errormsg: {
      message: 'Error: <%= error.message %>',
      title:   'Error running something',
      sound:   'Glass'
    }
  },

  // prefixBrowsers
  prefixBrowsers: [
    'last 2 versions',
    'ie >= 11',
    'android >= 4.4',
    'iOS >= 8'
  ],

  // watch
  watch: {
    sass_src: cmnDir + "sass/**/*.scss",
    react_src: cmnDir + "browserify/*.{js,jsx}",
    target: [
      "./htdocs/**/*.html",
      "fuel/app/{classes,config,lang,views}/**/*.php",
      "htdocs/**/*.php",
      cmnDir + "js/*.js",
      cmnDir + "img/**/*",
      cmnDir + "css/*.css"
    ]
  }

}
