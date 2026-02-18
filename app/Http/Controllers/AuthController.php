<?php

namespace App\Http\Controllers;

use App\Constants\Errors\AuthErrors;
use App\Constants\Errors\SystemErrors;
use App\Constants\Errors\ValidationErrors;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
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

            logger('AuthController.register: User created and logged', [
                'id' => $user->id,
            ]);

            return redirect()->route('profile');
        } catch (ValidationException $e) {
            $errors = $e->errors();

            logger('AuthController.register: Validation failed', [
                'errors' => $errors,
            ]);

            return redirect()->back()->withErrors($errors);
        } catch (QueryException $e) {
            logger()->warning('AuthController.register: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->back()->withErrors(['global' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->alert('AuthController.register: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->back()->withErrors(['global' => SystemErrors::INTERNAL]);
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
                return redirect()->back()->withErrors([
                    'email' => AuthErrors::INVALID_ARGUMENTS,
                    'password' => AuthErrors::INVALID_ARGUMENTS
                ]);
            }

            logger('AuthController.login: User logged', [
                'id' => Auth::id(),
            ]);

            return redirect()->route('profile');
        } catch (ValidationException $e) {
            $errors = $e->errors();

            logger('AuthController.login: Validation failed', [
                'errors' => $errors,
            ]);

            return redirect()->back()->withErrors($errors);
        } catch (Exception $e) {
            logger()->alert('AuthController.login: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->back()->withErrors(['global' => SystemErrors::INTERNAL]);
        }
    }

    public function logout() {
        try {
            $id = Auth::id();

            Auth::logout();

            logger('AuthController.logout: User logged out', [
                'id' => $id,
            ]);

            return redirect()->route('index');
        } catch (Exception $e) {
            logger()->alert('AuthController.logout: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['global' => SystemErrors::INTERNAL]);
        }
    }
}
