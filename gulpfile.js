import { src, dest, watch } from "gulp";
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';

const sass = gulpSass(dartSass);

export function css() {
  // Cambiamos "src/scss/app.scss" por "scss/app.scss" que es la ruta real de tu proyecto
  return src("scss/app.scss")
    .pipe( sass().on("error", sass.logError) )
    .pipe( dest("build/css") );
}

export function dev() {
  // Cambiamos "src/scss/**/*.scss" por "scss/**/*.scss"
  watch("scss/**/*.scss", css );
}

export default dev;
