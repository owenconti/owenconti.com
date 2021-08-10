import { InertiaLink } from '@inertiajs/inertia-react';
import Logo from '@/components/Logo';

export default function Guest({ children }) {
  return (
    <div className="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
      <div className="max-w-full px-4">
        <InertiaLink href="/">
          <Logo className="h-20 max-w-full text-brand-black" />
        </InertiaLink>
      </div>

      <div className="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
        {children}
      </div>
    </div>
  );
}
