<?php
    namespace App\Http\Validators;


    trait UserRequestValidator
    {
        /**
         * Validate user sign in
         */
        protected function validateLogin($request)
        {
            $this->validate($request, [
                'email' => 'required|email|max:255',
                'password' => 'required|string|max:255',
            ]);

        }
        /**
         * Validate user register
         */
        protected function validateRegister($request)
        {
            $this->validate($request, [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:6|max:255',
                'phone' => 'required|string|max:20',
            ]);

        }
        /**
         * Validate user update password
         */
        protected function validateUpdatePassword($request)
        {
            $this->validate($request, [
                'password' => 'required|string|min:6|max:255'
            ]);

        }


    }
