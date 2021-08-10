import Button from '@/components/Button';
import Guest from '@/layouts/Guest';
import Input from '@/components/form/Input';
import Label from '@/components/form/Label';
import React, { useEffect } from 'react';
import ValidationErrors from '@/components/form/ValidationErrors';
import { useForm } from '@inertiajs/inertia-react';

export default function ConfirmPassword() {
  const { data, setData, post, processing, errors, reset } = useForm({
    password: ''
  });

  useEffect(() => {
    return () => {
      reset('password');
    };
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  const onHandleChange = (event) => {
    setData(event.target.name, event.target.value);
  };

  const submit = (e) => {
    e.preventDefault();

    post(route('password.confirm'));
  };

  return (
    <Guest>
      <div className="mb-4 text-sm text-gray-600">
        This is a secure area of the application. Please confirm your password before continuing.
      </div>

      <ValidationErrors errors={errors} />

      <form onSubmit={submit}>
        <div className="mt-4">
          <Label forInput="password" value="Password" />

          <Input
            type="password"
            name="password"
            value={data.password}
            className="block w-full mt-1"
            isFocused={true}
            handleChange={onHandleChange}
          />
        </div>

        <div className="flex items-center justify-end mt-4">
          <Button className="ml-4" processing={processing}>
            Confirm
          </Button>
        </div>
      </form>
    </Guest>
  );
}
