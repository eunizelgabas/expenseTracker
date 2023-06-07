<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request as HttpRequest;

class CategoryController extends Controller
{
   
    public function index() {
        $user = Auth::user();
        $categoryQuery = Category::orderBy('name')
            ->with('user')
            ->where('user_id', $user->id);
        $search = HttpRequest::input('search');
        if ($search) {
            $categoryQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        $categories = $categoryQuery->paginate(3)->withQueryString();
        $itemCount = Category::withCount('expenses')->count();
        $users = User::orderBy('name')->get();

        return inertia('category/Index',[
                'categories' => $categories,
                'users' => $users,
                'itemCount' =>$itemCount,
                'filters' => HttpRequest::only(['search'])
                ])->withViewData(['title' => 'Category']);
    }

    public function create() {

        return inertia('category/Create',[
            'categories' => Category::orderBy('name')->with('user')->get(),
            'users' => User::orderBy('name')->get()
        ]);
    }

    public function store(Request $request){
        $fields = $request->validate([
            'name'=>'required',
        ]);

        $category = new Category([
            'name' => $fields['name'],
            'user_id' => Auth::user()->id,
        ]);
        $category->save();

        return redirect('/category')->with('message', 'Category Created Successfully');
    }

    public function edit(Category $category){
        return inertia('category/Edit',[
            'category' => $category,
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Category $category){
        $fields = $request->validate([
            'name'=>'required',
        ]);
            $category->update($fields);

        return redirect('/category')->with('message', "You successfully updated the category $category->name");
    }

    public function destroy(Category $category){

        $itemCount = $category->expenses()->count();

        if ($itemCount > 0) {
            return back()->withErrors(['GeneralErrors' => "The category $category->name contains $itemCount expenditures, hence you cannot delete it."]);
        }

        $category->delete();

        return redirect('/category')->with('message', 'Category Deleted Successfully');
    }
}
