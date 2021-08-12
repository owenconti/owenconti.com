const defaultTheme = require('tailwindcss/defaultTheme');
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
        accent: 'var(--osm-accent)'
      },
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
        heading: ['Inter', ...defaultTheme.fontFamily.sans],
        code: ['Monaco', 'Consolas', 'Liberation Mono', 'Courier New', 'monospace']
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
