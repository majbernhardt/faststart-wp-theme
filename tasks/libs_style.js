const plugins = [
    "node_modules/swiper/swiper.scss",
    "node_modules/swiper/modules/effect-fade/effect-fade.scss",
    "node_modules/@fancyapps/ui/src/Fancybox/Fancybox.scss"
];

const { src, dest } = require("gulp");
const sass = require("gulp-sass");
const concat = require("gulp-concat");
const map = require("gulp-sourcemaps");
const chalk = require("chalk");

module.exports = function libs_style(done) {
    if (plugins.length > 0) {
        return src(plugins)
            .pipe(map.init())
            .pipe(
                sass({
                    outputStyle: "compressed",
                }).on("error", sass.logError)
            )
            .pipe(concat("libs.min.css"))
            .pipe(map.write("../sourcemaps/"))
            .pipe(dest("assets/css/"));
    } else {
        return done(console.log(chalk.redBright("No added CSS/SCSS plugins")));
    }
};
