<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Contact;

class ContactContoller extends Controller
{
    public function addContact(Request $request) {
        // create birthday string from user dropbox input
        $birthday = ($request->year."-".$request->month."-".$request->day);
        // validate
        $this->validate($request, [
            'firstName'=>'required|string|max:255',
            'lastName'=>'required|string|max:255',
            'email'=>'required|unique:contacts|string|max:255',
            'phone'=>'nullable|string|max:255',
        ]);
        return Contact::create([
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'birthday'=>$birthday,
        ]);
    }

    public function editContact(Request $request) {
        // validate
        $this->validate($request, [
            'firstName'=>'required|string|max:255',
            'lastName'=>'required|string|max:255',
            'email'=>'required|string|max:255',
            'phone'=>'nullable|string|max:255',
            'birthday'=>'nullable|string|max:255',
        ]);
        return Contact::where('id', $request->id)->update($request->all());
    }

    public function deleteContact(Request $request) {
        // validate
        $this->validate($request, [
            'id' => 'required',
        ]);
        return Contact::where('id', $request->id)->delete();
    }

    public function getContact() {
        return Contact::orderBy('id', 'desc')->get();
    }

    public function addAddress(Request $request) {
        // validate
        $this->validate($request, [
            'addressName' => 'required',
            'iconImage' => 'required'
        ]);
        return Address::create([
            'addressName'=> $request->addressName,
            'iconImage' => $request->iconImage
        ]);
    }

    public function editAddress(Request $request) {
        // validate
        $this->validate($request, [
            'id' => 'required',
            'number' => 'required',
            'street' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'type' => 'required',
        ]);
        return Address::where('id', $request->id)->update($request->all());
    }

    public function deleteAddress(Request $request) {
        // validate
        $this->validate($request, [
            'id' => 'required',
        ]);
        return Address::where('id', $request->id)->delete();
    }

    public function getAddress() {
        return Address::orderBy('id', 'desc')->get();
    }
}
