import Button from '@/components/Button';
import Guest from '@/layouts/Guest';
import Input from '@/components/form/Input';
import React from 'react';
import ValidationErrors from '@/components/form/ValidationErrors';
import { useForm } from '@inertiajs/inertia-react';

export default function ForgotPassword({ status }) {
  const { data, setData, post, processing, errors } = useForm({
    email: ''
  });

  const onHandleChange = (event) => {
    setData(event.target.name, event.target.value);
  };

  const submit = (e) => {
    e.preventDefault();

    post(route('password.email'));
  };

  return (
    <Guest>
      <div className="mb-4 text-sm leading-normal text-gray-500">
        Forgot your password? No problem. Just let us know your email address and we will email you
        a password reset link that will allow you to choose a new one.
      </div>

      {status && <div className="mb-4 text-sm font-medium text-green-600">{status}</div>}

      <ValidationErrors errors={errors} />

      <form onSubmit={submit}>
        <Input
          type="text"
          name="email"
          value={data.email}
          className="block w-full mt-1"
          isFocused={true}
          handleChange={onHandleChange}
        />

        <div className="flex items-center justify-end mt-4">
          <Button className="ml-4" processing={processing}>
            Email Password Reset Link
          </Button>
        </div>
      </form>
    </Guest>
  );
}
