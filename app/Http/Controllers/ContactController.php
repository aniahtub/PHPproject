<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    function index()
    {
        return view('index')->with('contacts',Contact::all());
    }
    function store(Request $req)
    {
        $this->validate(request(),[
            'first_name'=>'required|min:3',
            'last_name'=>'required|min:3',
            'email'=>'required|email|unique:contacts,email',
            'phone'=>'required|integer|unique:contacts,phone'
        ]);
        // dd(Carbon::parse($req->reminder)->format('d-m-Y H:i:s'));
        Contact::create([
            'first_name'=>$req->first_name,
            'last_name'=>$req->last_name,
            'email'=>$req->email,
            'phone'=>$req->phone
        ]);
        session()->flash('status',' Contact created successfully.');
        return Redirect::back();
    }

    public function update(Request $req,Contact $contact){
        $this->validate(request(),[
            'first_name'=>'required|min:3',
            'last_name'=>'required|min:3',
            'email'=>'required|email|unique:contacts,email,'.$contact->id,
            'phone'=>'required|integer|unique:contacts,phone,'.$contact->id
        ]);
        $contact->update([
            'first_name'=>$req->first_name,
            'last_name'=>$req->last_name,
            'email'=>$req->email,
            'phone'=>$req->phone
        ]);
        session()->flash('status',' Contact updated successfully.');
        return Redirect::back();
    }
    function destroy(Contact $contact)
    {
        $contact->delete();
        session()->flash('status',' Contact deleted successfully.');
        return Redirect::back();
    }
}
