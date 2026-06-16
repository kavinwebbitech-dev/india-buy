<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Support\Facades\DB;



class ManufacturerController extends Controller
{

    public function index(Request $request)
    {
        $vendorId = Auth::guard('vendor')->id();
        $query = Product::with(['categoryData', 'subCategoryData'])
            ->where('vendor_id', $vendorId);

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        // 📂 CATEGORY FILTER
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 📦 SUB CATEGORY FILTER
        if ($request->filled('sub_category')) {
            $query->where('sub_category_id', $request->sub_category);
        }

        // ⚡ STATUS FILTER
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products = $query->latest()->get();
        // dd($products);
        // categories for filter dropdown
        $categories = Category::where('vendor_type_id', 1)->where('status', 1)
            // ->where('business_type_id', Auth::guard('vendor')->user()->business_id)
            ->get();

        return view('vendor.manufacturer.products_index', compact('products', 'categories'));
    }




    public function create()
    {
        $vendor = Auth::guard('vendor')->user();
        $businessType = BusinessType::where('vendor_type_id', 1)->get();
        $categories = Category::where('status', 1)
            // ->where('business_type_id', $vendor->business_id)
            ->where('vendor_type_id', 1)
            ->get();

        return view(
            'vendor.manufacturer.products_create',
            compact('categories', 'businessType')
        );
    }




    public function getSubCategories(Request $request)
    {
        $subcategories = SubCategory::where(
            'category_id',
            $request->category_id
        )->get();

        return response()->json($subcategories);
    }


