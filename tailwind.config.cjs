const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
const config = require('@ohseesoftware/tailwind-config');

module.exports = {
  darkMode: 'class',

  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './content/**/*.md'
  ],

  theme: {
    extend: {
      colors: {
        ...config.theme.colors,
        accent: 'var(--osm-accent)',
        'brand-light-lighten': colors.zinc[100],
        'brand-light': colors.zinc[200],
        'brand-light-darken': colors.zinc[300],
        'brand-dark-lighten': colors.zinc[700],
        'brand-dark': colors.zinc[800],
        'brand-dark-darken': colors.zinc[900]
      },
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
        heading: ['Inter', ...defaultTheme.fontFamily.sans],
        code: ['Monaco', 'Consolas', 'Liberation Mono', 'Courier New', 'monospace']
      },
      blur: {
        xxs: '1px'
      }
    }
  },

  variants: {
    extend: {
      opacity: ['disabled']
    }
  },

  plugins: [require('@tailwindcss/typography')]
};
