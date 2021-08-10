<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateUser
{
    use AsAction;

    public function authorize(): bool
    {
        return true;
    }

    public function getValidator(Factory $factory, ActionRequest $request): Validator
    {
        return $factory->make($request->only('name', 'email'), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($request->user()->id)],
        ]);
    }

    public function asController(Request $request)
    {
        $this->handle(
            $request->user(),
            $request->input()
        );

        return redirect(route('profile.edit'));
    }

    public function handle(User $user, array $input)
    {
        $user->update($input);
    }
}