    public function store(Request $request)
    {
        $request->validate([

            'business_type'      => 'required',
            'category'           => 'required',
            'sub_category'       => 'required',

            'product_name'       => 'required|string|max:255',

            'image'              => 'required|array',
            'image.*'            => 'image|mimes:jpg,jpeg,png,webp|max:5120',

            'data_sheet'         => 'nullable|array',
            // 'data_sheet.*'       => 'nullable|file|max:10240',
            'data_sheet.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        DB::beginTransaction();

        try {

            $vendor = Auth::guard('vendor')->user();

            /* ==========================
           PRODUCT IMAGES
        ========================== */

            $images = [];

            if ($request->hasFile('image')) {

                foreach ($request->file('image') as $file) {

                    $imageName =
                        time() . '_' . rand(1000, 9999) . '.' .
                        $file->getClientOriginalExtension();

                    $file->move(
                        public_path('uploads/products'),
                        $imageName
                    );

                    $images[] = $imageName;
                }
            }

            /* ==========================
           DATA SHEETS
        ========================== */

            $datasheets = [];

            if ($request->hasFile('data_sheet')) {

                foreach ($request->file('data_sheet') as $file) {

                    $fileName =
                        time() . '_' . rand(1000, 9999) . '.' .
                        $file->getClientOriginalExtension();

                    $file->move(
                        public_path('uploads/datasheets'),
                        $fileName
                    );

                    $datasheets[] = $fileName;
                }
            }

            /* ==========================
           KEY VALUES
        ========================== */

            $keyValues = [];

            if ($request->key_name) {

                foreach ($request->key_name as $key => $name) {

                    if (!empty($name)) {

                        $keyValues[] = [

                            'key'   => $name,
                            'value' => $request->key_value[$key] ?? ''

                        ];
                    }
                }
            }

            /* ==========================
           SPECIFICATIONS
        ========================== */

            $specifications = [];

            if ($request->specification_name) {

                foreach ($request->specification_name as $key => $name) {

                    if (!empty($name)) {

                        $specifications[] = [

                            'name'  => $name,
                            'value' => $request->specification_value[$key] ?? ''

                        ];
                    }
                }
            }

            /* ==========================
           SAVE PRODUCT
        ========================== */

            Product::create([

                'vendor_id'         => $vendor->id,

                'business_type_id'  => $request->business_type,

                'vendor_type_id'    => 1,

                'category_id'       => $request->category,

                'sub_category_id'   => $request->sub_category,

                'product_name'      => $request->product_name,

                'brand'             => $request->brand,

                'model_number'      => $request->model_number,

                'short_description' => $request->short_description,

                'product_details'   => $request->product_details,

                'key_value'         => json_encode($keyValues),

                'specification'     => json_encode($specifications),

                'image'             => json_encode($images),

                'data_sheet'        => json_encode($datasheets),

                'status'            => 1
            ]);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Product Added Successfully');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $vendor = Auth::guard('vendor')->user();
        $product = Product::where('id', $id)
            ->where('vendor_id', $vendor->id)
            ->firstOrFail();

        $businessType = BusinessType::where('vendor_type_id', 1)->get();
        $categories = Category::where('status', 1)
            // ->where('business_type_id', $vendor->business_id)
            ->where('vendor_type_id', 1)
            ->get();

        return view('vendor.manufacturer.products_edit', compact('product', 'categories', 'businessType'));
    }

    // UPDATE
    //    public function update(Request $request, $id)
    // {
    //     $request->validate([

    //         'business_type'      => 'required',
    //         'category'           => 'required',
    //         'sub_category'       => 'required',

    //         'product_name'       => 'required|string|max:255',

    //         'image.*'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

    //         'data_sheet.*'       => 'nullable|file|max:10240',
    //     ]);

    //     DB::beginTransaction();

    //     try {

    //         $vendor = Auth::guard('vendor')->user();

    //         $product = Product::where('id', $id)
    //             ->where('vendor_id', $vendor->id)
    //             ->firstOrFail();

    //         /* =========================
    //             KEY VALUES
    //         ==========================*/

    //         $keyValues = [];

    //         if ($request->key_name) {

    //             foreach ($request->key_name as $index => $key) {

    //                 if (!empty($key)) {

    //                     $keyValues[] = [
    //                         'key'   => $key,
    //                         'value' => $request->key_value[$index] ?? ''
    //                     ];
    //                 }
    //             }
    //         }

    //         /* =========================
    //             SPECIFICATIONS
    //         ==========================*/

    //         $specifications = [];

    //         if ($request->specification_name) {

    //             foreach ($request->specification_name as $index => $name) {

    //                 if (!empty($name)) {

    //                     $specifications[] = [
    //                         'name'  => $name,
    //                         'value' => $request->specification_value[$index] ?? ''
    //                     ];
    //                 }
    //             }
    //         }

    //         /* =========================
    //             PRODUCT IMAGES
    //         ==========================*/

    //         $images = json_decode($product->image, true) ?? [];

    //         if ($request->hasFile('image')) {

    //             // delete old images
    //             foreach ($images as $img) {

    //                 $path = public_path('uploads/products/' . $img);

    //                 if (file_exists($path)) {
    //                     unlink($path);
    //                 }
    //             }

    //             $images = [];

    //             foreach ($request->file('image') as $file) {

    //                 $imageName =
    //                     time().'_'.rand(1000,9999).'.'.
    //                     $file->getClientOriginalExtension();

    //                 $file->move(
    //                     public_path('uploads/products'),
    //                     $imageName
    //                 );

    //                 $images[] = $imageName;
    //             }
    //         }

    //         /* =========================
    //             DATA SHEETS
    //         ==========================*/

    //         $datasheets = json_decode($product->data_sheet, true) ?? [];

    //         if ($request->hasFile('data_sheet')) {

    //             foreach ($datasheets as $sheet) {

    //                 $path = public_path('uploads/datasheets/' . $sheet);

    //                 if (file_exists($path)) {
    //                     unlink($path);
    //                 }
    //             }

    //             $datasheets = [];

    //             foreach ($request->file('data_sheet') as $file) {

    //                 $fileName =
    //                     time().'_'.rand(1000,9999).'.'.
    //                     $file->getClientOriginalExtension();

    //                 $file->move(
    //                     public_path('uploads/datasheets'),
    //                     $fileName
    //                 );

    //                 $datasheets[] = $fileName;
    //             }
    //         }

    //         /* =========================
    //             UPDATE PRODUCT
    //         ==========================*/

    //         $product->update([

    //             'business_type_id'  => $request->business_type,

    //             'category_id'       => $request->category,

    //             'sub_category_id'   => $request->sub_category,

    //             'product_name'      => $request->product_name,

    //             'brand'             => $request->brand,

    //             'model_number'      => $request->model_number,

    //             'short_description' => $request->short_description,

    //             'product_details'   => $request->product_details,

    //             'key_value'         => json_encode($keyValues),

    //             'specification'     => json_encode($specifications),

    //             'image'             => json_encode($images),

    //             'data_sheet'        => json_encode($datasheets),
    //         ]);

    //         DB::commit();

    //         return redirect()
    //             ->route('manufacturer.product.list')
    //             ->with('success', 'Product Updated Successfully');

    //     } catch (\Exception $e) {

    //         DB::rollback();

    //         return back()
    //             ->withInput()
    //             ->with('error', $e->getMessage());
    //     }
    // }

    public function update(Request $request, $id)
    {
        $request->validate([

            'business_type' => 'required',
            'category'      => 'required',
            'sub_category'  => 'required',

            'product_name'  => 'required|string|max:255',

            'image.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'data_sheet.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        DB::beginTransaction();

        try {

            $vendor = Auth::guard('vendor')->user();

            $product = Product::where('id', $id)
                ->where('vendor_id', $vendor->id)
                ->firstOrFail();

            /*
        |--------------------------------------------------------------------------
        | KEY VALUES
        |--------------------------------------------------------------------------
        */

            $keyValues = [];

            if ($request->key_name) {

                foreach ($request->key_name as $index => $key) {

                    if (!empty($key)) {

                        $keyValues[] = [
                            'key'   => $key,
                            'value' => $request->key_value[$index] ?? ''
                        ];
                    }
                }
            }

            /*
        |--------------------------------------------------------------------------
        | SPECIFICATIONS
        |--------------------------------------------------------------------------
        */

            $specifications = [];

            if ($request->specification_name) {

                foreach ($request->specification_name as $index => $name) {

                    if (!empty($name)) {

                        $specifications[] = [
                            'name'  => $name,
                            'value' => $request->specification_value[$index] ?? ''
                        ];
                    }
                }
            }

            /*
        |--------------------------------------------------------------------------
        | PRODUCT IMAGES
        |--------------------------------------------------------------------------
        */

            // Images still kept by user
            $images = $request->old_images ?? [];

            // Images currently stored in DB
            $oldDbImages = json_decode($product->image, true) ?? [];

            // Find removed images
            $deletedImages = array_diff($oldDbImages, $images);

            // Delete removed files
            foreach ($deletedImages as $img) {

                $path = public_path('uploads/products/' . $img);

                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Add newly uploaded images
            if ($request->hasFile('image')) {

                foreach ($request->file('image') as $file) {

                    $imageName =
                        time() . '_' . rand(1000, 9999) . '.' .
                        $file->getClientOriginalExtension();

                    $file->move(
                        public_path('uploads/products'),
                        $imageName
                    );

                    $images[] = $imageName;
                }
            }

            /*
|--------------------------------------------------------------------------
| DATA SHEETS
|--------------------------------------------------------------------------
*/

            // Existing datasheets kept by user
            $datasheets = $request->old_datasheets ?? [];

            // Datasheets stored in DB
            $oldDbDatasheets = json_decode($product->data_sheet, true) ?? [];

            // Deleted datasheets
            $deletedDatasheets = array_diff($oldDbDatasheets, $datasheets);

            foreach ($deletedDatasheets as $sheet) {

                $path = public_path('uploads/datasheets/' . $sheet);

                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Upload new datasheets
            if ($request->hasFile('data_sheet')) {

                foreach ($request->file('data_sheet') as $file) {

                    $fileName =
                        time() . '_' . rand(1000, 9999) . '.' .
                        $file->getClientOriginalExtension();

                    $file->move(
                        public_path('uploads/datasheets'),
                        $fileName
                    );

                    $datasheets[] = $fileName;
                }
            }

            /*
        |--------------------------------------------------------------------------
        | UPDATE PRODUCT
        |--------------------------------------------------------------------------
        */

            $product->update([

                'business_type_id' => $request->business_type,

                'category_id'      => $request->category,

                'sub_category_id'  => $request->sub_category,

                'product_name'     => $request->product_name,

                'brand'            => $request->brand,

                'model_number'     => $request->model_number,

                'short_description' => $request->short_description,

                'product_details'  => $request->product_details,

                'key_value'        => json_encode($keyValues),

                'specification'    => json_encode($specifications),

                'image'            => json_encode($images),

               'data_sheet' => json_encode($datasheets),
            ]);

            DB::commit();

            return redirect()
                ->route('manufacturer.product.list')
                ->with('success', 'Product Updated Successfully');
        } catch (\Exception $e) {

            DB::rollback();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $vendor = Auth::guard('vendor')->user();

        $product = Product::where('id', $id)
            ->where('vendor_id', $vendor->id)
            ->firstOrFail();

        // delete images
        if ($product->image) {
            foreach (json_decode($product->image, true) ?? [] as $img) {
                $path = public_path('uploads/products/' . $img);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        // delete datasheet
        if ($product->data_sheet) {
            $path = public_path('uploads/datasheets/' . $product->data_sheet);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $product->delete();

        return redirect()
            ->route('manufacturer.product.list')
            ->with('success', 'Product Deleted Successfully');
    }

    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('vendor.login')
            ->with('success', 'Vendor logout successfully.');
    }

    public function show($id)
    {
        $vendor = Auth::guard('vendor')->user();

        $product = Product::where('id', $id)
            ->where('vendor_id', $vendor->id)
            ->firstOrFail();

        return view(
            'vendor.manufacturer.products_show',
            compact('vendor', 'product')
        );
    }
}
