<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Gallery;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Vendor;
use App\Models\BusinessType;
use App\Models\VendorType;
use App\Models\RealEstate;
use App\Models\Service;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Rfq;

class HomeController extends Controller
{
    public function index()
    {

        $categories = Category::where('vendor_type_id', 1)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->take(10)
            ->get();
        $categoriesproduct = Category::with(['subCategories' => function ($query) {
            $query->where('status', 1)->take(8);
        }])
            ->where('status', 1)->limit(3)
            ->get();
        $rfqs = [];

        if (auth()->check()) {
            $rfqs = Rfq::where('user_id', auth()->id())
                ->latest()
                ->take(5)
                ->get();
        }
        // 🔥 TRENDING PRODUCTS (IMPORTANT ADDITION)
        $trendingProducts = Product::where('status', 1)
            ->whereNotNull('image')
            ->inRandomOrder()
            ->take(12)
            ->get();
        $vendors = Vendor::where('status', 1)
            ->latest()
            ->take(10)
            ->get();
        $businessTypes = BusinessType::with(['categories.subCategories', 'categories.products'])
            ->where('status', 1)
            ->get();


        return view('frontend.index', compact('categories', 'categoriesproduct', 'trendingProducts', 'rfqs', 'vendors', 'businessTypes'));
    }

    public function postrfq()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $category = Category::where('status', 1)->get();

