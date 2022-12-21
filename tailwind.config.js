const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
const config = require('@ohseesoftware/tailwind-config');

module.exports = {
  // https://github.com/tailwindlabs/tailwindcss/issues/4978
  mode: 'jit',

  darkMode: 'class',

  purge: [
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
        'brand-light-lighten': colors.coolGray[100],
        'brand-light': colors.coolGray[200],
        'brand-light-darken': colors.coolGray[300],
        'brand-dark-lighten': colors.coolGray[700],
        'brand-dark': colors.coolGray[800],
        'brand-dark-darken': colors.coolGray[900]
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
