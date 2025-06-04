<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\AccountTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view('bank.index', compact('accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255|unique:accounts',
            'account_name' => 'required|string|max:255',
            'routing' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'account_balance' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        Account::create($request->all());

        return redirect()->back()->with('success', 'Bank account added successfully.');
    }

    public function toggleStatus(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        $account->status = $request->status;
        $account->save();

        return response()->json(['success' => true, 'new_status' => $account->status]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'account_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255|unique:accounts,account_number,' . $id,
            'routing' => 'nullable|string',
            'branch' => 'nullable|string',
        ]);

        $account = Account::findOrFail($id);
        //dd($account);
        $account->update([
            'account_name' => $request->account_name,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'routing' => $request->routing,
            'branch' => $request->branch,
        ]);

        return redirect()->back()->with('success', 'Bank account updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Account::findOrFail($id);
        $employee->delete();

        return redirect()->back()->with('error', 'Bank Account deleted successfully!');
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'from_account_id' => 'required|exists:accounts,id',
            'to_account_id' => 'required|exists:accounts,id|different:from_account_id',
            'amount' => 'required|numeric|min:0.01',
            'operation_date' => 'required|date',
            'sub_type' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $from = Account::findOrFail($request->from_account_id);
            $to = Account::findOrFail($request->to_account_id);
            $userId = Auth::id();

            if ($from->account_balance < $request->amount) {
                throw new \Exception('Insufficient funds.');
            }

            $from->account_balance -= $request->amount;
            $to->account_balance += $request->amount;

            $from->save();
            $to->save();

            // Debit from 'from account'
            AccountTransaction::create([
                'account_id' => $from->id,
                'type' => 'debit',
                'amount' => $request->amount,
                'operation_date' => $request->operation_date,
                'sub_type' => $request->sub_type,
                'created_by' => $userId,
            ]);

            // Credit to 'to account'
            AccountTransaction::create([
                'account_id' => $to->id,
                'type' => 'credit',
                'amount' => $request->amount,
                'operation_date' => $request->operation_date,
                'sub_type' => $request->sub_type,
                'created_by' => $userId,
            ]);
        });

        return redirect()->back()->with('success', 'Funds transferred successfully.');
    }
}
