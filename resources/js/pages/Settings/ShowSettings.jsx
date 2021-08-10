import Authenticated from '@/layouts/Authenticated';
import { usePage } from '@inertiajs/inertia-react';
import React from 'react';

export default function ShowSettings() {
  return (
    <Authenticated header={<h1>Settings</h1>}>
      <div className="p-10">Put some settings here.</div>
    </Authenticated>
  );
}
