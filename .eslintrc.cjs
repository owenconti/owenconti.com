module.exports = {
  env: {
    browser: true,
    es2021: true
  },
  extends: ['standard', 'prettier'],
  plugins: ['prettier'],
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
    'no-unused-vars': 'off'
  },
  settings: {
    'import/resolver': {
      alias: {
        map: [['@', './resources/js']],
        extensions: ['.js']
      }
    }
  },
  globals: {
    document: true,
    window: true
  }
};
