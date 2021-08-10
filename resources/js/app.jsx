import React from 'react';
import { render } from 'react-dom';
import { App } from '@inertiajs/inertia-react';
import { InertiaProgress } from '@inertiajs/progress';

import '../css/app.css';

const pages = import.meta.glob('./pages/**/*.jsx');
function resolveComponent(page) {
  const importPage = pages[`./pages/${page}.jsx`];

  if (!importPage) {
    throw new Error(`Unknown page ${page}. Is it located under Pages with a .jsx extension?`);
  }

  return importPage().then((module) => module.default);
}

const el = document.getElementById('app');

render(<App initialPage={JSON.parse(el.dataset.page)} resolveComponent={resolveComponent} />, el);

InertiaProgress.init({ color: '#4B5563' });
