<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\VendorType;
use App\Models\BusinessType;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    // ✅ INDEX
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Category::with(['vendorType','businessType'])->latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('vendor_type', function ($row) {
                    return $row->vendorType->vendor_name ?? '-';
                })

                ->addColumn('business_type', function ($row) {
                    return $row->businessType->business_name ?? '-';
                })

                // ✅ IMAGE COLUMN
                ->editColumn('image', function ($row) {
                    if (!$row->image) return '-';

                    $url = asset('uploads/categories/'.$row->image);

                    return '<img src="'.$url.'" 
                            style="width:50px;height:50px;object-fit:cover;border-radius:6px;">';
                })

                ->addColumn('status', function ($row) {
                    return $row->status
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', function ($row) {
                    return '
                        <a href="'.route('admin.category.edit',$row->id).'" class="btn btn-sm btn-primary">Edit</a>
                        <button class="btn btn-sm btn-danger delete" 
                            data-route="'.route('admin.category.destroy',$row->id).'">Delete</button>
                    ';
                })

                ->rawColumns(['image','status','action'])
                ->make(true);
        }

        return view('admin.categories.index');
    }

    // ✅ CREATE
    public function create()
    {
        $vendorTypes = VendorType::where('status',1)->get();
      
        return view('admin.categories.create', compact('vendorTypes'));
    }

    // ✅ STORE
    public function store(Request $request)
    {
        $request->validate([
            'vendor_type_id'   => 'required',
            'business_type_id' => 'required',
            'category_name'    => 'required',
            'image'            => 'required|image|mimes:jpg,jpeg,png,webp'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
        }

        Category::create([
            'vendor_type_id'   => $request->vendor_type_id,
            'business_type_id' => $request->business_type_id,
            'category_name'    => $request->category_name,
            'image'            => $imageName,
            'status'           => $request->status ?? 1,
        ]);

        return redirect()->route('admin.category.index')->with('success','Category Added');
    }

    // ✅ EDIT
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        $vendorTypes = VendorType::all();
        $businessTypes = BusinessType::where('vendor_type_id',$data->vendor_type_id)->get();

        return view('admin.categories.edit', compact('data','vendorTypes','businessTypes'));
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $data = Category::findOrFail($id);

        $request->validate([
            'vendor_type_id'   => 'required',
            'business_type_id' => 'required',
            'category_name'    => 'required',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        $imageName = $data->image;

        if ($request->hasFile('image')) {

            // delete old image
            if ($data->image && file_exists(public_path('uploads/categories/'.$data->image))) {
                unlink(public_path('uploads/categories/'.$data->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
        }

        $data->update([
            'vendor_type_id'   => $request->vendor_type_id,
            'business_type_id' => $request->business_type_id,
            'category_name'    => $request->category_name,
            'image'            => $imageName,
            'status'           => $request->status ?? 1,
        ]);

        return redirect()->route('admin.category.index')->with('success','Category Updated');
    }

    // ✅ DELETE
    public function destroy($id)
    {
        $data = Category::findOrFail($id);

        if ($data->image && file_exists(public_path('uploads/categories/'.$data->image))) {
            unlink(public_path('uploads/categories/'.$data->image));
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully'
        ]);
    }


    public function getBusinessTypes($vendor_id) 
{
    $businessTypes = BusinessType::where('vendor_type_id', $vendor_id)
                        ->where('status', 1)
                        ->get();

    return response()->json($businessTypes);
}

public function subcategoryIndex(Request $request)
{
    if ($request->ajax()) {

        $data = SubCategory::with(['category','businessType'])->latest();

        return DataTables::of($data)
            ->addIndexColumn()

           
            ->addColumn('business_type', function ($row) {
                return $row->businessType->business_name ?? '-';
            })

            ->addColumn('category', function ($row) {
                return $row->category->category_name ?? '-';
            })

           
            ->addColumn('sub_category_name', function ($row) {
                return $row->sub_category_name;
            })

            
            ->addColumn('status', function ($row) {

                if($row->status == 1){
                    return '<span class="badge bg-success">Active</span>';
                }else{
                    return '<span class="badge bg-danger">Inactive</span>';
                }
            })

           
            ->addColumn('action', function ($row) {

                return '
                    <a href="'.route('admin.subcategory.edit',$row->id).'" 
                        class="btn btn-sm btn-primary">
                        Edit
                    </a>

                    <button class="btn btn-sm btn-danger delete"
                        data-route="'.route('admin.subcategory.destroy',$row->id).'">
                        Delete
                    </button>
                ';
            })
            ->editColumn('image', function ($row) {
                    if (!$row->image) return '-';

                    $url = asset('uploads/subcategories/'.$row->image);

                    return '<img src="'.$url.'" 
                            style="width:50px;height:50px;object-fit:cover;border-radius:6px;">';
                })

            ->rawColumns(['status','action','image'])
            ->make(true);
    }

    return view('admin.sub_categories.index');
}

public function subcategoryCreate()
{
    $businessTypes = BusinessType::where('status',1)->get();

    return view(
        'admin.sub_categories.create',
        compact('businessTypes')
    );
}
public function subcategoryStore(Request $request)
{
    $request->validate([
        'business_type_id'  => 'required',
        'category_id'       => 'required',
        'sub_category_name' => 'required',
        'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp'
    ]);

    $imageName = null;

    // ✅ Image Upload
    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(
            public_path('uploads/subcategories'),
            $imageName
        );
    }

    // ✅ Store
    SubCategory::create([
        'business_type_id'  => $request->business_type_id,
        'category_id'       => $request->category_id,
        'sub_category_name' => $request->sub_category_name,
        'image'             => $imageName,
        'status'            => $request->status ?? 1
    ]);

    return redirect()
            ->route('admin.subcategory.index')
            ->with('success', 'Sub Category Added Successfully');
}


public function subcategoryEdit($id)
{
    $data = SubCategory::findOrFail($id);

    $businessTypes = BusinessType::where('status',1)->get();

    $categories = Category::where('business_type_id', $data->business_type_id)
                    ->where('status',1)
                    ->get();

    return view(
        'admin.sub_categories.edit',
        compact('data','businessTypes','categories')
    );
}

public function subcategoryUpdate(Request $request, $id)
{
    $data = SubCategory::findOrFail($id);

    $request->validate([
        'business_type_id'  => 'required',
        'category_id'       => 'required',
        'sub_category_name' => 'required',
        'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp'
    ]);

    // ✅ Old Image
    $imageName = $data->image;

    // ✅ New Image Upload
    if ($request->hasFile('image')) {

        // delete old image
        if (
            $data->image &&
            file_exists(public_path('uploads/subcategories/' . $data->image))
        ) {
            unlink(public_path('uploads/subcategories/' . $data->image));
        }

        $image = $request->file('image');

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(
            public_path('uploads/subcategories'),
            $imageName
        );
    }

    // ✅ Update
    $data->update([
        'business_type_id'  => $request->business_type_id,
        'category_id'       => $request->category_id,
        'sub_category_name' => $request->sub_category_name,
        'image'             => $imageName,
        'status'            => $request->status ?? 1
    ]);

    return redirect()
            ->route('admin.subcategory.index')
            ->with('success', 'Updated Successfully');
}
public function subcategoryDestroy($id)
{
    $data = SubCategory::findOrFail($id);

    $data->delete();

    return response()->json([
        'status' => true,
        'message' => 'Deleted Successfully'
    ]);
}

public function getCategories($business_id)
{
    $categories = Category::where('business_type_id', $business_id)
                    ->where('status', 1)
                    ->get();

    return response()->json($categories);
}

}