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
      fontFamily: {
        sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
        heading: ['DM Sans', ...defaultTheme.fontFamily.sans],
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
