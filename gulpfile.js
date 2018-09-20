var gulp = require('gulp'),
	sass = require('gulp-sass'),
	autoprefixer = require('autoprefixer'),
	browserSync = require('browser-sync'),
	postcss = require('gulp-postcss'),
	php = require('gulp-connect-php'),
	useref = require('gulp-useref'),
	uglify = require('gulp-uglify'),
	cssnano = require('cssnano'),
	gulpIf = require('gulp-if'),
	imagemin = require('gulp-imagemin'),
	cache = require('gulp-cache'),
	rename= require('gulp-rename'),
	del = require('del'),
	merge = require('merge-stream'),
	flatten = require('gulp-flatten'),
	header = require('gulp-header'),
	babel = require('gulp-babel'),
	runSequence = require('run-sequence'),
	deleteLines = require('gulp-delete-lines'),
	replace = require('gulp-replace');

var reload = browserSync.reload;
var port = 8888;

gulp.task('plugins', function() {
	var min = gulp.src('bower_components/**/*.min.js')
	.pipe(flatten())
	.pipe(gulp.dest('dev/js/vendor'));

	var reg = gulp.src('bower_components/**/*.js')
	.pipe(flatten())
	.pipe(gulp.dest('dev/js/vendor'));

	return merge(min, reg);
});

gulp.task('plugin-styles', function() {
	var css = gulp.src('bower_components/**/*.css')
	.pipe(rename({extname: '.scss', prefix: '_'}))
	.pipe(flatten())
	.pipe(gulp.dest('dev/scss/vendor'));

	var scss = gulp.src('bower_components/**/*.scss')
	.pipe(rename({prefix: '_'}))
	.pipe(flatten())
	.pipe(gulp.dest('dev/scss/vendor'));

	return merge(css, scss);
});

gulp.task('fontawesome', function() {
	return gulp.src('node_modules/@fortawesome/fontawesome-free/webfonts/**.*')
	.pipe(flatten())
	.pipe(gulp.dest('dev/fonts'))
});

gulp.task('browser-sync', function() {
	var files = ['./*.php'];
	browserSync(files, {
		proxy: 'http://localhost:' + port,
	});
});

gulp.task('sass', function() {
	return gulp.src('dev/scss/**/*.scss')
	.pipe(sass())
	.on('error', function(err) {
		console.log(err.toString());
		this.emit('end');
	})
	.pipe(gulp.dest('dev/css'))
	.pipe(reload({
		stream:true
	}))
});

gulp.task('watch', ['browser-sync', 'sass'], function() {
	gulp.watch('dev/scss/**/*.scss', ['sass'], reload);
	gulp.watch('**/*.php', reload);
	gulp.watch('dev/js/**/*.js', reload);
});

gulp.task('clean:assets', function() {
	return del.sync('assets');
});

gulp.task('images', function() {
	return gulp.src('dev/images/**/*.+(png|jpg|gif|svg|pdf)')
	.pipe(cache(imagemin()))
	.pipe(gulp.dest('assets/images'))
});

gulp.task('fonts', function() {
	return gulp.src('dev/fonts/**/*.*')
	.pipe(cache(imagemin()))
	.pipe(gulp.dest('assets/fonts'))
});

gulp.task('moveJs', function() {
	gulp.src('dev/js/**/*.*')
	.pipe(gulp.dest('assets/js'))
});

gulp.task('css', function() {
	var plugins = [
		autoprefixer({browsers:['last 2 versions']}),
		cssnano({
		   reduceIdents: {
		       keyframes: false
		   },
		   discardUnused: {
		       keyframes: false
		   }
		})
	];
	return gulp.src('dev/css/*.css')
	.pipe(postcss(plugins))
	.pipe(gulp.dest('assets/css'));
});

gulp.task('scriptDate', function() {
	return gulp.src('assets/js/main.js')
	.pipe(header('/** Last Modified: <%= new Date() %>*/\n'))
	.pipe(gulp.dest('assets/js'))
});

gulp.task('styleDate', function() {
	return gulp.src('assets/css/main.css')
	.pipe(header('/** Last Modified: <%= new Date() %>*/\n'))
	.pipe(gulp.dest('assets/css'))
});

gulp.task('clean:dist', function() {
	return del.sync('dist');
});

gulp.task('moveFiles', function() {
	var assets = gulp.src('assets/**/**.*')
	.pipe(gulp.dest('dist/assets'));

	var inc = gulp.src('inc/**.*')
	.pipe(gulp.dest('dist/inc'));

	var templateParts = gulp.src('template-parts/**/**.*')
	.pipe(gulp.dest('dist/template-parts'));

	var themeFiles = gulp.src('**.php')
	.pipe(gulp.dest('dist'));

	var themeImage = gulp.src('**.png')
	.pipe(gulp.dest('dist'));

	var themeStyle = gulp.src('**.css')
	.pipe(gulp.dest('dist'));

	return merge(assets, inc, templateParts, themeFiles, themeImage, themeStyle);
});

gulp.task('replaceScriptLinks', function() {
	return gulp.src('dist/footer.php')
	.pipe(replace("<?php bloginfo('template_directory'); ?>/dev/js", "assets/js"))
	.pipe(gulp.dest('dist'))
});

gulp.task('useref', function() {
	return gulp.src('dist/footer.php')
	.pipe(useref())
	.pipe(gulpIf('*.js', uglify()))
	.on('error', function(err) {
		console.log(err.toString());
		this.emit('end');
	})
	.pipe(gulpIf('**/*.php', gulp.dest('dist')))
	.pipe(gulpIf('**/*.js', gulp.dest('dist/assets')))
});

gulp.task('babel', function() {
	return gulp.src('assets/js/**/*.js')
	.pipe(babel({
		presets: ['es2015']
	}))
	.pipe(gulp.dest('assets/js'));
});

gulp.task('removeStyles', function() {
	return gulp.src('dist/header.php')
	.pipe(deleteLines({
		'filters': [
		 	/<link\s+type=["']/i
		]
	}))
	.pipe(gulp.dest('dist'))
});

gulp.task('removeScripts', function() {
	return gulp.src('dist/footer.php')
	.pipe(deleteLines({
		'filters': [
			/<script\s+src=/i
		]
	}))
	.pipe(gulp.dest('dist'))
});

gulp.task('replaceDevWithAssets', function() {
	return gulp.src('dist/**/*.php')
	.pipe(replace("<?php bloginfo('template_directory'); ?>/dev", "<?php bloginfo('template_directory'); ?>/assets"))
	.pipe(gulp.dest('dist'))
});

gulp.task('clean:vendor', function() {
	return del.sync('dist/assets/js/vendor');
});

gulp.task('default', function() {
	runSequence(['sass', 'browser-sync', 'watch']) 
});

gulp.task('build', function () {
	runSequence('clean:assets', 'moveJs', 'images', 'fonts', 'css', ['scriptDate', 'styleDate']) 
});

gulp.task('final', function() {
	runSequence('clean:dist', 'moveFiles', 'replaceScriptLinks', 'useref', 'babel', ['removeStyles', 'removeScripts', 'replaceDevWithAssets', 'clean:vendor'])
});