const gulp = require("gulp");
const requireDir = require("require-dir");
const tasks = requireDir("./tasks");

exports.libs_style = tasks.libs_style;
exports.style = tasks.style;
exports.watch = tasks.watch;
exports.build_js = tasks.build_js;
exports.libs_js = tasks.libs_js;
exports.dev_js = tasks.dev_js;
exports.rastr = tasks.rastr;
exports.webp = tasks.webp;
exports.svg_sprite = tasks.svg_sprite;
exports.ttf = tasks.ttf;
exports.ttf2 = tasks.ttf2;
exports.fonts = tasks.fonts;
// exports.svg_css = tasks.svg_css;

exports.default = gulp.parallel(
    exports.libs_style,
    exports.style,
    exports.libs_js,
    exports.dev_js,
    exports.rastr,
    exports.webp,
    exports.watch,
    exports.svg_sprite,
    exports.ttf,
    exports.ttf2,
    exports.fonts,
    // exports.svg_css,
);