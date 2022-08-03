const { src, dest } = require("gulp");
const uglify = require("gulp-uglify-es").default;
const babel = require("gulp-babel");
const concat = require("gulp-concat");

module.exports = function build_js() {
    return src(["assets/js/unbuild/*.js", "assets/js/unbuild/01_main.js"])
        .pipe(uglify())
        .pipe(
            babel({
                presets: ["@babel/env"],
            })
        )
        .pipe(concat("main.min.js"))
        .pipe(dest("assets/js/"));
};
