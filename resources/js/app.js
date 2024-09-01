import '../css/app.css';
import Alpine from 'alpinejs';

Alpine.start();

const toc = document.getElementsByClassName('table-of-contents')[0];
const openTocButton = document.getElementsByClassName('open-toc')[0];

if (toc && openTocButton) {
  openTocButton.addEventListener('click', openToc);

  function openToc() {
    if (toc.classList.contains('!block')) {
      return;
    }

    toc.classList.add('!block');

    setTimeout(() => {
      window.addEventListener('click', closeToc);
    }, 0);
  }

  function closeToc() {
    toc.classList.remove('!block');
    window.removeEventListener('click', closeToc);
  }
}
