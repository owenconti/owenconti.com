import '../css/app.css';
import './dark-mode.js';

import { createApp } from 'petite-vue';

function Header(props) {
  return {
    isOpen: false
  };
}

createApp({
  Header
}).mount();
