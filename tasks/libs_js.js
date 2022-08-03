const plugins = [
    "node_modules/swiper/swiper-bundle.min.js",
    "node_modules/sweetalert2/dist/sweetalert2.js",
    "node_modules/@fancyapps/ui/dist/fancybox.umd.js",
];
const { src, dest } = require("gulp");
const uglify = require("gulp-uglify-es").default;
const concat = require("gulp-concat");
const map = require("gulp-sourcemaps");
const chalk = require("chalk");

module.exports = function libs_js(done) {
    if (plugins.length > 0)
        return src(plugins)
            .pipe(map.init())
            .pipe(uglify())
            .pipe(concat("libs.min.js"))
            .pipe(map.write("../sourcemaps/"))
            .pipe(dest("assets/js/"));
    else {
        return done(console.log(chalk.redBright("No added JS plugins")));
    }
};
