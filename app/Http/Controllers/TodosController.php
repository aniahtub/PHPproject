<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodosController extends Controller
{
    function index(){
        return view('todos.index')->with('todos',Todo::all());
    }
    function show(Todo $todo){
        return view('todos.show')->with('todo',$todo);
    }
    function create(){
        return view('todos.create');
    }
    function store(Request $req){
        $this->validate(request(),[
            'name'=>'required|min:4',
            'description'=>'required'
        ]);
        Todo::create([
            'name'=>$req->name,
            'description'=>$req->description,
            'completed'=>false
        ]);
        session()->flash('status',' Todo created successfully.');
        return redirect('/todos');
    }
    public function edit(Todo $todo)
    {
        return view('todos.edit')->with('todo',$todo);
    }
    public function update(Request $req,Todo $todo){
        $this->validate(request(),[
            'name'=>'required|min:4',
            'description'=>'required'
        ]);
        $todo->update([
            'name'=>$req->name,
            'description'=>$req->description,
            'completed'=>false,
        ]);
        session()->flash('status',' Todo updated successfully.');

        return redirect('/todos');
    }
    function destroy(Todo $todo)
    {
        $todo->delete();
        session()->flash('status',' Todo deleted successfully.');
        return redirect('/todos');
    }
}
