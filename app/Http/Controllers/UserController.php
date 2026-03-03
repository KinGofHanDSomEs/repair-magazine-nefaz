<?php

namespace App\Http\Controllers;

use App\Constants\Errors\SystemErrors;
use App\Constants\Errors\UserErrors;
use App\Constants\Errors\ValidationErrors;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::with('orders')->whereNot('role', 'admin')->get();

            return view('users.index', compact('users'));
        }  catch (QueryException $e) {
            logger()->warning('UserController.index: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('UserController.index: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['bail', 'required', 'string', 'min:8'],
                'name' => ['bail', 'required', 'string', 'max:255'],
                'lastname' => ['bail', 'required', 'string', 'max:255'],
                'phone' => ['bail', 'required', 'string', 'max:255'],
            ], [
                'required' => ValidationErrors::REQUIRED,
                'string' => ValidationErrors::STRING,
                'email' => ValidationErrors::EMAIL,
                'max' => ValidationErrors::MAX,
                'min' => ValidationErrors::MIN,
                'unique' => ValidationErrors::UNIQUE,
            ]);

            $user = User::create($validated);

            return redirect()->route('users.show', $user->id);
        } catch (ValidationException $e) {
            return redirect()->route('users.create')->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            logger()->warning('UserController.store: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('users.create')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('UserController.store: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('users.create')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::whereNot('role', 'admin')->find($id);

            return view('users.show', compact('user'));
        } catch (QueryException $e) {
            logger()->warning('UserController.show: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('users.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('UserController.show: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('users.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user = User::whereNot('role', 'admin')->find($id);

            return view('users.edit', compact('user'));
        } catch (QueryException $e) {
            logger()->warning('UserController.edit: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('users.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('UserController.edit: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('users.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::whereNot('role', 'admin')->find($id);

            if (is_null($user)) {
                return redirect()->route('users.index')->withErrors(['error' => UserErrors::NOT_FOUND]);
            }

            if (!$request['password']) {
                unset($request['password']);
            }

            if ($request['email'] === $user['email']) {
                unset($request['email']);
            }

            $validated = $request->validate([
                'email' => ['bail', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['bail', 'string', 'string', 'min:8'],
                'name' => ['bail', 'string', 'max:255'],
                'lastname' => ['bail', 'string', 'max:255'],
                'phone' => ['bail', 'string', 'max:255'],
            ], [
                'string' => ValidationErrors::STRING,
                'email' => ValidationErrors::EMAIL,
                'max' => ValidationErrors::MAX,
                'min' => ValidationErrors::MIN,
                'unique' => ValidationErrors::UNIQUE,
            ]);


            if (!$user->update($validated)) {
                return redirect()->route('users.edit', $id)->withErrors(['error' => UserErrors::FAILED_UPDATE])->withInput();
            }

            return redirect()->route('users.show', $id);
        } catch (ValidationException $e) {
            return redirect()->route('users.edit', $id)->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            logger()->warning('UserController.update: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('users.edit', $id)->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('UserController.update: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('users.edit', $id)->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::whereNot('role', 'admin')->find($id);

            if (is_null($user)) {
                return redirect()->route('users.index')->withErrors(['error' => UserErrors::NOT_FOUND]);
            }



            if (!$user->delete()) {
                return redirect()->route('users.index')->withErrors(['error' => UserErrors::FAILED_DELETE]);
            }

            return redirect()->route('users.index');
        } catch (QueryException $e) {
            logger()->warning('UserController.destroy: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('users.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('UserController.destroy: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('users.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    public function confirm(string $id)
    {
        try {
            $user = User::whereNot('role', 'admin')->find($id);

            if (is_null($user)) {
                return redirect()->route('users.index')->withErrors(['error' => UserErrors::NOT_FOUND]);
            }

            if (!$user->update(['confirmed' => 1])) {
                return redirect()->route('users.show', $id)->withErrors(['error' => UserErrors::FAILED_UPDATE]);
            }

            return redirect()->route('users.show', $id);
        } catch (QueryException $e) {
            logger()->warning('UserController.confirm: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('users.show', $id)->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('UserController.confirm: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('users.show', $id)->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }
}
