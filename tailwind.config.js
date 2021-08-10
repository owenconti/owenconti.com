const defaultTheme = require('tailwindcss/defaultTheme');
const config = require('@ohseesoftware/tailwind-config');

module.exports = {
  // https://github.com/tailwindlabs/tailwindcss/issues/4978
  // mode: 'jit',

  purge: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.jsx',
    './resources/js/**/*.js'
  ],

  theme: {
    extend: {
      colors: {
        ...config.theme.colors,
        'brand-primary': config.theme.colors['brand-indigo'],
        'brand-primary-lighten': config.theme.colors['brand-indigo-lighten'],
        'brand-primary-darken': config.theme.colors['brand-indigo-darken']
      },
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans]
      }
    }
  },

  variants: {
    extend: {
      opacity: ['disabled']
    }
  },

  plugins: [require('@tailwindcss/forms')]
};
