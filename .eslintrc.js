module.exports = {
  env: {
    browser: true,
    es2021: true
  },
  extends: ['standard', 'prettier'],
  plugins: ['react', 'react-hooks', 'prettier'],
  parserOptions: {
    ecmaFeatures: {
      jsx: true
    },
    ecmaVersion: 12,
    sourceType: 'module'
  },
  rules: {
    'prettier/prettier': 'error',
    semi: ['error', 'always'],
    'comma-dangle': ['error', 'never'],
    camelcase: ['warn', { ignoreImports: true, ignoreDestructuring: true }],
    'react/jsx-uses-vars': 'error',
    'react/jsx-uses-react': 'error',
    'react/react-in-jsx-scope': 'off',
    'react/display-name': 'off',
    'react-hooks/rules-of-hooks': 'error',
    'react-hooks/exhaustive-deps': 'warn',
    'no-use-before-define': 'off',
    'no-unused-vars': 'off'
  },
  settings: {
    react: {
      version: 'detect'
    },
    'import/resolver': {
      alias: {
        map: [
          ['@', './resources/js'],
          ['ziggy', './vendor/tightenco/ziggy/dist/js/route.js']
        ],
        extensions: ['.jsx']
      }
    }
  },
  globals: {
    document: true,
    window: true,
    route: true
  }
};
