<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expenses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as HttpRequest;;

class ExpensesController extends Controller
{
    public function index() {
        $user = Auth::user();
    
        $expensesQuery = Expenses::orderBy('created_at', 'desc')
            ->with('user')
            ->with('category')
            ->where('user_id', $user->id);
    
        $search = HttpRequest::input('search');
        if ($search) {
            $expensesQuery->where(function ($query) use ($search) {
                $query->where('amount', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('date', 'like', '%' . $search . '%');
            });
        }
    
        $expenses = $expensesQuery->paginate(2)->withQueryString();
    
        $users = User::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return inertia('expenses/Index', [
            'expenses' => $expenses,
            'users' => $users,
            'categories' => $categories,
            'filters' => HttpRequest::only(['search'])
        ])->withViewData(['title' => 'Expenses']);
    }

    public function create() {
        $user = Auth::user();
        $categories = $user->category()->orderBy('name')->get();
        return inertia('expenses/Create',[
            'expenses' => Expenses::orderBy('created_at','asc')
            ->with('user')
            ->with('category')->get(),
            'users' => User::orderBy('name')->get(),
            'categories' => $categories,
        ]);
    }

    public function store(Request $request){
        $fields = $request->validate([
            'amount'=>'required',
            'description' => 'required',
            'cat_id'=>'numeric|required',
            'date' => 'required|date'
        ]);

        $exp = new Expenses([
            'amount' => $fields['amount'],
            'description' => $fields['description'],
            'user_id' => Auth::user()->id,
            'cat_id' =>$fields['cat_id'],
            'date'  =>$fields['date']
        ]);
        $exp->save();

        return redirect('/expenses')->with('message', 'Expenses Created Successfully');
    }

    public function edit(Expenses $expenses){
        $user = Auth::user();
        return inertia('expenses/Edit',[
            'expenses' => $expenses,
            'categories' => Category::orderBy('name')->where('user_id', $user->id)->get(),
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Expenses $expenses){
        $fields = $request->validate([
            'amount'=>'required',
            'description' => 'required',
            'cat_id'=>'numeric|required',
            'date' => 'required|date'
        ]);

        $expenses->update($fields);

        return redirect('/expenses')->with('message', "You successfully updated the expenses");
    }

    public function destroy(Expenses $expenses){

        $expenses->delete();

        return redirect('/expenses')->with('message', 'Expenses Deleted Successfully');
    }

}
