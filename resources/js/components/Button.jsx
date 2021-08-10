import cn from 'classnames';

export default function Button({
  type = 'submit',
  className = '',
  processing,
  theme = 'secondary', // primary, secondary
  children
}) {
  const themeClasses = {
    'bg-brand-primary hover:bg-brand-primary-darken active:bg-brand-primary text-white':
      theme === 'primary',
    'bg-gray-900 hover:bg-black active:bg-gray-900 text-white': theme === 'secondary'
  };

  return (
    <button
      type={type}
      className={cn(
        'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150',
        className,
        themeClasses,
        {
          'opacity-25': processing
        }
      )}
      disabled={processing}
    >
      {children}
    </button>
  );
}