        return view('frontend.postrfq', compact('category'));
    }

    // public function products(Request $request){
    //     $products = Product::with('vendor')
    //     ->latest()
    //     ->paginate(12);
    //     return view('frontend.products', compact('products'));
    // }
    public function products(Request $request)
    {
        $query = Product::with('vendor')->where('status', 1)->latest();

        // Product Search
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        // Supplier City Filter
        if ($request->filled('city')) {
            $query->whereHas('vendor', function ($q) use ($request) {
                $q->whereIn('city', $request->city);
            });
        }

        $products = $query->latest()
            ->paginate(12)
            ->withQueryString();

        // Cities List
        $cities = \App\Models\Vendor::select('city')
            ->whereNotNull('city')
            ->distinct()
            ->pluck('city');

        return view('frontend.products', compact(
            'products',
            'cities'
        ));
    }

    public function categoryproducts($id)
    {
        $category = Category::with('subcategories')
            ->findOrFail($id);

        return view('frontend.category_products', compact('category'));
    }

    public function subcategoryproducts($id)
    {
        $subcategory = SubCategory::findOrFail($id);

        // Get category using category_id from subcategory
        $category = Category::find($subcategory->category_id);

        // Get products
        $products = Product::where('sub_category_id', $id)->paginate(12);

        return view('frontend.subcategory_products', compact(
            'subcategory',
            'category',
            'products'
        ));
    }

    public function productdetails($id)
    {
        $product = Product::where('status', 1)->findOrFail($id);

        $category = Category::find($product->category_id);

        $subcategory = SubCategory::find($product->sub_category_id);

        $vendor = Vendor::find($product->vendor_id);

        $productImages = json_decode($product->image, true);

        $keyValues = json_decode($product->key_value, true);

        $specifications = json_decode($product->specification, true);

        $datasheets = json_decode($product->data_sheet, true);

        return view(
            'frontend.productdetails',
            compact(
                'product',
                'category',
                'subcategory',
                'vendor',
                'productImages',
                'keyValues',
                'specifications',
                'datasheets'
            )
        );
    }

    public function vendorDetails($id)
    {
        $vendor = Vendor::with([
            'businessType',
            'vendorType',
            'category',
            'subCategory'
        ])->findOrFail($id);

        // Get all products of this vendor
        $products = Product::where('vendor_id', $vendor->id)
            ->latest()
            ->get();
        $services = Service::where('vendor_id', $vendor->id)->where('status', 1)
            ->latest()
            ->get();
        $properties = RealEstate::where('vendor_id', $vendor->id)->where('status', 1)->latest()
            ->get();

        return view('frontend.vendor_detail', compact('vendor', 'products', 'services', 'properties'));
    }



    // public function servicelist()
    // {
    //     // Latest 5 Real Estate
    //     $latestRealEstates = RealEstate::where('status', 1)
    //         ->latest()
    //         ->take(5)
    //         ->get();

    //     // All Services
    //     $services = Service::where('status', 1)
    //         ->latest()
    //         ->paginate(9);

    //     return view('frontend.service_list', compact(
    //         'latestRealEstates',
    //         'services'
    //     ));
    // }
    public function servicelist(Request $request)
    {
        $services = Service::where('status', 1);

        if ($request->filled('search')) {
            $services->where('service_name', 'like', '%' . $request->search . '%');
        }

        $services = $services->latest()->paginate(12);

        $latestRealEstates = RealEstate::where('status', 1)
            ->latest()
            ->take(5)
            ->get();

        return view(
            'frontend.service_list',
            compact('services', 'latestRealEstates')
        );
    }

    public function rfqlist(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to view your RFQs');
        }

        $rfqs = Rfq::with(['categorydetails', 'subCategory'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(12);
        return view('frontend.rfq_list', compact('rfqs'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function upvcWindow()
    {
        return view('frontend.upvc-windows');
    }

    public function aluminiumWindow()
    {
        return view('frontend.aluminium-window');
    }

    public function upvcDoor()
    {
        return view('frontend.upvc-doors');
    }

    public function aluminiumDoor()
    {
        return view('frontend.aluminium-door');
    }

    public function gallery()
    {
        $galleries = Gallery::with('details')->where('status', 1)->get();
        return view('frontend.gallery-list', compact('galleries'));
    }

    public function galleryList($slug)
    {
        $gallery = Gallery::with('details')->where('slug', $slug)->where('status', 1)->first();
        return view('frontend.gallery', compact('gallery'));
    }

    public function blog()
    {
        $blogs = Blog::where('status', 1)->get();
        return view('frontend.blog', compact('blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $latest_blogs = Blog::where('status', 1)->whereNotIn('id', [$blog->id])->latest()->limit(6)->get();
        $tags = Blog::where('status', 1)->inRandomOrder()->limit(3)->get();
        return view('frontend.blog-detail', compact('blog', 'latest_blogs', 'tags'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactStore(Request $r)
    {
        $r->validate([
            'fname'   => 'required|string|max:100',
            'lname'   => 'required|string|max:100',
            'phone'   => 'required|digits_between:10,15',
            'email'   => 'required|email|max:150',
            'message' => 'nullable|string|max:500',
        ]);

        // Store Data
        $contact = Contact::create([
            'fname'   => $r->fname,
            'lname'   => $r->lname,
            'phone'   => $r->phone,
            'email'   => $r->email,
            'message' => $r->message,
        ]);

        try {
            Mail::send('emails.contact', ['contact' => $contact], function ($message) use ($contact) {
                $message->to('sureshkumar@sherenewindows.com')
                    ->replyTo($contact->email, $contact->fname)
                    ->subject('New Contact Form Submission');
            });
        } catch (Exception $e) {
            Log::info('Mail send Failed :' . $e->getMessage());
        }

        // Redirect with success message
        return redirect()->back()->with('success', 'Message submitted successfully!');
    }
    public function EnquiryPage($id)
    {
        $product = Product::findOrFail($id);

        return view('frontend.message', compact('product'));
    }
    public function ServiceEnquiryPage($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $service = Service::findOrFail($id);

        return view('frontend.servicemessage', compact('service'));
    }

    public function EnquirySubmit(Request $request)
    {
        $request->validate([

            'product_id' => 'required',
            'message'    => 'required',
            'quantity'   => 'nullable',
            'unit'       => 'nullable'

        ]);

        $product = Product::findOrFail($request->product_id);

        Enquiry::create([

            'product_id' => $product->id,

            // Logged user
            'sender_id' => Auth::id() ?? "0",

            // Product Owner
            'receiver_id' => $product->vendor_id,

            'enquiry_id' => 'ENQ-' . strtoupper(Str::random(8)),

            'quantity' => $request->quantity,

            'unit' => $request->unit,

            'message' => $request->message,

            'is_read' => 0

        ]);

        return redirect()
            ->back()
            ->with('success', 'Enquiry Sent Successfully');
    }
    public function ServiceEnquirySubmit(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'message'    => 'required'
        ]);

        $service = Service::findOrFail($request->service_id);

        Enquiry::create([

            'service_id' => $service->id,

            // Logged User
            'sender_id' => Auth::id() ?? 0,

            // Service Owner
            'receiver_id' => $service->vendor_id,

            'enquiry_id' => 'ENQ-' . strtoupper(Str::random(8)),

            'quantity' => null,

            'unit' => null,

            'message' => $request->message,

            'is_read' => 0

        ]);

        return back()->with(
            'success',
            'Service Enquiry Sent Successfully'
        );
    }

    public function serviceDetails($id)
    {
        $service = Service::with([
            'businessType',
            'categoryData',
            'subCategoryData'
        ])->findOrFail($id);

        $vendor = Vendor::find($service->vendor_id);

        $features = json_decode($service->feature, true) ?? [];

        $datasheets = json_decode($service->datasheet, true) ?? [];
        $serviceImages = json_decode($service->service_img, true) ?? [];

        if (!is_array($datasheets)) {
            $datasheets = [$service->datasheet];
        }

        if (!is_array($serviceImages)) {
            $serviceImages = [$service->service_img];
        }

        return view('frontend.service-details', compact(
            'service',
            'vendor',
            'features',
            'datasheets',
            'serviceImages'
        ));
    }
    public function getSubCategories(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)
            ->where('status', 1)
            ->select('id', 'sub_category_name')
            ->get();

        return response()->json($subcategories);
    }


    // public function Supplierlist()
    // {
    //     // $vendors = Vendor::where('status',1)->get();
    //     // $vendors = Vendor::with(['products' => function ($query) {
    //     //     $query->where('status', 1)->latest();
    //     //     }])
    //     //     ->where('status', 1)
    //     //     ->get();

    //     $vendors = Vendor::where('status', 1)
    //         ->whereHas('products', function ($query) {
    //             $query->where('status', 1);
    //         })
    //         ->with([
    //             'products' => function ($query) {
    //                 $query->where('status', 1)->latest();
    //             }
    //         ])
    //         ->get();

    //     return view('frontend.supplier-list',compact('vendors'));
    // }
    public function Supplierlist(Request $request)
    {
        $cities = Vendor::where('status', 1)
            ->whereNotNull('city')
            ->distinct()
            ->pluck('city');

        $vendors = Vendor::where('status', 1)
            ->whereHas('products', function ($q) {
                $q->where('status', 1);
            });

        // Supplier Name Filter
        if ($request->filled('supplier_name')) {
            $vendors->where('company_name', 'like', '%' . $request->supplier_name . '%');
        }

        // City Filter
        if ($request->filled('city')) {
            $vendors->whereIn('city', $request->city);
        }

        $vendors = $vendors->with([
            'products' => function ($q) {
                $q->where('status', 1)->latest();
            }
        ])->get();

        return view('frontend.supplier-list', compact('vendors', 'cities'));
    }

    public function Supplierproducts()
    {
        return view('frontend.supplier-products');
    }


    public function categoryproductlist($id)
    {
        $category = Category::with('subcategories')->findOrFail($id);

        $categories = Category::where('status', 1)->get();

        $products = Product::with(['vendor'])
            ->where('status', 1)
            ->where(function ($q) use ($id) {
                $q->where('category_id', $id)
                    ->orWhereIn('sub_category_id', function ($sub) use ($id) {
                        $sub->select('id')
                            ->from('sub_categories')
                            ->where('category_id', $id);
                    });
            })
            ->latest()
            ->get();

        return view(
            'frontend.cat-products',
            compact('category', 'categories', 'products')
        );
    }
    public function bussinessproductlist($id)
    {
        $bussiness = BusinessType::findOrFail($id);
        $categories = Category::with('subcategories')
            ->where('business_type_id', $id)
            ->where('status', 1)
            ->get();

        $products = Product::with(['vendor', 'categoryData', 'subCategoryData'])
            ->where('status', 1)
            ->whereHas('categoryData', function ($q) use ($id) {
                $q->where('business_type_id', $id);
            })
            ->latest()
            ->get();

        return view(
            'frontend.bussiness-products',
            compact('categories', 'products', 'bussiness')
        );
    }
    public function show($id)
    {
        // 1. Fetch the single property asset or return a 404 error if missing
        $property = RealEstate::findOrFail($id);

        // 2. Fetch the associated vendor (Fallback to logged-in user if it's an internal portal)
        $vendor = $property->vendor ?? Auth::guard('vendor')->user();

        // 3. Eagerly parse classification definitions safely
        $vendorType = $vendor ? VendorType::find($vendor->vendor_type_id) : null;
        $business = $vendor ? BusinessType::find($vendor->business_id) : null;

        return view('frontend.properties-details', compact('property', 'vendor', 'vendorType', 'business'));
    }
}
