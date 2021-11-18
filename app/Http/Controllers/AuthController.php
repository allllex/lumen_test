<?php

    namespace App\Http\Controllers;

    use App\Http\Validators\UserRequestValidator;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;


    class AuthController extends Controller
    {

        use UserRequestValidator;


        /**
         * Sign in user
         */

        public function login(Request $request)
        {

            //Validate request
            $this->validateLogin($request);

            if (!$token = auth()->attempt(request(['email', 'password']))) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->respondWithToken($token);
        }

        /**
         * Sign out user
         */
        public function logout()
        {
            auth()->logout();

            return response()->json(['message' => 'Successfully logged out']);
        }


        /**
         * Register new user
         */
        public function register(Request $request)
        {

            //Validate request
            $this->validateRegister($request);


            try {

                //Create new user
                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = app('hash')->make($request->password);

                if ($user->save()) {
                    //Sign in new user
                    return $this->login($request);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }


        /**
         * Update user password
         */

        public function updatePassword(Request $request)
        {

            //Validate request
            $this->validateUpdatePassword($request);


            try {

                $user = Auth::user();
                $user->password = app('hash')->make($request->password);

                if ($user->save()) {
                    //Sign in new user
                    return response()->json(['message' => 'Successfully update']);
                }

            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }



        }


        /**
         * Get the token array structure.
         *
         * @param string $token
         *
         * @return \Illuminate\Http\JsonResponse
         */
        protected function respondWithToken($token)
        {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        }
    }
