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
use App\Models\Service;


class ServiceController extends Controller
{

    public function serviceDashboard()
    {
        return view('vendor.service.dashboard');
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
            'vendor.service.profile',
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
            'vendor_type_id'   => 'required|array',
            'vendor_type_id.*' => 'exists:vendor_types,id',
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

        $vendorTypes = implode(',', $request->vendor_type_id);

        $alreadyVendor = Vendor::where('email', $vendor->email)
            ->where('vendor_type_id', $vendorTypes)
            ->where('id', '!=', $vendor->id)
            ->first();

        if ($alreadyVendor) {
            return back()->withInput()->with('error', 'Already registered with selected vendor types.');
        }

        if ($request->hasFile('company_logo')) {
            if (
                !empty($vendor->company_logo) &&
                file_exists(public_path('uploads/vendor_logo/' . $vendor->company_logo))
            ) {
                unlink(public_path('uploads/vendor_logo/' . $vendor->company_logo));
            }

            $file     = $request->file('company_logo');
            $fileName = time() . '_' . \Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/vendor_logo'), $fileName);
            $vendor->company_logo = $fileName;
        }

        $vendor->vendor_type_id   = implode(',', $request->vendor_type_id);
        $vendor->company_name     = $request->company_name;
        $vendor->about_us         = $request->about_us;
        $vendor->year_established = $request->year_established;
        $vendor->country          = $request->country;
        $vendor->state            = $request->state;
        $vendor->city             = $request->city;
        $vendor->address          = $request->address;
        $vendor->phone            = $request->phone;
        $vendor->gst_no           = $request->gst_no;
        $vendor->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('vendor.login')->with('success', 'Vendor logout successfully.');
    }

    public function index(Request $request)
    {
        $vendor = Auth::guard('vendor')->user();

        $query = Service::with('categoryData')->where('vendor_id', $vendor->id);

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where('service_name', 'LIKE', '%' . $request->search . '%');
        }

        $services   = $query->latest()->paginate(10);
        $categories = Category::where('status', 1)->where('vendor_type_id', 2)->get();

