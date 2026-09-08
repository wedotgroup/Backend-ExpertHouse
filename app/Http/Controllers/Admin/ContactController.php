<?php

namespace App\Http\Controllers\Admin;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getQuery(){
    $data = Contact::paginate(10);
    return view('admin.enquiry.index', compact('data'));
}
}
