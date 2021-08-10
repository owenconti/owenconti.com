import cn from 'classnames';

export default function Label({ forInput, value, className, children }) {
  return (
    <label htmlFor={forInput} className={cn('block font-medium text-sm text-gray-700', className)}>
      {value || children}
    </label>
  );
}
