<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class CustomerController extends Controller
{
    public function index(Request $request)
    {
       if($request->datatable){
           $data = Customer::select('*');
           return Datatables::of($data)
               ->addIndexColumn()
               ->addColumn('action', function ($data){
                  return '<span class="dropdown">
                           <a href="#" class="btn btn-md btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
                             <i class="la la-gear"></i>
                           </a>
                           <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-36px, 25px, 0px);">
                               <a class="dropdown-item" href="'.route('customers.edit',$data->id).'"><i class="la la-edit"></i> '.__('Edit').'</a>
                               <a class="dropdown-item" href="'.route('customers.show',$data->id).'"><i class="la la-eye"></i> '.__('Show').'</a>
                               <a class="dropdown-item" href="javascript:void(0);" onclick="deleteCustomer(\'' . route( 'customers.destroy', $data->id ) . '\')"><i class="la la-trash"></i> '.__('Delete').'</a>
                           </div>
                       </span>';
               })
               ->rawColumns(['action'])
               ->make(true);
       }

       return view('customer.index');
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request , [
                'name' => 'required|string|min:3|max:100',
                'email' => 'required|email|max:255|unique:customers,email',
                'address' => 'required|string|max:255',
                'phone' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
                'city' => 'nullable|string|max:255',
                'gender' => 'required|string|in:male,female',
                'details' => 'nullable|string',
            ]);

            Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'city' => $request->city,
                'gender' => $request->gender,
                'details' => $request->details,
            ]);

            $notification = array(
                'message' => 'Customer is Added Succesfully',
                'alert-type' => 'success',
            );

            return redirect()->route('customers.index')->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.update', compact('customer'));
    }

    public function update(Request $request,$id)
    {
        try {
            $this->validate($request , [
                'name' => 'required|string|min:3|max:100',
                'email' => 'required|email|max:255|exists:customers,email',
                'address' => 'required|string|max:255',
                'phone' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
                'city' => 'nullable|string|max:255',
                'gender' => 'required|string|in:male,female',
                'details' => 'nullable|string',
            ]);

            $customer = Customer::findOrFail($id);
            $customer->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'city' => $request->city,
                'gender' => $request->gender,
                'details' => $request->details,
            ]);

            $notification = array(
                'message' => 'Customer is updated Succesfully',
                'alert-type' => 'info',
            );

            return redirect()->route('customers.index')->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $message = __( 'Customer deleted successfully' );
        $customer->where('id',$id)->delete();

        return $this->response(true, 200, $message );
    }
}
