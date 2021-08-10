import cn from 'classnames';

export default function FormButtonBar({ children, className = null }) {
  return <div className={cn('flex justify-end', className)}>{children}</div>;
}
