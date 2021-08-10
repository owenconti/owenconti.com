import Button from '@/components/Button';
import Guest from '@/layouts/Guest';
import Input from '@/components/form/Input';
import Label from '@/components/form/Label';
import React, { useEffect } from 'react';
import ValidationErrors from '@/components/form/ValidationErrors';
import { useForm } from '@inertiajs/inertia-react';

export default function ResetPassword({ token, email }) {
  const { data, setData, post, processing, errors, reset } = useForm({
    token: token,
    email: email,
    password: '',
    password_confirmation: ''
  });

  useEffect(() => {
    return () => {
      reset('password', 'password_confirmation');
    };
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  const onHandleChange = (event) => {
    setData(event.target.name, event.target.value);
  };

  const submit = (e) => {
    e.preventDefault();

    post(route('password.update'));
  };

  return (
    <Guest>
      <ValidationErrors errors={errors} />

      <form onSubmit={submit}>
        <div>
          <Label forInput="email" value="Email" />

          <Input
            type="email"
            name="email"
            value={data.email}
            className="block w-full mt-1"
            autoComplete="username"
            handleChange={onHandleChange}
          />
        </div>

        <div className="mt-4">
          <Label forInput="password" value="Password" />

          <Input
            type="password"
            name="password"
            value={data.password}
            className="block w-full mt-1"
            autoComplete="new-password"
            isFocused={true}
            handleChange={onHandleChange}
          />
        </div>

        <div className="mt-4">
          <Label forInput="password_confirmation" value="Confirm Password" />

          <Input
            type="password"
            name="password_confirmation"
            value={data.password_confirmation}
            className="block w-full mt-1"
            autoComplete="new-password"
            handleChange={onHandleChange}
          />
        </div>

        <div className="flex items-center justify-end mt-4">
          <Button className="ml-4" processing={processing}>
            Reset Password
          </Button>
        </div>
      </form>
    </Guest>
  );
}
