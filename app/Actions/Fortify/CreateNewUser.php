<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'min:6', 'max:30'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $subscribe_data_array = [
            'account_name' => 'Building SAT',
            'last_name' => $input['name'],
            'service' => 'Newsletter',
            'email' => $input['email'],
            'optin_id' => 'optin_id',
            'ip_address' => 'true'
        ];

        if ($input['newsletter'] == "1") {
            $subscribe_data_array = array_merge($subscribe_data_array, [
                'list_id' => 2
            ]);
        }

        $response = Http::get('http://building-sat.com/wp-json/bloom/v1/config');

        $subscribe_nonce = json_decode($response->body())->subscribe_nonce;

        $response = Http::asForm()->post('http://building-sat.com/wp-admin/admin-ajax.php', [
            'subscribe_nonce' => $subscribe_nonce,
            'subscribe_data_array' => json_encode($subscribe_data_array),
            'action' => 'bloom_subscribe',
        ]);

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'country_id' => $input['country_id'],
            'role' => 'user',
            'user_type' => $input['userType'],
            'company' => $input['company'],
            'contact_number' => $input['tel'],
            'subscribed_newsletter' => $input['newsletter'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
