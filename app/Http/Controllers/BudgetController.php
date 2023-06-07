<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Budget;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Carbon\Carbon;

class BudgetController extends Controller
{
    public function index() {
        $user = Auth::user();
        $budgetQuery = Budget::orderBy('created_at', 'desc')
            ->with('user')
            ->where('user_id', $user->id);
        $search = HttpRequest::input('search');
        if ($search) {
            $budgetQuery->where(function ($query) use ($search) {
                $query->where('amount', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like','%' . $search . '%');
            });
        }

        $budgets = $budgetQuery->paginate(3)->withQueryString();
        $users = User::orderBy('name')->get();
        return inertia('budget/Index',[
                    'budgets' =>$budgets,
                    'users' => $users,
                    'filters' => HttpRequest::only(['search'])
        ])->withViewData(['title' => 'Budget']);
    }

    public function create() {

        return inertia('budget/Create',[
            'budgets' => Budget::orderBy('created_at','asc')->with('user')->get(),
            'users' => User::orderBy('name')->get()
        ]);
    }

    public function store(Request $request){
        $fields = $request->validate([
            'amount'=>'required',
            'description' => 'required',
        ]);

        $budget = new Budget([
            'amount' => $fields['amount'],
            'description' => $fields['description'],
            'user_id' => Auth::user()->id,
        ]);
        $budget->save();

        return redirect('/budget')->with('message', 'Budget Created Successfully');
    }

    public function edit(Budget $budget){
        return inertia('budget/Edit',[
            'budget' => $budget,
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Budget $budget){
        $fields = $request->validate([
             'amount'=>'required',
            'description' => 'required',
        ]);

        $budget->update($fields);

        return redirect('/budget')->with('message', "You successfully updated the budget $budget->description");
    }

    public function destroy(Budget $budget){

        $budget->delete();

        return redirect('/budget')->with('message', 'Budget Deleted Successfully');
    }
}