        return view('vendor.service.products_index', compact('services', 'categories'));
    }

    public function create()
    {
        $vendor       = Auth::guard('vendor')->user();
        $categories   = Category::where('status', 1)->where('vendor_type_id', 2)->orderBy('category_name', 'asc')->get();
        $businessType = BusinessType::where('vendor_type_id', 2)->get();

        return view('vendor.service.products_add', compact('vendor', 'categories', 'businessType'));
    }

    public function getSubCategories(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)
            ->where('status', 1)
            ->get();

        return response()->json($subcategories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_type'     => 'required|exists:business_types,id',
            'service_name'      => 'required|string|max:255',
            'category'          => 'required',
            'subcategory'       => 'required',
            'short_description' => 'required|string',
            'long_description'  => 'required|string',
            'price_type'        => 'required|in:fixed,hourly,negotiable',
            'price'             => 'required_if:price_type,fixed,hourly|nullable|numeric|min:0',
            'state'             => 'required|string',
            'city'              => 'required|string',
            'available_days'    => 'required|string',
            'opening_time'      => 'required',
            'closing_time'      => 'required',
            'datasheet'         => 'nullable|file|mimes:pdf,doc,docx,xlsx|max:10240',
            'service_img'       => 'required|array|min:1',
            'service_img.*'     => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'feature_key'       => 'required|array|min:1',
            'feature_key.*'     => 'required|string',
            'feature_value'     => 'required|array|min:1',
            'feature_value.*'   => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $vendor = Auth::guard('vendor')->user();

            /* ---------------- DATASHEET ---------------- */
            $datasheetName = null;
            if ($request->hasFile('datasheet')) {
                $datasheet     = $request->file('datasheet');
                $datasheetName = time() . '_datasheet.' . $datasheet->getClientOriginalExtension();
                $datasheet->move(public_path('uploads/service/datasheet'), $datasheetName);
            }

            /* ---------------- IMAGES ---------------- */
            $serviceImagesArray = [];
            if ($request->hasFile('service_img')) {
                foreach ($request->file('service_img') as $index => $image) {
                    $imageName = time() . '_' . $index . '_service.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/service/images'), $imageName);
                    $serviceImagesArray[] = $imageName;
                }
            }

            /* ---------------- FEATURES ---------------- */
            $features = [];
            foreach ($request->feature_key as $key => $featureKey) {
                $features[] = [
                    'key'   => $featureKey,
                    'value' => $request->feature_value[$key] ?? null,
                ];
            }

            /* ---------------- SAVE ---------------- */
            $business = BusinessType::findOrFail($request->business_type);

            $service = new Service();
            $service->service_name      = $request->service_name;
            $service->business_type_id  = $request->business_type;
            $service->category          = $request->category;
            $service->subcategory       = $request->subcategory;
            $service->short_description = $request->short_description;
            $service->long_description  = $request->long_description;
            $service->price_type        = $request->price_type;
            $service->price             = $request->price;
            $service->service_state     = $request->state;
            $service->service_city      = $request->city;
            $service->available_days    = $request->available_days;
            $service->opening_time      = $request->opening_time;
            $service->closing_time      = $request->closing_time;
            $service->datasheet         = $datasheetName;
            $service->service_img       = json_encode($serviceImagesArray);
            $service->feature           = json_encode($features);
            $service->vendor_id         = $vendor->id;
            $service->vendor_type_id    = $business->vendor_type_id; // ✅ Fixed
            $service->status            = 1;
            $service->save();

            DB::commit();

            return redirect()->route('service.product.list')->with('success', 'Service Added Successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        $categories   = Category::where('vendor_type_id', 2)->get();
        $businessType = BusinessType::all();

        $subcategories = SubCategory::where('category_id', $service->category)->get();

        return view(
            'vendor.service.products_edit',
            compact('service', 'categories', 'businessType', 'subcategories')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'business_type'     => 'required|exists:business_types,id',
            'service_name'      => 'required|string|max:255',
            'category'          => 'required',
            'subcategory'       => 'required',
            'short_description' => 'required|string',
            'long_description'  => 'required|string',
            'price_type'        => 'required|in:fixed,hourly,negotiable',
            'price'             => 'required_if:price_type,fixed,hourly|nullable|numeric|min:0',
            'state'             => 'required|string',
            'city'              => 'required|string',
            'available_days'    => 'required|string',
            'opening_time'      => 'required',
            'closing_time'      => 'required',
            'datasheet'         => 'nullable|file|mimes:pdf,doc,docx,xlsx|max:10240',
            'service_img'       => 'nullable|array',
            'service_img.*'     => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'feature_key'       => 'required|array|min:1',
            'feature_key.*'     => 'required|string',
            'feature_value'     => 'required|array|min:1',
            'feature_value.*'   => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $service = Service::findOrFail($id);

            /* ============================================================
            | DATASHEET
            | If user uploaded a new one → replace old
            | If user removed existing (keep_datasheet not sent) → delete
            | If no new upload and keep_datasheet present → keep existing
            ============================================================ */
            if ($request->hasFile('datasheet')) {
                // Delete old datasheet if exists
                if ($service->datasheet && file_exists(public_path('uploads/service/datasheet/' . $service->datasheet))) {
                    unlink(public_path('uploads/service/datasheet/' . $service->datasheet));
                }

                $datasheet         = $request->file('datasheet');
                $datasheetName     = time() . '_datasheet.' . $datasheet->getClientOriginalExtension();
                $datasheet->move(public_path('uploads/service/datasheet'), $datasheetName);
                $service->datasheet = $datasheetName;

            } elseif (!$request->has('keep_datasheet')) {
                // User clicked remove button → delete file and clear column
                if ($service->datasheet && file_exists(public_path('uploads/service/datasheet/' . $service->datasheet))) {
                    unlink(public_path('uploads/service/datasheet/' . $service->datasheet));
                }
                $service->datasheet = null;
            }
            // else: keep_datasheet is present and no new file → do nothing, keep existing

            /* ============================================================
            | IMAGES
            | old_images[] hidden inputs = images user wants to keep
            | Images in DB but not in old_images[] = deleted by user → remove from disk
            | New uploads via service_img[] = append to kept images
            ============================================================ */

            // Images the user chose to keep (hidden inputs still in DOM)
            $keptImages = $request->old_images ?? [];

            // Images currently stored in DB
            $oldDbImages = json_decode($service->service_img, true) ?? [];

            // Delete only the images the user removed
            foreach (array_diff($oldDbImages, $keptImages) as $removed) {
                $path = public_path('uploads/service/images/' . $removed);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Upload and append new images
            $serviceImagesArray = $keptImages;
            if ($request->hasFile('service_img')) {
                foreach ($request->file('service_img') as $index => $image) {
                    $imageName = time() . '_' . $index . '_service.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/service/images'), $imageName);
                    $serviceImagesArray[] = $imageName;
                }
            }

            $service->service_img = json_encode($serviceImagesArray);

            /* ============================================================
            | FEATURES
            ============================================================ */
            $features = [];
            foreach ($request->feature_key as $key => $featureKey) {
                $features[] = [
                    'key'   => $featureKey,
                    'value' => $request->feature_value[$key] ?? null,
                ];
            }

            /* ============================================================
            | UPDATE SERVICE RECORD
            ============================================================ */
            $service->service_name      = $request->service_name;
            $service->business_type_id  = $request->business_type;
            $service->category          = $request->category;
            $service->subcategory       = $request->subcategory;
            $service->short_description = $request->short_description;
            $service->long_description  = $request->long_description;
            $service->price_type        = $request->price_type;
            $service->price             = $request->price;
            $service->service_state     = $request->state;
            $service->service_city      = $request->city;
            $service->available_days    = $request->available_days;
            $service->opening_time      = $request->opening_time;
            $service->closing_time      = $request->closing_time;
            $service->feature           = json_encode($features);
            $service->save();

            DB::commit();

            return redirect()->route('service.product.list')->with('success', 'Service Updated Successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);

            /* ---------------- DELETE DATASHEET ---------------- */
            if (
                $service->datasheet &&
                file_exists(public_path('uploads/service/datasheet/' . $service->datasheet))
            ) {
                unlink(public_path('uploads/service/datasheet/' . $service->datasheet));
            }

            /* ---------------- DELETE IMAGES ---------------- */
            $images = json_decode($service->service_img, true) ?? [];
            foreach ($images as $img) {
                $path = public_path('uploads/service/images/' . $img);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $service->delete();

            return redirect()->back()->with('success', 'Service Deleted Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show()
    {
        $vendor   = Auth::guard('vendor')->user();
        $services = Service::where('vendor_id', $vendor->id)->latest()->get();

        return view('vendor.service.products_show', compact('vendor', 'services'));
    }
}