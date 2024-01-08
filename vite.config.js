import { defineConfig } from 'vite';
import Dotenv from 'dotenv';
import mkcert from 'vite-plugin-mkcert';
import laravel from 'laravel-vite-plugin';

Dotenv.config();

const isLocalHttps = process.env.VITE_HTTPS === 'true';

const plugins = [
  laravel({
    buildDirectory: 'dist',
    input: ['resources/js/app.js']
  })
];

if (isLocalHttps) {
  plugins.push(mkcert());
}

export default defineConfig({
  plugins,
  server: {
    host: '127.0.01'
  }
});
