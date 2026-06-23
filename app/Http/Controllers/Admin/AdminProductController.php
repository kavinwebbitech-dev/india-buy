<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Vendor;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Service;
use App\Models\VendorType;
use App\Models\RealEstate;

class AdminProductController extends Controller
{



public function index(Request $request)
{
    if ($request->ajax()) {

        $products = Product::with([
            'vendor',
            'categoryData',
            'subCategoryData'
        ]);

        // FILTER: PRODUCT NAME
        if ($request->product_name) {
            $products->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        // FILTER: CATEGORY
        if ($request->category) {
            $products->where('category_id', $request->category);
        }

        // FILTER: STATUS
        if ($request->status !== null && $request->status !== '') {
            $products->where('status', $request->status);
        }

        return DataTables::of($products)

            ->addIndexColumn()

            // PRODUCT COLUMN
            ->addColumn('product', function ($row) {

                $img = json_decode($row->image, true)[0] ?? null;

                $imgUrl = $img
                    ? asset('uploads/products/' . $img)
                    : asset('admin/no-image.png');

                return '
                    <div class="d-flex align-items-center gap-2">
                        <img src="'.$imgUrl.'" width="45" height="45"
                             style="border-radius:8px;object-fit:cover;">
                        <div>
                            <strong>'.$row->product_name.'</strong><br>
                            <small>'.$row->model_number.'</small>
                        </div>
                    </div>
                ';
            })

            // CATEGORY
            ->addColumn('category', function ($row) {
                return $row->categoryData->category_name ?? '-';
            })

            // SUB CATEGORY
            ->addColumn('sub_category', function ($row) {
                return $row->subCategoryData->sub_category_name ?? '-';
            })

            // STATUS
            ->addColumn('status', function ($row) {

                if ($row->status == 1) {

                    return '<span class="badge bg-success">Active</span>';

                }

                return '<span class="badge bg-danger">Inactive</span>';
            })

            // ACTION
           ->addColumn('action', function ($row) {

                $edit = route('admin.products.edit', $row->id);
                $delete = route('admin.products.delete', $row->id);
                $show = route('admin.products.show', $row->id);

                return '

                    <a href="'.$show.'"
                    class="btn btn-sm btn-info text-white">
                        <i class="fa fa-eye"></i>
                    </a>

                    <a href="'.$edit.'"
                    class="btn btn-sm btn-primary">
                        <i class="fa fa-edit"></i>
                    </a>

                    <button type="button"
                            data-route="'.$delete.'"
                            class="btn btn-sm btn-danger delete">
                        <i class="fa fa-trash"></i>
                    </button>

                ';
            })

            ->rawColumns(['product', 'status', 'action'])
            ->make(true);
    }

    $categories = Category::where('status', 1)->get();

    return view('admin.products.index', compact('categories'));
}

 
   // SHOW
public function show($id)
{
    $product = Product::with([
        'vendor',
        'categoryData',
        'subCategoryData'
    ])->findOrFail($id);

    return view(
        'admin.products.show',
        compact('product')
    );
}

   
  // EDIT
public function edit($id)
{
    $product = Product::with([
        'categoryData',
        'subCategoryData'
    ])->findOrFail($id);

    return view(
        'admin.products.edit',
        compact('product')
    );
}


// UPDATE STATUS ONLY
public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:0,1'
    ]);

    $product = Product::findOrFail($id);

    $product->update([
        'status' => $request->status
    ]);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product Status Updated Successfully');
}

   
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // DELETE IMAGES
        if ($product->image) {
            foreach (json_decode($product->image, true) ?? [] as $img) {
                $path = public_path('uploads/products/' . $img);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        // DELETE DATA SHEET
        if ($product->data_sheet) {
            $path = public_path('uploads/datasheets/' . $product->data_sheet);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }


    public function serviceIndex(Request $request)
{
    if ($request->ajax()) {

        $services = Service::with([
            'vendor'
        ]);

        /*
        |--------------------------------------------------------------------------
        | FILTER : SERVICE NAME
        |--------------------------------------------------------------------------
        */

        if ($request->service_name) {

            $services->where(
                'service_name',
                'like',
                '%' . $request->service_name . '%'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER : STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->status !== null && $request->status !== '') {

            $services->where(
                'status',
                $request->status
            );
        }

        return DataTables::of($services)

            ->addIndexColumn()

            /*
            |--------------------------------------------------------------------------
            | SERVICE COLUMN
            |--------------------------------------------------------------------------
            */

            ->addColumn('service', function ($row) {

                $images = json_decode($row->service_img, true);

                $img = null;

                if (is_array($images) && count($images) > 0) {

                    $img = $images[0];

                } elseif (!empty($row->service_img)) {

                    $img = $row->service_img;
                }

                $imgUrl = $img
                    ? asset('uploads/service/images/' . $img)
                    : asset('admin/no-image.png');

                return '

                    <div class="d-flex align-items-center gap-2">

                        <img src="'.$imgUrl.'"
                             width="45"
                             height="45"
                             style="border-radius:8px;object-fit:cover;">

                        <div>

                            <strong>'.$row->service_name.'</strong><br>

                            <small>'.$row->service_city.'</small>

                        </div>

                    </div>

                ';
            })

           

            ->addColumn('vendor', function ($row) {

                return $row->vendor->company_name ?? '-';

            })

           

            ->addColumn('location', function ($row) {

                return $row->service_city . ', ' . $row->service_state;

            })

        

            ->addColumn('status', function ($row) {

                if ($row->status == 1) {

                    return '<span class="badge bg-success">Active</span>';

                }

                return '<span class="badge bg-danger">Inactive</span>';

            })

         

            ->addColumn('action', function ($row) {

                $edit = route('admin.services.edit', $row->id);

                $delete = route('admin.services.delete', $row->id);

                $show = route('admin.services.show', $row->id);

                return '

                    <a href="'.$show.'"
                       class="btn btn-sm btn-info text-white">

                        <i class="fa fa-eye"></i>

                    </a>

                    <a href="'.$edit.'"
                       class="btn btn-sm btn-primary">

                        <i class="fa fa-edit"></i>

                    </a>

                    <button type="button"
                            data-route="'.$delete.'"
                            class="btn btn-sm btn-danger delete">

                        <i class="fa fa-trash"></i>

                    </button>

                ';
            })

            ->rawColumns([
                'service',
                'status',
                'action'
            ])

            ->make(true);
    }

    return view('admin.service.index');
}

public function serviceEdit($id)
{
    $service = Service::with([
        'categoryData',
        'subCategoryData',
        'vendor'
    ])->findOrFail($id);

    return view('admin.service.edit', compact('service'));
}


public function serviceUpdate(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:0,1',
    ]);

    $service = Service::findOrFail($id);

    $service->status = $request->status;

    $service->save();

    return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service status updated successfully');
}

public function serviceShow($id)
{
    $service = Service::with([
        'vendor',
        'categoryData',
        'subCategoryData'
    ])->findOrFail($id);

    return view('admin.service.show', compact('service'));
}


public function serviceDelete($id)
{
    $service = Service::findOrFail($id);

    // DELETE IMAGES
    $images = json_decode($service->service_img, true);

    if (is_array($images)) {

        foreach ($images as $img) {

            $path = public_path('uploads/service/images/' . $img);

            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    // DELETE DATASHEET
    if ($service->datasheet) {

        $datasheetPath = public_path('uploads/service/datasheet/' . $service->datasheet);

        if (file_exists($datasheetPath)) {
            unlink($datasheetPath);
        }
    }

    $service->delete();

    return response()->json([
        'success' => true
    ]);
}




public function propertyIndex(Request $request)
{
    if ($request->ajax()) {

        $properties = RealEstate::with([
            'vendor',
            'categoryData',
            'subCategoryData'
        ]);

       

        if ($request->property_title) {

            $properties->where(
                'property_title',
                'like',
                '%' . $request->property_title . '%'
            );
        }

        

        if ($request->status !== null && $request->status !== '') {

            $properties->where(
                'status',
                $request->status
            );
        }

        return DataTables::of($properties)

            ->addIndexColumn()

            

            ->addColumn('property', function ($row) {

                $images = json_decode($row->proerty_image, true);

                $img = null;

                if (is_array($images) && count($images) > 0) {

                    $img = $images[0];

                }

                $imgUrl = $img
                    ? asset('uploads/relastate/images/' . $img)
                    : asset('admin/no-image.png');

                return '

                    <div class="d-flex align-items-center gap-2">

                        <img src="'.$imgUrl.'"
                             width="50"
                             height="50"
                             style="border-radius:8px;object-fit:cover;">

                        <div>

                            <strong>'.$row->property_title.'</strong><br>

                            <small>'.$row->city.'</small>

                        </div>

                    </div>

                ';
            })

           

            ->addColumn('vendor', function ($row) {

                return $row->vendor->company_name ?? '-';

            })

         

            ->addColumn('property_type', function ($row) {

                return $row->property_type ?? '-';

            })

           

            ->addColumn('location', function ($row) {

                return $row->city . ', ' . $row->state;

            })

           

            ->addColumn('status', function ($row) {

                if ($row->status == 1) {

                    return '<span class="badge bg-success">Active</span>';

                }

                return '<span class="badge bg-danger">Inactive</span>';

            })

          

            ->addColumn('action', function ($row) {

                $edit = route('admin.properties.edit', $row->id);

                $delete = route('admin.properties.delete', $row->id);

                $show = route('admin.properties.show', $row->id);

                return '

                    <a href="'.$show.'"
                       class="btn btn-sm btn-info text-white">

                        <i class="fa fa-eye"></i>

                    </a>

                    <a href="'.$edit.'"
                       class="btn btn-sm btn-primary">

                        <i class="fa fa-edit"></i>

                    </a>

                    <button type="button"
                            data-route="'.$delete.'"
                            class="btn btn-sm btn-danger delete">

                        <i class="fa fa-trash"></i>

                    </button>

                ';
            })

            ->rawColumns([
                'property',
                'status',
                'action'
            ])

            ->make(true);
    }

    return view('admin.relastate.index');
}

public function propertyEdit($id)
{
    $property = RealEstate::with([
        'vendor',
        'categoryData',
        'subCategoryData'
    ])->findOrFail($id);

    return view(
        'admin.relastate.edit',
        compact('property')
    );
}

public function propertyUpdate(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:0,1',
    ]);

    $property = RealEstate::findOrFail($id);

    $property->status = $request->status;

    $property->save();

    return redirect()
            ->route('admin.properties.index')
            ->with(
                'success',
                'Property status updated successfully'
            );
}

public function propertyShow($id)
{
    $property = RealEstate::with([
        'vendor',
        'categoryData',
        'subCategoryData'
    ])->findOrFail($id);

    return view(
        'admin.relastate.show',
        compact('property')
    );
}

public function propertyDelete($id)
{
    $property = RealEstate::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | DELETE PROPERTY IMAGES
    |--------------------------------------------------------------------------
    */

    $images = json_decode($property->proerty_image, true);

    if (is_array($images)) {

        foreach ($images as $img) {

            $path = public_path(
                'uploads/relastate/images/' . $img
            );

            if (file_exists($path)) {

                unlink($path);

            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE DATASHEETS
    |--------------------------------------------------------------------------
    */

    $datasheets = json_decode($property->datasheet, true);

    if (is_array($datasheets)) {

        foreach ($datasheets as $file) {

            $path = public_path(
                'uploads/relastate/documents/' . $file
            );

            if (file_exists($path)) {

                unlink($path);

            }
        }
    }

    $property->delete();

    return response()->json([
        'success' => true
    ]);
}

}