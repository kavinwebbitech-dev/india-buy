<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorType;
use Yajra\DataTables\Facades\DataTables;

class VendorTypeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = VendorType::latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('vendor_name', function ($row) {
                    return $row->vendor_name;
                })

                ->addColumn('image', function ($row) {

                    if ($row->image) {
                        return '<img src="'.asset('uploads/vendor_types/'.$row->image).'" 
                                    width="60" height="60" 
                                    style="object-fit:cover;border:1px solid #ddd;padding:2px;">';
                    }

                    return '<span class="text-muted">No Image</span>';
                })

                ->addColumn('status', function ($row) {
                    return $row->status
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('admin.vendortype.edit', $row->id).'" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger delete" data-route="'.route('admin.vendortype.destroy', $row->id).'">Delete</button>
                    ';
                })

                ->rawColumns(['image','status','action'])
                ->make(true);
        }

        return view('admin.vendor_types.index');
    }

    public function create()
    {
        return view('admin.vendor_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/vendor_types'), $imageName);
        }

        VendorType::create([
            'vendor_name' => $request->vendor_name,
            'status' => $request->status ?? 1,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.vendortype.index')->with('success', 'Vendor Type Added');
    }

    public function edit($id)
    {
        $vendorType = VendorType::findOrFail($id);
        return view('admin.vendor_types.edit', compact('vendorType'));
    }

    public function update(Request $request, $id)
    {
        $vendorType = VendorType::findOrFail($id);

        $request->validate([
            'vendor_name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $imageName = $vendorType->image;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/vendor_types'), $imageName);
        }

        $vendorType->update([
            'vendor_name' => $request->vendor_name,
            'status' => $request->status ?? 1,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.vendortype.index')->with('success', 'Updated Successfully');
    }                                  

    public function destroy($id)
    {
        VendorType::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully'
        ]);
    }
}
