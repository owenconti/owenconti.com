import { usePage, Head as InertiaHead } from '@inertiajs/inertia-react';

export default function Head() {
  const { auth, config, meta } = usePage().props;

  const pageTitle = meta?.title ?? null;
  const title = pageTitle ? `${pageTitle} - ${config.name}` : config.name;

  return (
    <InertiaHead title={title}>
      <meta name="description" content="Your page description" />
    </InertiaHead>
  );
}
