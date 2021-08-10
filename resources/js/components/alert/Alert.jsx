import { XCircleIcon } from '@heroicons/react/solid';

export default function Alert({ title, children, icon, color }) {
  const IconComponent = icon;

  return (
    <div className="p-4 mb-6 rounded-md bg-red-50">
      <div className="flex">
        <div className="flex-shrink-0">
          <IconComponent className={`w-5 h-5 text-${color}-400`} aria-hidden="true" />
        </div>
        <div className="ml-3">
          <h3 className={`text-sm font-medium text-${color}-800`}>{title}</h3>
          <div className={`mt-2 text-sm text-${color}-700`}>{children}</div>
        </div>
      </div>
    </div>
  );
}
