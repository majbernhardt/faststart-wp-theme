const { src, dest } = require("gulp");
const uglify = require("gulp-uglify-es").default;
const concat = require("gulp-concat");
const map = require("gulp-sourcemaps");
const bs = require("browser-sync");

module.exports = function dev_js() {
    return src(["assets/js/unbuild/*.js", "assets/js/unbuild/01_main.js"])
        .pipe(map.init())
        .pipe(uglify())
        .pipe(concat("main.min.js"))
        .pipe(map.write("../sourcemaps/"))
        .pipe(dest("assets/js/"))
        .pipe(bs.stream());
};
