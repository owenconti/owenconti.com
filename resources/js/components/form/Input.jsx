import { useEffect, useRef } from 'react';
import cn from 'classnames';

export default function Input({
  type = 'text',
  name,
  value,
  className,
  autoComplete,
  required,
  isFocused,
  handleChange,
  hasError
}) {
  const input = useRef();

  useEffect(() => {
    if (isFocused) {
      input.current.focus();
    }
  }, [isFocused]);

  return (
    <input
      type={type}
      name={name}
      value={value}
      className={cn(
        'border-gray-300 focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50 rounded-md shadow-sm w-full',
        {
          'border-red-500': hasError
        },
        className
      )}
      ref={input}
      autoComplete={autoComplete}
      required={required}
      onChange={(e) => handleChange(e)}
    />
  );
}
