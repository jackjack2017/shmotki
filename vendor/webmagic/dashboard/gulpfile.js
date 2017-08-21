//TODO add style.css whithout minification
//TODO solve problem with plugin loads. See 'gulp-minify-css'
//TODO add diff files fo r js-libs and js-plugins

'use strict'

//Requires
var gulp = require('gulp');
var plugins = {
    'rename': require('gulp-rename'),
    'rigger': require('gulp-rigger'),
    'htmlclean': require('gulp-htmlclean'),
    'sourcemaps': require('gulp-sourcemaps'),
    'sass': require('gulp-ruby-sass'),
    'prefixer': require('gulp-autoprefixer'),
    'cssmin': require('gulp-minify-css'),
    'imagemin': require('gulp-imagemin'),
    'pngquant': require('imagemin-pngquant'),
    'uglify': require('gulp-uglify'),
    'versionAppend': require('gulp-version-append'),
    'watch': require('gulp-watch'),
    'browserSync': require("browser-sync"),
    'rimraf': require('rimraf'),
    'plumber': require('gulp-plumber'),
    'zip': require('gulp-zip'),
    'spritesmith': require('gulp.spritesmith'),
    'ttf2woff': require('gulp-ttf2woff'),
    'ttf2eot': require('gulp-ttf2eot')
}

var reload = plugins.browserSync.reload;

/*
 * Use for changing file placing 
 * use 'prod' or 'dev'
 */
var dev_mode = "prod";
var main_project_path = 'public';

//Path config
var path = {
    build: {
        html: '../',
        css: function () {
            return dev_mode === 'prod' ? 'src/public/css/' : '../../' + main_project_path + '/webmagic/dashboard/css/'
        },
        js: function(){
            return dev_mode === 'prod' ? 'src/public/js/' : '../../' + main_project_path + '/webmagic/dashboard/js/'
        },
        img: 'src/public/img/',
        fonts: 'src/public/fonts/',
        sprites: 'sprite.png'
    },
    src: {
        css: 'resources/assets/sass/style.scss',
        js: {
            def: 'resources/assets/js/admin.js'
        },
        img: 'resources/assets/img/**/*.*',
        fonts: 'resources/assets/fonts/*.ttf',
        icon_fonts: 'bower_components/adminlte/bootstrap/fonts/*',
        sprites: 'resources/assets/img/sprites/*.*',
        spritesSASS: 'resources/assets/sass'
    },
    watch: {
        css: 'resources/assets/sass/**/*.scss',
        js: 'resources/assets/js/**/*.js',
        img: 'resources/assets/img/**/*.*',
        fonts: 'resources/assets/fonts/**/*.*',
        sprite: 'resources/assets/img/sprites/*.*'
    },
    clean: '../build/'
};

gulp.task('sprite', function() {
    var spriteData = gulp.src(path.src.sprites).pipe(plugins.spritesmith({
        imgName: path.build.sprites,
        cssName: '_sprite.scss',
        cssVarMap: function(sprite) {
            sprite.name = 's-' + sprite.name
        }
    }));
    spriteData.css.pipe(gulp.dest(path.src.spritesSASS));
    spriteData.img.pipe(gulp.dest(path.build.img));
});

gulp.task('css:build', function() {
    gulp.src(path.src.css)
        .pipe(plugins.plumber())
    return plugins.sass(path.src.css)
        .pipe(plugins.prefixer())
        //.pipe(plugins.rename('style.dist.css'))
        //.pipe(gulp.dest(path.build.css))
        .pipe(plugins.cssmin())
        .pipe(plugins.rename('style.css'))
        .pipe(gulp.dest(path.build.css))
        .pipe(reload({
            stream: true
        }));
});

gulp.task('css:dev', function() {
    gulp.src(path.src.css)
        .pipe(plugins.plumber())
    return plugins.sass(path.src.css, {
            sourcemap: true
        })
        .pipe(plugins.prefixer())
        .pipe(plugins.sourcemaps.write())
        .pipe(gulp.dest(path.build.css))
        .pipe(reload({
            stream: true
        }));
});

gulp.task('js:build', function() {
    gulp.src(path.src.js.def)
        .pipe(plugins.plumber())
        .pipe(plugins.rigger())
        .pipe(plugins.rename('script.dist.js'))
        .pipe(gulp.dest(path.build.js))
        .pipe(plugins.uglify({
            mangle: false //Need for angular normal work. Off renaming
        }))
        .pipe(plugins.rename('script.js'))
        .pipe(gulp.dest(path.build.js))
        .pipe(reload({
            stream: true
        }));
})

gulp.task('js:dev', function() {
    gulp.src(path.src.js.def)
        .pipe(plugins.plumber())
        .pipe(plugins.rigger())
        .pipe(plugins.rename('script.dist.js'))
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.sourcemaps.write())
        .pipe(plugins.rename('script.js'))
        .pipe(gulp.dest(path.build.js))
        .pipe(reload({
            stream: true
        }));
})


gulp.task('img:build', function() {
    gulp.src(path.src.img)
        .pipe(plugins.plumber())
        .pipe(plugins.imagemin({
            progressive: true,
            svgoPlugins: [{
                removeViewBox: false
            }],
            use: [plugins.pngquant()],
            interlaced: true
        }))
        .pipe(gulp.dest(path.build.img))
        .pipe(reload({
            stream: true
        }));
})

gulp.task('img:dev', function() {
    gulp.src(path.src.img)
        .pipe(gulp.dest(path.build.img))
        .pipe(reload({
            stream: true
        }));
});

gulp.task('fonts:build', function() {
    gulp.src(path.src.fonts)
        .pipe(gulp.dest(path.build.fonts))
        .pipe(plugins.ttf2eot())
        .pipe(gulp.dest(path.build.fonts));
    gulp.src(path.src.fonts)
        .pipe(plugins.ttf2woff())
        .pipe(gulp.dest(path.build.fonts));
});

gulp.task('icon_fonts', function() {
    gulp.src(path.src.icon_fonts)
        .pipe(gulp.dest(path.build.fonts));
});


//Create zip file
gulp.task('zip', function() {
    return gulp.src([path.build.html + '*/**', '!' + path.build.html + '*/builder'], {
            base: "../"
        })
        .pipe(plugins.zip('build.zip'))
        .pipe(gulp.dest('../'));
});


gulp.task('webserver', function() {
    plugins.browserSync(serv_config);
});

gulp.task('clean', function(cb) {
    plugins.rimraf(path.clean, cb);
});

//All build task
gulp.task('build', [
    'sprite',
    'js:build',
    'css:build',
    'fonts:build',
    'icon_fonts',
    'img:build'
]);

//Develop build task
gulp.task('dev', [
    'sprite',
    'js:dev',
    'css:dev',
    'fonts:build',
    'icon_fonts',
    'img:dev'
]);

//Watch task
gulp.task('watch', function() {
    plugins.watch([path.watch.css], function(event, cb) {
        gulp.start('css:build');
    });
    plugins.watch([path.watch.sprite], function(event, cb) {
        gulp.start('sprite');
    });
    plugins.watch([path.watch.js], function(event, cb) {
        gulp.start('js:dev');
    });
    plugins.watch([path.watch.img], function(event, cb) {
        gulp.start('img:dev');
    });
    plugins.watch([path.watch.fonts], function(event, cb) {
        gulp.start('fonts:build');
    });
});

//Default task
gulp.task('default', ['dev', 'watch']);
