const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
    ],
     // make sure to safelist these classes when using purge
    safelist: [
      'w-64',
      'w-1/2',
      'rounded-l-lg',
      'rounded-r-lg',
      'bg-gray-200',
      'grid-cols-4',
      'grid-cols-7',
      'h-6',
      'leading-6',
      'h-9',
      'leading-9',
      'shadow-lg'
    ],
    theme: {
      screens: {
        sm: '480px',
        md: '768px',
        lg: '976px',
        xl: '1440px',
      },
      colors: {
        'blue': '#1fb6ff',
        'pink': '#ff49db',
        'orange': '#ff7849',
        'green': '#13ce66',
        'gray-dark': '#273444',
        'gray': '#8492a6',
        'gray-light': '#d3dce6',
      },
      fontFamily: {
        sans: ['Graphik', 'sans-serif'],
        serif: ['Merriweather', 'serif'],
      },
      extend: {
        fontFamily: {
          sans: ['Nunito', ...defaultTheme.fontFamily.sans],
      },
      }
    },
    variants: {
      fill: [],
      extend: {
        borderColor: ['focus-visible'],
        opacity: ['disabled'],
      }
    },
    plugins: [
      [require('@tailwindcss/forms'),require('flowbite/plugin')]
    ],
    presets: [
      require('@acmecorp/base-tailwind-config')
    ],
  }