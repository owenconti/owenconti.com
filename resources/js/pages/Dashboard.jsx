import Authenticated from '@/layouts/Authenticated';
import React from 'react';

export default function Dashboard(props) {
  return (
    <Authenticated header={<h1>Dashboard</h1>}>
      <div className="p-10">You're logged in!</div>
    </Authenticated>
  );
}
