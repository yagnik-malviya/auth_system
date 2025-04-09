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
                        $btn = '';
                        $btn .= '<a href="' . route('admin.contact.view', ['id' => $row->id]) . '"><button class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button></a>';
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
