<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorType;
use App\Models\BusinessType;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    
    


public function index(Request $request)
{
    if ($request->ajax()) {

        $vendors = Vendor::with([
            'vendorType',
            'businessType',
            'category',
            'subCategory'
        ])->latest();

        return DataTables::of($vendors)

            ->addIndexColumn()

            // LOGO
            ->addColumn('logo', function ($row) {

                if ($row->company_logo) {

                    return '
                        <img src="' . asset('uploads/vendor_logo/' . $row->company_logo) . '"
                             class="vendor-logo">
                    ';
                }

                return '
                    <img src="' . asset('admin/no-image.png') . '"
                         class="vendor-logo">
                ';
            })

            // VENDOR TYPE
            ->addColumn('vendor_type', function ($row) {

                return $row->vendorType->vendor_name ?? '-';

            })

            // STATUS
            ->addColumn('status', function ($row) {

                if ($row->status == 1) {

                    return '
                        <span class="badge bg-success">
                            Approved
                        </span>
                    ';
                }

                return '
                    <span class="badge bg-danger">
                        Pending
                    </span>
                ';
            })

            // ACTION
            ->addColumn('action', function ($row) {

                $editUrl = route('admin.vendors.edit', $row->id);

                $deleteUrl = route('admin.vendors.destroy', $row->id);

                return '

                    <a href="'.$editUrl.'"
                       class="btn btn-sm btn-primary">

                        <i class="fa fa-edit"></i>

                    </a>

                    <button type="button"
                            data-route="'.$deleteUrl.'"
                            class="btn btn-sm btn-danger delete">

                        <i class="fa fa-trash"></i>

                    </button>

                ';
            })

            ->rawColumns([
                'logo',
                'status',
                'action'
            ])

            ->make(true);
    }

    return view('admin.vendors.index');
}

    // EDIT PAGE
    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);

        $vendorTypes = VendorType::where('status', 1)->get();

        $businessTypes = BusinessType::where(
            'vendor_type_id',
            $vendor->vendor_type_id
        )->get();

        $categories = Category::where(
            'business_type_id',
            $vendor->business_id
        )->get();

        $subCategories = SubCategory::where(
            'category_id',
            $vendor->category_id
        )->get();

        return view(
            'admin.vendors.edit',
            compact(
                'vendor',
                'vendorTypes',
                'businessTypes',
                'categories',
                'subCategories'
            )
        );
    }

    // UPDATE
   public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        // VALIDATION
        $request->validate([

            'status' => 'required|in:0,1',

        ]);

        // UPDATE ONLY STATUS
        $vendor->status = $request->status;

        $vendor->save();

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor Status Updated Successfully');
    }

    // DELETE
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        if (
            $vendor->company_logo &&
            file_exists(public_path('uploads/vendor_logo/' . $vendor->company_logo))
        ) {

            unlink(public_path('uploads/vendor_logo/' . $vendor->company_logo));
        }

        $vendor->delete();

        return redirect()
            ->back()
            ->with('success', 'Vendor Deleted Successfully');
    }
}