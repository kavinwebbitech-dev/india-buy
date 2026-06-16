<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessType;
use App\Models\VendorType;
use Yajra\DataTables\Facades\DataTables;

class BusinessTypeController extends Controller
{
    // ✅ LIST + DATATABLE
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = BusinessType::with('vendorType')->latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('vendor_type', function ($row) {
                    return $row->vendorType->vendor_name ?? '-';
                })

                ->addColumn('status', function ($row) {
                    return $row->status
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('admin.businesstype.edit',$row->id).'" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger delete" data-route="'.route('admin.businesstype.destroy',$row->id).'">Delete</button>
                    ';
                })

                ->rawColumns(['status','action'])
                ->make(true);
        }

        return view('admin.business_types.index');
    }

    // ✅ CREATE PAGE
    public function create()
    {
        $vendorTypes = VendorType::where('status',1)->get();
        return view('admin.business_types.create', compact('vendorTypes'));
    }

    // ✅ STORE
    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required',
            'vendor_type_id' => 'required'
        ]);

        BusinessType::create([
            'business_name' => $request->business_name,
            'vendor_type_id' => $request->vendor_type_id,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.businesstype.index')
                         ->with('success', 'Business Type Added');
    }

    // ✅ EDIT PAGE
    public function edit($id)
    {
        $data = BusinessType::findOrFail($id);
        $vendorTypes = VendorType::all();

        return view('admin.business_types.edit', compact('data','vendorTypes'));
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $data = BusinessType::findOrFail($id);

        $data->update([
            'business_name' => $request->business_name,
            'vendor_type_id' => $request->vendor_type_id,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.businesstype.index')
                         ->with('success', 'Updated Successfully');
    }

    // ✅ DELETE (AJAX)
    public function destroy($id)
    {
        BusinessType::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully'
        ]);
    }
}