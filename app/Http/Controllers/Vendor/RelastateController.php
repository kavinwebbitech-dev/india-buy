<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\VendorType;
use App\Models\BusinessType;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RealEstate;
use App\Models\Service;

class RelastateController extends Controller
{
    public function realEstateDashboard()
    {
        return view('vendor.relastate.dashboard');
    }
    public function Profile()
    {

        $vendor = Vendor::with([
            'vendorType',
            'businessType',
            'category',
            'subCategory'
        ])->findOrFail(Auth::guard('vendor')->id());

        $vendorTypes = VendorType::where('status', 1)->get();

        $businessTypes = BusinessType::where(
            'vendor_type_id',
            $vendor->vendor_type_id
        )->where('status', 1)->get();

        $categories = Category::where(
            'business_type_id',
            $vendor->business_id
        )->where('status', 1)->get();

        $subCategories = SubCategory::where(
            'category_id',
            $vendor->category_id
        )->where('status', 1)->get();

        return view(
            'vendor.relastate.profile',
            compact(
                'vendor',
                'vendorTypes',
                'businessTypes',
                'categories',
                'subCategories'
            )
        );
    }


    public function updateProfile(Request $request)
    {
        $vendor = Vendor::findOrFail(Auth::guard('vendor')->id());

        $request->validate([

            'vendor_type_id'   => 'required',
            'business_id'      => 'required',
            'category_id'      => 'required',
            'sub_category_id'  => 'required',

            'company_name'     => 'required|string|max:255',
            'about_us'         => 'required|string',

            'country'          => 'required|string|max:100',
            'state'            => 'required|string|max:100',
            'city'             => 'required|string|max:100',
            'address'          => 'required|string',

            'year_established' => 'required|numeric|digits:4',

            'phone'            => 'required|numeric|digits_between:10,15',

            'gst_no'           => 'required|string|max:15',

            'company_logo'     => 'nullable|image|mimes:jpg,jpeg,png,webp',

        ]);

        // CHECK DUPLICATE EMAIL + VENDOR TYPE
        $alreadyVendor = Vendor::where('email', $vendor->email)
            ->where('vendor_type_id', $request->vendor_type_id)
            ->where('id', '!=', $vendor->id)
            ->first();

        if ($alreadyVendor) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Already registered with this vendor type.'
                );
        }

        // LOGO UPLOAD
        if ($request->hasFile('company_logo')) {

            // DELETE OLD LOGO
            if (
                $vendor->company_logo &&
                file_exists(
                    public_path(
                        'uploads/vendor_logo/' .
                            $vendor->company_logo
                    )
                )
            ) {

                unlink(
                    public_path(
                        'uploads/vendor_logo/' .
                            $vendor->company_logo
                    )
                );
            }

            $file = $request->file('company_logo');

            $fileName = time() . '_' .
                Str::random(10) . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/vendor_logo'),
                $fileName
            );

            $vendor->company_logo = $fileName;
        }

        // UPDATE DATA
        $vendor->vendor_type_id  = $request->vendor_type_id;
        $vendor->business_id     = $request->business_id;
        $vendor->category_id     = $request->category_id;
        $vendor->sub_category_id = $request->sub_category_id;

        $vendor->company_name     = $request->company_name;
        $vendor->about_us         = $request->about_us;
        $vendor->year_established = $request->year_established;

        $vendor->country = $request->country;
        $vendor->state   = $request->state;
        $vendor->city    = $request->city;
        $vendor->address = $request->address;

        $vendor->phone  = $request->phone;
        $vendor->gst_no = $request->gst_no;

        $vendor->save();

        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully.');
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


    public function index(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();

        $query = RealEstate::with([
            'categoryData',
            'subCategoryData'
        ])->where('vendor_id', $vendor->id);

        // CATEGORY FILTER
        if ($request->category) {

            $query->where('category_id', $request->category);
        }

        // STATUS FILTER
        if ($request->status != '') {

            $query->where('status', $request->status);
        }

        // SEARCH
        if ($request->search) {

            $query->where(
                'property_title',
                'LIKE',
                '%' . $request->search . '%'
            );
        }

        $properties = $query->latest()->paginate(10);

        $categories = Category::where('status', 1)
            ->where('vendor_type_id', 3)
            ->orderBy('category_name', 'asc')
            ->get();

        return view(
            'vendor.relastate.products_index',
            compact(
                'properties',
                'categories'
            )
        );
    }


    public function create()
    {
        $vendor = Auth::guard('vendor')->user();
        $businessType = BusinessType::where('vendor_type_id', 3)->get();
        $categories = Category::where('status', 1)
            ->where('vendor_type_id', 3)
            ->orderBy('category_name', 'asc')
            ->get();

        return view('vendor.relastate.products_add', compact(
            'vendor',
            'categories',
            'businessType'
        ));
    }


    public function getSubCategories(Request $request)
    {
        $subcategories = SubCategory::where(
            'category_id',
            $request->category_id
        )
            ->where('status', 1)
            ->get();

        return response()->json($subcategories);
    }



    public function store(Request $request)
    {
        // 1. Clean & synchronized validation rules
        $request->validate([
            'property_title'      => 'required|string|max:255',
            'business_type'       => 'required',
            'category'            => 'required',
            'subcategory'         => 'required',
            'property_type'       => 'required',
            'listing_type'        => 'required', // Matches the Blade input name now

            'description'         => 'required|string',
            'state'               => 'required|string',
            'city'                => 'required|string',
            'address'             => 'required|string',
            'landmark'            => 'required|string',

            // Additional specifications and metadata arrays
            'specification_key'   => 'nullable|array',
            'specification_value' => 'nullable|array',
            'feature_key'         => 'nullable|array',
            'feature_value'       => 'nullable|array',

            // File collections
            'property_image'      => 'required|array',
            'property_image.*'    => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'documents'           => 'nullable|array',
            'documents.*'         => 'file|max:10240',

            // Optional specific construction structural variables
            'price'               => 'nullable|string',
            'total_area'          => 'nullable|string',
            'built_up_area'       => 'nullable|string',
            'carpet_area'         => 'nullable|string',
            'project_status'      => 'nullable|string',
            'construction_type'   => 'nullable|string',
            'floors'              => 'nullable|string',
            'units'               => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $vendor = Auth::guard('vendor')->user();

            /* ---------------- IMAGES UPLOAD ---------------- */
            $propertyImages = [];
            if ($request->hasFile('property_image')) {
                foreach ($request->file('property_image') as $image) {
                    $name = time() . '_' . rand(1000, 9999) . '.' . $image->extension();
                    $image->move(public_path('uploads/realestate/images'), $name);
                    $propertyImages[] = $name;
                }
            }

            /* ---------------- DOCUMENTS UPLOAD ---------------- */
            $documents = [];
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    $name = time() . '_' . rand(1000, 9999) . '.' . $file->extension();
                    $file->move(public_path('uploads/realestate/documents'), $name);
                    $documents[] = $name;
                }
            }

            /* ---------------- SPECIFICATIONS PROCESSED ---------------- */
            $specifications = [];
            if ($request->has('specification_key') && is_array($request->specification_key)) {
                foreach ($request->specification_key as $i => $key) {
                    if (!empty($key)) {
                        $specifications[] = [
                            'key'   => $key,
                            'value' => $request->specification_value[$i] ?? null
                        ];
                    }
                }
            }

            /* ---------------- FEATURES PROCESSED ---------------- */
            $features = [];
            if ($request->has('feature_key') && is_array($request->feature_key)) {
                foreach ($request->feature_key as $i => $key) {
                    if (!empty($key)) {
                        $features[] = [
                            'key'   => $key,
                            'value' => $request->feature_value[$i] ?? null
                        ];
                    }
                }
            }
            $bussiness = BusinessType::findOrFail($request->business_type);
            /* ---------------- SAVE DATA ENTITY ---------------- */
            $relastate = new RealEstate();

            $relastate->vendor_id        = (int) $vendor->id;
            $relastate->vendor_type_id   = (int) $bussiness->vendor_type_id ?? '';
            $relastate->property_title   = $request->property_title;
            $relastate->business_type_id = $request->business_type;
            $relastate->category_id      = $request->category;
            $relastate->sub_category_id  = $request->subcategory;
            $relastate->property_type    = $request->property_type;
            $relastate->property_for     = $request->listing_type; // Maps listing_type form selection
            $relastate->description      = $request->description;

            $relastate->state            = $request->state;
            $relastate->city             = $request->city;
            $relastate->address          = $request->address;
            $relastate->landmark         = $request->landmark;

            // Structured Layout & Spec Items encoded as JSON
            $relastate->specification    = json_encode($specifications);
            $relastate->features         = json_encode($features);
            $relastate->proerty_image   = json_encode($propertyImages);
            $relastate->documents        = json_encode($documents);

            // Optional Fields Assignment (Ensure your migration contains these columns)
            $relastate->price             = $request->price;
            $relastate->total_area        = $request->total_area;
            $relastate->built_up_area     = $request->built_up_area;
            $relastate->carpet_area        = $request->carpet_area;
            $relastate->project_status    = $request->project_status;
            $relastate->construction_type = $request->construction_type;
            $relastate->floors            = $request->floors;
            $relastate->units             = $request->units;

            $relastate->status           = 0;
            $relastate->save();

            DB::commit();

            return redirect()
                ->route('relastate.product.list')
                ->with('success', 'Property Added Successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $vendor = Auth::guard('vendor')->user();

        $property = RealEstate::where('id', $id)
            ->where('vendor_id', $vendor->id)
            ->firstOrFail();

        $businessType = BusinessType::where('vendor_type_id', 3)
            ->where('status', 1)
            ->get();

        $categories = Category::where('vendor_type_id', 3)
            ->where('status', 1)
            ->get();

        $subcategories = SubCategory::where(
            'category_id',
            $property->category_id
        )
            ->where('status', 1)
            ->get();

        return view(
            'vendor.relastate.products_edit',
            compact(
                'property',
                'businessType',
                'categories',
                'subcategories'
            )
        );
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([

    //         'property_title'      => 'required|string|max:255',
    //         'business_type'       => 'required',
    //         'category'            => 'required',
    //         'subcategory'         => 'required',

    //         'property_type'       => 'required',
    //         'listing_type'        => 'required',

    //         'description'         => 'required|string',
    //         'state'               => 'required|string',
    //         'city'                => 'required|string',
    //         'address'             => 'required|string',
    //         'landmark'            => 'required|string',

    //         'property_image.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

    //         'documents.*'         => 'nullable|file|max:10240',

    //         'specification_key'   => 'nullable|array',
    //         'specification_value' => 'nullable|array',

    //         'feature_key'         => 'nullable|array',
    //         'feature_value'       => 'nullable|array',

    //         'price'              => 'nullable|string',
    //         'total_area'         => 'nullable|string',
    //         'built_up_area'      => 'nullable|string',
    //         'carpet_area'        => 'nullable|string',
    //         'project_status'     => 'nullable|string',
    //         'construction_type'  => 'nullable|string',
    //         'floors'             => 'nullable|string',
    //         'units'              => 'nullable|string',
    //     ]);

    //     DB::beginTransaction();

    //     try {

    //         $property = RealEstate::findOrFail($id);

    //         /* ---------------- IMAGES ---------------- */

    //         $propertyImages = json_decode(
    //             $property->proerty_image,
    //             true
    //         ) ?? [];

    //         if ($request->hasFile('property_image')) {

    //             foreach ($propertyImages as $img) {

    //                 $oldImage = public_path(
    //                     'uploads/realestate/images/' . $img
    //                 );

    //                 if (file_exists($oldImage)) {
    //                     unlink($oldImage);
    //                 }
    //             }

    //             $propertyImages = [];

    //             foreach ($request->file('property_image') as $image) {

    //                 $imageName =
    //                     time() . '_' . rand(1000,9999) . '.' .
    //                     $image->getClientOriginalExtension();

    //                 $image->move(
    //                     public_path('uploads/realestate/images'),
    //                     $imageName
    //                 );

    //                 $propertyImages[] = $imageName;
    //             }
    //         }
    //         /* ---------------- DOCUMENTS ---------------- */
    //         $documents = json_decode(
    //             $property->documents,
    //             true
    //         ) ?? [];

    //         if ($request->hasFile('documents')) {

    //             foreach ($documents as $doc) {

    //                 $oldDoc = public_path(
    //                     'uploads/realestate/documents/' . $doc
    //                 );

    //                 if (file_exists($oldDoc)) {
    //                     unlink($oldDoc);
    //                 }
    //             }

    //             $documents = [];

    //             foreach ($request->file('documents') as $file) {

    //                 $docName =
    //                     time() . '_' . rand(1000,9999) . '.' .
    //                     $file->getClientOriginalExtension();

    //                 $file->move(
    //                     public_path('uploads/realestate/documents'),
    //                     $docName
    //                 );

    //                 $documents[] = $docName;
    //             }
    //         }
    //         /* ---------------- SPECIFICATIONS ---------------- */
    //         $specifications = [];

    //         if ($request->has('specification_key')) {

    //             foreach ($request->specification_key as $i => $key) {

    //                 if (!empty($key)) {

    //                     $specifications[] = [
    //                         'key'   => $key,
    //                         'value' => $request->specification_value[$i] ?? ''
    //                     ];
    //                 }
    //             }
    //         }

    //         /* ---------------- FEATURES ---------------- */

    //         $features = [];

    //         if ($request->has('feature_key')) {

    //             foreach ($request->feature_key as $i => $key) {

    //                 if (!empty($key)) {

    //                     $features[] = [
    //                         'key'   => $key,
    //                         'value' => $request->feature_value[$i] ?? ''
    //                     ];
    //                 }
    //             }
    //         }

    //         /* ---------------- UPDATE ---------------- */

    //         $property->property_title    = $request->property_title;

    //         $property->business_type_id = $request->business_type;
    //         $property->category_id      = $request->category;
    //         $property->sub_category_id  = $request->subcategory;

    //         $property->property_type    = $request->property_type;
    //         $property->property_for     = $request->listing_type;

    //         // table column name
    //         $property->description         = $request->description;

    //         $property->state            = $request->state;
    //         $property->city             = $request->city;
    //         $property->address          = $request->address;
    //         $property->landmark         = $request->landmark;

    //         $property->specification    = json_encode($specifications);
    //         $property->features         = json_encode($features);

    //         $property->proerty_image    = json_encode($propertyImages);
    //         $property->documents        = json_encode($documents);

    //         /* Optional Columns */

    //         $property->price             = $request->price;
    //         $property->total_area        = $request->total_area;
    //         $property->built_up_area     = $request->built_up_area;
    //         $property->carpet_area       = $request->carpet_area;
    //         $property->project_status    = $request->project_status;
    //         $property->construction_type = $request->construction_type;
    //         $property->floors            = $request->floors;
    //         $property->units             = $request->units;

    //         $property->save();

    //         DB::commit();

    //         return redirect()
    //             ->route('relastate.product.list')
    //             ->with(
    //                 'success',
    //                 'Property Updated Successfully'
    //             );

    //     } catch (\Exception $e) {

    //         DB::rollback();

    //         return back()
    //             ->withInput()
    //             ->with(
    //                 'error',
    //                 $e->getMessage()
    //             );
    //     }
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'property_title'      => 'required|string|max:255',
            'business_type'       => 'required',
            'category'            => 'required',
            'subcategory'         => 'required',
            'property_type'       => 'required',
            'listing_type'        => 'required',
            'description'         => 'required|string',
            'state'               => 'required|string',
            'city'                => 'required|string',
            'address'             => 'required|string',
            'landmark'            => 'required|string',
            'property_image.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'documents.*'         => 'nullable|file|max:10240',
            'specification_key'   => 'nullable|array',
            'specification_value' => 'nullable|array',
            'feature_key'         => 'nullable|array',
            'feature_value'       => 'nullable|array',
            'price'               => 'nullable|string',
            'total_area'          => 'nullable|string',
            'built_up_area'       => 'nullable|string',
            'carpet_area'         => 'nullable|string',
            'project_status'      => 'nullable|string',
            'construction_type'   => 'nullable|string',
            'floors'              => 'nullable|string',
            'units'               => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $property = RealEstate::findOrFail($id);

            /* ---------------- IMAGES ---------------- */

            // Files user chose to keep (hidden inputs still present in DOM)
            $propertyImages = $request->old_images ?? [];

            // Files stored in DB before this update
            $oldDbImages = json_decode($property->proerty_image, true) ?? [];

            // Delete only images the user removed
            foreach (array_diff($oldDbImages, $propertyImages) as $removed) {
                $path = public_path('uploads/realestate/images/' . $removed);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Upload & append new images
            if ($request->hasFile('property_image')) {
                foreach ($request->file('property_image') as $image) {
                    $name = time() . '_' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/realestate/images'), $name);
                    $propertyImages[] = $name;
                }
            }

            /* ---------------- DOCUMENTS ---------------- */

            // Files user chose to keep
            $documents = $request->old_documents ?? [];

            // Files stored in DB before this update
            $oldDbDocuments = json_decode($property->documents, true) ?? [];

            // Delete only documents the user removed
            foreach (array_diff($oldDbDocuments, $documents) as $removed) {
                $path = public_path('uploads/realestate/documents/' . $removed);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Upload & append new documents
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    $name = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/realestate/documents'), $name);
                    $documents[] = $name;
                }
            }

            /* ---------------- SPECIFICATIONS ---------------- */
            $specifications = [];
            if ($request->has('specification_key')) {
                foreach ($request->specification_key as $i => $key) {
                    if (!empty($key)) {
                        $specifications[] = [
                            'key'   => $key,
                            'value' => $request->specification_value[$i] ?? '',
                        ];
                    }
                }
            }

            /* ---------------- FEATURES ---------------- */
            $features = [];
            if ($request->has('feature_key')) {
                foreach ($request->feature_key as $i => $key) {
                    if (!empty($key)) {
                        $features[] = [
                            'key'   => $key,
                            'value' => $request->feature_value[$i] ?? '',
                        ];
                    }
                }
            }

            /* ---------------- UPDATE ---------------- */
            $property->property_title    = $request->property_title;
            $property->business_type_id  = $request->business_type;
            $property->category_id       = $request->category;
            $property->sub_category_id   = $request->subcategory;
            $property->property_type     = $request->property_type;
            $property->property_for      = $request->listing_type;
            $property->description       = $request->description;
            $property->state             = $request->state;
            $property->city              = $request->city;
            $property->address           = $request->address;
            $property->landmark          = $request->landmark;
            $property->specification     = json_encode($specifications);
            $property->features          = json_encode($features);
            $property->proerty_image     = json_encode($propertyImages);
            $property->documents         = json_encode($documents);
            $property->price             = $request->price;
            $property->total_area        = $request->total_area;
            $property->built_up_area     = $request->built_up_area;
            $property->carpet_area       = $request->carpet_area;
            $property->project_status    = $request->project_status;
            $property->construction_type = $request->construction_type;
            $property->floors            = $request->floors;
            $property->units             = $request->units;
            $property->save();

            DB::commit();

            return redirect()
                ->route('relastate.product.list')
                ->with('success', 'Property Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            $property = RealEstate::findOrFail($id);



            $datasheets = json_decode($property->datasheet, true) ?? [];

            foreach ($datasheets as $sheet) {

                $path = public_path('uploads/relastate/datasheet/' . $sheet);

                if (file_exists($path)) {
                    unlink($path);
                }
            }



            $images = json_decode($property->proerty_image, true) ?? [];

            foreach ($images as $img) {

                $path = public_path('uploads/relastate/images/' . $img);

                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $property->delete();

            return redirect()
                ->back()
                ->with('success', 'Property Deleted Successfully');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $vendor = Auth::guard('vendor')->user();

        $services = RealEstate::where('id', $id)->where('vendor_id', $vendor->id)
            ->latest()
            ->get();

        return view(
            'vendor.relastate.products_show',
            compact('vendor', 'services')
        );
    }
}
