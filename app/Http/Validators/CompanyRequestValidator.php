<?php
    namespace App\Http\Validators;


    trait CompanyRequestValidator
    {
        /**
         * Validate store new company
         */
        protected function validateStore($request)
        {
            $this->validate($request, [
                'title' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'description' => 'required|string|max:255',
            ]);

        }



    }
