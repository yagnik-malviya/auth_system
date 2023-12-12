<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function list(Request $request)
    {
        if($request->all())
        {
                $data = ContactUs::orderBy('id','DESC')->select('*');
	                return DataTables::of($data)
	                ->addIndexColumn()

	                ->addColumn('action', function($row){
                        $btn = '<a href="'.route('admin.contact.view',['id'=>$row->id]).'"><button class="btn-sm btn-success">View</button></a>
                                <button onclick="Delete('.$row->id.')" class="btn-sm btn-danger">Delete</button>';
                        return $btn;
	                })

	                ->rawColumns(['action'])
	                ->make(true);
        }
        return view('admin.contact.list');
    }

    public function view(Request $request)
    {
        $contact = ContactUs::where('id',$request->id)->first();
        if (empty($contact)) {
            return redirect()->back();
        }
        return view('admin.contact.view')->with(['data'=>$contact]);
    }
}
