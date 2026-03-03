<?php

namespace App\Http\Controllers;

use App\Constants\Errors\ValidationErrors;
use App\Constants\Errors\AuthErrors;
use App\Constants\Errors\SystemErrors;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegister()
    {
        try {
            if (Auth::check()) {
                return redirect()->route('auth.profile');
            }

            return view('auth.register');
        } catch (QueryException $e) {
            logger()->warning('AuthController.showRegister: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('AuthController.showRegister: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    public function showLogin()
    {
        try {
            if (Auth::check()) {
                return redirect()->route('auth.profile');
            }

            return view('auth.login');
        } catch (QueryException $e) {
            logger()->warning('AuthController.showLogin: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('AuthController.showLogin: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    public function showProfile() {
        try {
            $user = Auth::user();

            return view('auth.profile', compact('user'));
        } catch (QueryException $e) {
            logger()->warning('AuthController.showProfile: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('AuthController.showProfile: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    public function register(Request $request) {
        try {
            $validated = $request->validate([
                'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['bail', 'required', 'string', 'min:8', 'confirmed'],
                'name' => ['bail', 'required', 'string', 'max:255'],
                'lastname' => ['bail', 'required', 'string', 'max:255'],
                'phone' => ['bail', 'required', 'string', 'max:20'],
            ], [
                'required' => ValidationErrors::REQUIRED,
                'string' => ValidationErrors::STRING,
                'email' => ValidationErrors::EMAIL,
                'unique' => ValidationErrors::UNIQUE,
                'max' => ValidationErrors::MAX,
                'min' => ValidationErrors::MIN,
                'confirmed' => ValidationErrors::CONFIRMED,
            ]);

            $user = User::create($validated);

            Auth::login($user, true);

            return redirect()->route('orders.index');
        } catch (ValidationException $e) {
            return redirect()->route('auth.register')->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            logger()->warning('AuthController.register: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('auth.register')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('AuthController.register: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('auth.register')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }

    public function login(Request $request) {
        try {
            $validated = $request->validate([
                'email' => ['bail', 'required', 'string'],
                'password' => ['bail', 'required', 'string'],
            ], [
                'required' => ValidationErrors::REQUIRED,
                'string' => ValidationErrors::STRING,
            ]);

            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('auth.login')->withErrors([
                    'email' => AuthErrors::INVALID_ARGUMENTS,
                    'password' => AuthErrors::INVALID_ARGUMENTS
                ])->withInput();
            }

            return redirect()->route('orders.index');
        } catch (ValidationException $e) {
            return redirect()->route('auth.login')->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            logger()->warning('AuthController.login: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('auth.login')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('AuthController.login: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('auth.login')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }

    public function logout() {
        try {
            $id = Auth::id();

            Auth::logout();

            return redirect()->route('index');
        } catch (QueryException $e) {
            logger()->warning('AuthController.logout: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('AuthController.logout: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    public function changeProfile(Request $request, string $id) {
        try {
            $user = User::find($id);

            if (is_null($user)) {
                return redirect()->route('auth.profile')->withErrors(['error' => AuthErrors::NOT_FOUND]);
            }


            if (!$user->update($request->except(['_token', '_method']))) {
                return redirect()->route('auth.profile')->withErrors(['error' => AuthErrors::FAILED_UPDATE]);
            }

            return redirect()->route('auth.profile');
        } catch (QueryException $e) {
            logger()->warning('AuthController.changeProfile: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('auth.login')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('AuthController.changeProfile: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('auth.login')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }

    public function changeProfilePassword(Request $request, string $id) {
        try {
            $user = User::find($id);

            if (is_null($user)) {
                return redirect()->route('auth.profile')->withErrors(['error' => AuthErrors::NOT_FOUND]);
            }

            if (!Hash::check($request['current_password'], $user->password)) {
                return redirect()->route('auth.profile', ['changePasswordStatus' => 'error'])->withErrors(['current_password' => AuthErrors::INVALID_PASSWORD]);
            }

            $validated = $request->validate([
                'password' => ['bail', 'required', 'string', 'min:8', 'confirmed']
            ], [
                'required' => ValidationErrors::REQUIRED,
                'string' => ValidationErrors::STRING,
                'confirmed' => ValidationErrors::CONFIRMED,
                'min' => ValidationErrors::MIN,
            ]);

            if (!$user->update($validated)) {
                return redirect()->route('auth.profile')->withErrors(['error' => AuthErrors::FAILED_UPDATE]);
            }

            return redirect()->route('logout');
        }  catch (ValidationException $e) {
            return redirect()->route('auth.profile', ['changePasswordStatus' => 'error'])->withErrors($e->errors());
        } catch (QueryException $e) {
            logger()->warning('AuthController.changeProfilePassword: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('auth.login')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('AuthController.changeProfilePassword: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('auth.login')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }
}
