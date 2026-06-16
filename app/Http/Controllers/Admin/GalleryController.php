<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class GalleryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = Gallery::latest();

            return DataTables::of($query)
                ->addIndexColumn()

                ->filter(function ($query) {
                    if (request()->has('search') && $search = request('search')['value']) {
                        $query->where(function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                            ->orWhere('title', 'like', "%{$search}%")
                            ->orWhere('category', 'like', "%{$search}%")
                            ->orWhere('created_at', 'like', "%{$search}%");
                        });
                    }
                })

                ->editColumn('thumbnail', function ($row) {
                    if (!$row->thumbnail) {
                        return '-';
                    }

                    $url = asset('uploads/gallery_image/'.$row->thumbnail);

                    return '<img src="'.$url.'" 
                            style="width:50px;height:50px;object-fit:cover;border-radius:6px;border:1px solid #ddd;">';
                })

                ->editColumn('status', function ($row) {
                    return $row->status
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', function ($row) {
                    return '
                        <div class="d-flex gap-1">
                            <a href="'.route('admin.galleries.edit', $row->id).'" 
                            class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button data-id="'.$row->id.'"
                                data-route="'.route('admin.galleries.destroy', $row->id).'" 
                                class="btn btn-sm btn-danger delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    ';
                })

                ->rawColumns(['thumbnail','status','action'])
                ->make(true);
        }
        return view('admin.gallery.index');
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            // 'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'image_names.*' => 'nullable|string|max:255',
        ]);

        // Upload Thumbnail
        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailName = time().'_thumb.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery_image'), $thumbnailName);
        }

        // Upload Banner Image
        // $bannerName = null;
        // if ($request->hasFile('banner_image')) {
        //     $file = $request->file('banner_image');
        //     $bannerName = time().'_banner.'.$file->getClientOriginalExtension();
        //     $file->move(public_path('uploads/gallery_image'), $bannerName);
        // }
        $slug = Str::slug($request->name ?? $request->title);

        $originalSlug = $slug;
        $count = 1;

        while (Gallery::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $gallery = Gallery::create([
            'name' => $request->name,
            'title' => $request->title,
            'category' => $request->category,
            'thumbnail' => $thumbnailName,
            'slug' => $slug,
            'status' => 1,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($image) {
                    $imageName = time().'_'.$index.'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('uploads/gallery_image'), $imageName);

                    GalleryDetail::create([
                        'gallery_id' => $gallery->id,
                        'name' => $request->image_names[$index] ?? null,
                        'image' => $imageName,
                        'status' => 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery Created Successfully');
    }

    public function edit($id)
    {
        $gallery = Gallery::with('details')->findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'name' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            // 'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'image_names.*' => 'nullable|string|max:255',
        ]);

        // Update Thumbnail
        if ($request->hasFile('thumbnail')) {
            if ($gallery->thumbnail && File::exists(public_path('uploads/gallery_image/'.$gallery->thumbnail))) {
                File::delete(public_path('uploads/gallery_image/'.$gallery->thumbnail));
            }

            $file = $request->file('thumbnail');
            $thumbnailName = time().'_thumb.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery_image'), $thumbnailName);
            $gallery->thumbnail = $thumbnailName;
        }

        // Update Banner
        if ($request->hasFile('banner_image')) {
            if ($gallery->banner_image && File::exists(public_path('uploads/gallery_image/'.$gallery->banner_image))) {
                File::delete(public_path('uploads/gallery_image/'.$gallery->banner_image));
            }

            $file = $request->file('banner_image');
            $bannerName = time().'_banner.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery_image'), $bannerName);
            $gallery->banner_image = $bannerName;
        }

        $slug = Str::slug($request->name ?? $request->title);

        $originalSlug = $slug;
        $count = 1;

        while (Gallery::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        // Update basic fields
        $gallery->update([
            'name' => $request->name,
            'title' => $request->title,
            'slug'  => $slug,
            'category' => $request->category,
        ]);

        // Add New Multiple Images (Append new rows)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($image) {
                    $imageName = time().'_'.$index.'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('uploads/gallery_image'), $imageName);

                    GalleryDetail::create([
                        'gallery_id' => $gallery->id,
                        'name' => $request->image_names[$index] ?? null,
                        'image' => $imageName,
                        'status' => 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery Updated Successfully');
    }

    public function destroy($id)
    {
        $gallery = Gallery::with('details')->findOrFail($id);

        if ($gallery->thumbnail && File::exists(public_path($gallery->thumbnail))) {
            File::delete(public_path('uploads/gallery_image/'.$gallery->thumbnail));
        }

        if ($gallery->banner_image && File::exists(public_path($gallery->banner_image))) {
            File::delete(public_path('uploads/gallery_image/'.$gallery->banner_image));
        }

        foreach ($gallery->details as $detail) {
            if ($detail->image && File::exists(public_path($detail->image))) {
                File::delete(public_path($detail->image));
            }
        }

        $gallery->delete();

        return response()->json([
            'status' => true,
            'message' => 'Gallery deleted successfully'
        ]);
    }

    public function deleteDetail($id)
    {
        $detail = GalleryDetail::findOrFail($id);

        if ($detail->image && File::exists(public_path($detail->image))) {
            File::delete(public_path('uploads/gallery_image/'.$detail->image));
        }

        $detail->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
