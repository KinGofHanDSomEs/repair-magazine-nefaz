<?php

namespace App\Http\Controllers;

use App\Constants\Errors\AuthErrors;
use App\Constants\Errors\OrderErrors;
use App\Constants\Errors\SystemErrors;
use App\Constants\Errors\UserErrors;
use App\Constants\Errors\ValidationErrors;
use App\Models\Order;
use App\Models\Technic;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (Auth::user()->isAdmin()) {
                $orders = Order::all();

                return view('orders.index', compact('orders'));
            }

            $orders = Order::with('type.technic')->where('user_id', Auth::id())->get();

            return view('orders.index', compact('orders'));
        } catch (QueryException $e) {
            logger()->warning('OrderController.index: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('OrderController.index: Unknown error', [
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
        try {
            if (!Auth::user()->isConfirmed()) {
                return view('orders.index')->withErrors(['error' => UserErrors::NOT_CONFIRMED]);
            }

            $technics = Technic::with('types')->get();

            if (Auth::user()->isAdmin()) {
                $users = User::whereNot('role', 'admin')->get();

                if (is_null($users)) {
                    return redirect()->route('orders.index')->withErrors(['error' => OrderErrors::NOT_FOUND_USERS]);
                }

                return view('orders.create', compact('technics', 'users'));
            }

            return view('orders.create', compact('technics'));
        } catch (QueryException $e) {
            logger()->warning('OrderController.create: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('OrderController.create: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (!Auth::user()->isConfirmed()) {
                return view('orders.index')->withErrors(['error' => UserErrors::NOT_CONFIRMED]);
            }

            if (!Auth::user()->isAdmin()) {
                $request['user_id'] = Auth::id();
            }

            $validated = $request->validate([
                'technic_id' => ['bail', 'required', 'integer', 'exists:technics,id'],
                'user_id' => ['bail', 'required', 'integer', 'exists:users,id'],
                'type_id' => ['bail', 'required', 'integer', 'min:1', 'exists:types,id'],
                'count' => ['bail', 'required', 'integer', 'min:1', 'max:20'],
            ], [
                'required' => ValidationErrors::REQUIRED,
                'integer' => ValidationErrors::INTEGER,
                'max' => ValidationErrors::INTEGER_MAX,
                'min' => ValidationErrors::INTEGER_MIN,
                'exists' => ValidationErrors::EXISTS,
            ]);

            $order = Order::create($validated);

            return redirect()->route('orders.show', $order->id);
        } catch (ValidationException $e) {
            return redirect()->route('orders.create')->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            logger()->warning('OrderController.store: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.create')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('OrderController.store: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.create')->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            if (!Auth::user()->isConfirmed()) {
                return view('orders.index')->withErrors(['error' => UserErrors::NOT_CONFIRMED]);
            }

            $order = Order::with('type.technic', 'user');

            if (!Auth::user()->isAdmin()) {
                $order = $order->where('user_id', Auth::id());
            }

            $order = $order->find($id);

            if (is_null($order)) {
                return redirect()->route('orders.index')->withErrors(['error' => OrderErrors::NOT_FOUND]);
            }

            return view('orders.show', compact('order'));
        } catch (QueryException $e) {
            logger()->warning('OrderController.show: Query exception', [
                'order_id' => $id,
                'exception' => $e,
            ]);

            return redirect()->route('orders.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('OrderController.show: Unknown error', [
                'order_id' => $id,
                'exception' => $e,
            ]);

            return redirect()->route('orders.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            if (!Auth::user()->isConfirmed()) {
                return view('orders.index')->withErrors(['error' => UserErrors::NOT_CONFIRMED]);
            }

            [$order, $err] = $this->updateStruct(Auth::id(), $id);

            if (!is_null($err)) {
                return redirect()->route('orders.index')->withErrors(['error' => $err]);
            }

            $technics = Technic::with('types')->get();

            return view('orders.edit', compact('order', 'technics'));
        } catch (QueryException $e) {
            logger()->warning('OrderController.edit: Query exception', [
                'order_id' => $id,
                'exception' => $e,
            ]);

            return redirect()->route('orders.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('OrderController.edit: Unknown error', [
                'order_id' => $id,
                'exception' => $e,
            ]);

            return redirect()->route('orders.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            if (!Auth::user()->isConfirmed()) {
                return view('orders.index')->withErrors(['error' => UserErrors::NOT_CONFIRMED]);
            }

            [$order, $err] = $this->updateStruct(Auth::id(), $id);

            if (!is_null($err)) {
                return redirect()->route('orders.index')->withErrors(['error' => $err]);
            }

            $validated = $request->validate([
                'technic_id' => ['bail', 'required', 'integer', 'exists:technics,id'],
                'type_id' => ['bail', 'integer', 'exists:types,id', 'min:1'],
                'count' => ['bail', 'integer', 'min:1', 'max:20'],
            ], [
                'required' => ValidationErrors::REQUIRED,
                'integer' => ValidationErrors::INTEGER,
                'max' => ValidationErrors::INTEGER_MAX,
                'min' => ValidationErrors::INTEGER_MIN,
                'exists' => ValidationErrors::EXISTS,
            ]);

            $validated['status'] = 'Проверяется';
            $validated['price'] = null;
            $validated['payment_status'] = 'Ожидание';
            $validated['failed_message'] = null;

            if (!$order->update($validated)) {
                return redirect()->route('orders.edit', $id)->withErrors(['error' => OrderErrors::FAILED_UPDATE])->withInput();
            }

            return redirect()->route('orders.show', $id);
        } catch (ValidationException $e) {
            return redirect()->route('orders.edit', $id)->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            logger()->warning('OrderController.update: Query exception', [
                'order_id' => $id,
                'exception' => $e,
            ]);

            return redirect()->route('orders.edit', $id)->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('OrderController.update: Unknown error', [
                'order_id' => $id,
                'exception' => $e,
            ]);

            return redirect()->route('orders.edit', $id)->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if (!Auth::user()->isConfirmed()) {
                return view('orders.index')->withErrors(['error' => UserErrors::NOT_CONFIRMED]);
            }

            $order = Order::query();

            if (!Auth::user()->isAdmin()) {
                $order = $order->where('user_id', Auth::id());
            }

            $order = $order->find($id);

            if (is_null($order)) {
                return redirect()->route('orders.index')->withErrors(['error' => OrderErrors::NOT_FOUND]);
            }

            if (!$order->delete()) {
                return redirect()->route('orders.index')->withErrors(['error' => OrderErrors::FAILED_DELETE]);
            }

            return redirect()->route('orders.index');
        } catch (QueryException $e) {
            logger()->warning('OrderController.destroy: Query exception', [
                'order_id' => $id,
                'exception' => $e,
            ]);

            return redirect()->route('orders.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('OrderController.destroy: Unknown error', [
                'order_id' => $id,
                'exception' => $e,
            ]);

            return redirect()->route('orders.index')->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    public function start(string $id)
    {
        try {
            if (!Order::find($id)->update([
                'status' => 'Выполняется'
            ])) {
                return redirect()->route('orders.show', $id)->withErrors(['error' => OrderErrors::FAILED_UPDATE]);
            }

            return redirect()->route('orders.show', $id);
        } catch (QueryException $e) {
            logger()->warning('OrderController.start: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.show', $id)->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('OrderController.start: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.show', $id)->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    public function complete(string $id)
    {
        try {
            if (!Order::find($id)->update([
                'status' => 'Завершено',
                'completed_at' => date('Y-m-d H:i:s'),
            ])) {
                return redirect()->route('orders.show', $id)->withErrors(['error' => OrderErrors::FAILED_UPDATE])->withInput();
            }

            return redirect()->route('orders.show', $id);
        } catch (QueryException $e) {
            logger()->warning('OrderController.complete: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.show', $id)->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('OrderController.complete: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.show', $id)->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }

    public function rate(string $id)
    {
        try {
            $validated = request()->validate([
                'price' => ['bail', 'required', 'integer', 'min:1'],
            ], [
                'required' => ValidationErrors::REQUIRED,
                'integer' => ValidationErrors::INTEGER,
                'min' => ValidationErrors::INTEGER_MIN,
            ]);

            $validated['status'] = 'Оценено';

            if (!Order::find($id)->update($validated)) {
                return redirect()->route('orders.show', $id)->withErrors(['error' => OrderErrors::FAILED_UPDATE])->withInput();
            }

            return redirect()->route('orders.show', $id);
        } catch (ValidationException $e) {
            return redirect()->route('orders.show', $id)->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            logger()->warning('OrderController.rate: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.show', $id)->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('OrderController.rate: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.show', $id)->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }

    public function revoke(string $id)
    {
        try {
            $validated = request()->validate([
                'failed_message' => ['bail', 'required', 'string', 'max:255'],
            ], [
                'required' => ValidationErrors::REQUIRED,
                'string' => ValidationErrors::STRING,
                'max' => ValidationErrors::MAX,
            ]);

            $validated['status'] = 'Ошибка';

            if (!Order::find($id)->update($validated)) {
                return redirect()->route('orders.show', $id)->withErrors(['error' => OrderErrors::FAILED_UPDATE])->withInput();
            }

            return redirect()->route('orders.show', $id);
        } catch (ValidationException $e) {
            return redirect()->route('orders.show', $id)->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            logger()->warning('OrderController.revoke: Query exception', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.show', $id)->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        } catch (Exception $e) {
            logger()->error('OrderController.revoke: Unknown error', [
                'exception' => $e,
            ]);

            return redirect()->route('orders.show', $id)->withErrors(['error' => SystemErrors::INTERNAL])->withInput();
        }
    }

    public function pay(string $id)
    {
        try {
            if (!Auth::user()->isConfirmed()) {
                return view('orders.index')->withErrors(['error' => UserErrors::NOT_CONFIRMED]);
            }

            $order = Order::query();

            if (!Auth::user()->isAdmin()) {
                $order = $order->where('user_id', Auth::id());
            }

            $order = $order->find($id);

            if (is_null($order)) {
                return redirect()->route('orders.show', $id)->withErrors(['error' => OrderErrors::NOT_FOUND]);
            }

            if (!$order->update([
                'payment_status' => 'Успешно'
            ])) {
                return redirect()->route('orders.show', $id)->withErrors(['error' => OrderErrors::FAILED_DELETE]);
            }

            return redirect()->route('orders.show', $id);
        } catch (QueryException $e) {
            logger()->warning('OrderController.pay: Query exception', [
                'order_id' => $id,
                'exception' => $e,
            ]);

            return redirect()->route('orders.show', $id)->withErrors(['error' => SystemErrors::INTERNAL]);
        } catch (Exception $e) {
            logger()->error('OrderController.pay: Unknown error', [
                'order_id' => $id,
                'exception' => $e,
            ]);

            return redirect()->route('orders.show', $id)->withErrors(['error' => SystemErrors::INTERNAL]);
        }
    }

    private function updateStruct(string $user_id, string $order_id) {
        $order = Order::with('type.technic');

        if (!Auth::user()->isAdmin()) {
            $order = $order->where('user_id', $user_id);
        }

        $order = $order->find($order_id);

        if (is_null($order)) {
            return [null, OrderErrors::NOT_FOUND];
        }

        switch ($order['status']) {
            case 'Выполняется':
            case 'Завершено':
                return [null, OrderErrors::EXECUTION_ORDER];
        }

        if ($order['payment_status'] === 'Успешно') {
            return [null, OrderErrors::PAID_ORDER];
        }

        return [$order, null];
    }
}
