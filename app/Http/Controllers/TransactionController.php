<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
    // List all transactions
    public function index()
    {
        $transactions = Transaction::all();
        return TransactionResource::collection($transactions);
    }

    // Create a new transaction
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
        ]);

        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return new TransactionResource($transaction);
    }

    // Show a single transaction
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return new TransactionResource($transaction);
    }

    // Update transaction
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'sometimes|numeric|min:0.01',
            'description' => 'sometimes|string',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->only(['amount', 'description']));

        return new TransactionResource($transaction);
    }

    // Delete transaction
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->noContent();
    }
}
