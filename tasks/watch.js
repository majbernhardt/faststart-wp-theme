const { watch, parallel, series } = require("gulp");

module.exports = function watching() {
    watch("assets/scss/*.scss", parallel("style"));
    watch("assets/js/unbuild/*.js", parallel("dev_js"));
    watch("assets/img/originals/*.+(svg|ico)", parallel("rastr"));
    watch(
        "assets/img/originals/*.+(png|jpg|jpeg|gif)",
        series("rastr", "webp")
    );
    // watch("../**/*.json", parallel("html"));
    // watch("../svg/css/**/*.svg", series("svg_css", "style"));
    // watch("../svg/**/*.svg", series("svg_sprite", "rastr"));
    // watch("../fonts/**/*.ttf", series("ttf", "ttf2", "fonts"));
};
