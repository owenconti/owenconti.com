import { XCircleIcon } from '@heroicons/react/solid';
import Alert from './Alert';

export default function FormErrorAlert({ errors }) {
  if (Object.keys(errors).length === 0) {
    return null;
  }

  return (
    <Alert title="There was an error submitting the form!" icon={XCircleIcon} color="red">
      <ul className="mt-3 text-sm list-disc list-inside">
        {Object.keys(errors).map(function (key, index) {
          return <li key={index}>{errors[key]}</li>;
        })}
      </ul>
    </Alert>
  );
}
