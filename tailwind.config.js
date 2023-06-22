const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
      './storage/framework/views/*.php',
      './resources/views/**/*.blade.php',
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js",
      './src/**/*.{html,js,svelte,ts}',
    ],
    theme: {
      extend: {
          fontFamily: {
              sans: ['Figtree', ...defaultTheme.fontFamily.sans],
          },
      },
  },

  plugins: [require('@tailwindcss/forms'), require('flowbite/plugin')],
  }