/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
    fontFamily : {
      hemi : "hemi"
    }
  },
  plugins: [require('daisyui')],
  daisyui: {
    themes: true,
    darkTheme: "night",
  }
}