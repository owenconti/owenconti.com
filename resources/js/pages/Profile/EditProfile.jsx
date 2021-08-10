import { useCallback } from 'react';
import FormButtonBar from '@/components/form/FormButtonBar';
import FormGroup from '@/components/form/FormGroup';
import Input from '@/components/form/Input';
import Label from '@/components/form/Label';
import PageSection from '@/components/layout/PageSection';
import Authenticated from '@/layouts/Authenticated';
import { usePage, useForm } from '@inertiajs/inertia-react';
import PrimaryButton from '@/components/PrimaryButton';
import ValidationErrors from '@/components/form/ValidationErrors';
import FormErrorAlert from '@/components/alert/FormErrorAlert';

export default function EditProfile() {
  const { auth } = usePage().props;
  const { data, setData, put, processing, errors, reset } = useForm({
    name: auth.user.name,
    email: auth.user.email
  });

  const handleSubmit = useCallback(
    (e) => {
      e.preventDefault();

      put(route('profile.update'));
    },
    [put]
  );

  return (
    <Authenticated header={<h1>Profile</h1>}>
      <div className="p-10">
        <PageSection title="Profile Information" description="Edit your profile information.">
          <form onSubmit={handleSubmit}>
            <div className="max-w-sm">
              <FormGroup forInput="name" label="Name">
                <Input
                  type="text"
                  name="name"
                  value={data.name}
                  handleChange={({ target }) => setData('name', target.value)}
                  hasError={!!errors.name}
                />
              </FormGroup>
            </div>
            <div className="max-w-lg">
              <FormGroup forInput="email" label="Email">
                <Input
                  type="email"
                  name="email"
                  value={data.email}
                  autoComplete="email"
                  handleChange={({ target }) => setData('email', target.value)}
                  hasError={!!errors.email}
                />
              </FormGroup>
            </div>

            <FormErrorAlert errors={errors} />

            <FormButtonBar>
              <PrimaryButton type="submit" processing={processing}>
                Save Profile
              </PrimaryButton>
            </FormButtonBar>
          </form>
        </PageSection>
      </div>
    </Authenticated>
  );
}
