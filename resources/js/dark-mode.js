let isDarkMode = false;

document.addEventListener('DOMContentLoaded', () => {
  determineDarkMode();
});

function determineDarkMode() {
  const hasPreference = !!localStorage.darkModeEnabled;
  const preferenceDarkMode = localStorage.darkModeEnabled === 'true';
  const osDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

  isDarkMode = hasPreference ? preferenceDarkMode : osDarkMode;

  const $html = document.getElementsByTagName('html')[0];
  const $darkModeIcon = document.getElementById('dark-mode-icon');
  const $lightModeIcon = document.getElementById('light-mode-icon');

  if (isDarkMode) {
    $html.classList.add('dark');
    $darkModeIcon.classList.remove('hidden');
    $lightModeIcon.classList.add('hidden');
  } else {
    $html.classList.remove('dark');
    $darkModeIcon.classList.add('hidden');
    $lightModeIcon.classList.remove('hidden');
  }
}

window.onDarkModeToggle = function () {
  const $html = document.getElementsByTagName('html')[0];

  if (isDarkMode) {
    localStorage.darkModeEnabled = 'false';
  } else {
    localStorage.darkModeEnabled = 'true';
  }

  determineDarkMode();
};
