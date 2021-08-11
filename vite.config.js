const { resolve } = require('path');
const Dotenv = require('dotenv');

Dotenv.config();

const ASSET_URL = process.env.ASSET_URL || '';

export default {
  root: 'resources',
  base: `${ASSET_URL}/dist/`,

  build: {
    outDir: resolve(__dirname, 'public/dist'),
    emptyOutDir: true,
    manifest: true,
    target: 'es2018',
    rollupOptions: {
      input: '/js/app.js'
    }
  },

  server: {
    strictPort: true,
    port: 3000
  },

  resolve: {
    alias: {
      '@': '/js'
    }
  },

  optimizeDeps: {
    include: []
  }
};
