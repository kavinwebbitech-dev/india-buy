<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    private $path = 'uploads/blog_images/';

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = Blog::latest();

            return DataTables::of($query)
                ->addIndexColumn()

                ->filter(function ($query) {
                    if (request()->has('search') && $search = request('search')['value']) {
                        $query->where(function ($q) use ($search) {
                            $q->where('category', 'like', "%{$search}%")
                            ->orWhere('title', 'like', "%{$search}%")
                            ->orWhere('status', 'like', "%{$search}%")
                            ->orWhere('created_at', 'like', "%{$search}%");
                        });
                    }
                })

                ->editColumn('thumbnail', function ($row) {
                    if (!$row->thumbnail) {
                        return '-';
                    }

                    $url = asset($row->thumbnail);

                    return '<img src="'.$url.'" 
                            style="width:50px;height:50px;object-fit:cover;border-radius:6px;border:1px solid #ddd;">';
                })
                ->editColumn('banner_image', function ($row) {
                    if (!$row->banner_image) {
                        return '-';
                    }

                    $url = asset($row->banner_image);

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
                            <a href="'.route('admin.blogs.edit', $row->id).'" 
                            class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button data-id="'.$row->id.'"
                                data-route="'.route('admin.blogs.destroy', $row->id).'" 
                                class="btn btn-sm btn-danger delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    ';
                })

                ->rawColumns(['thumbnail','status','action'])
                ->make(true);
        }
        return view('admin.blogs.index');
    }
    public function create()
    {
        return view('admin.blogs.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'date'         => 'required|date',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'blog_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'page_content' => 'required|string',
            'status'       => 'required|in:0,1',
        ]);

        if (trim(strip_tags($request->page_content)) == '') {
            return back()->withErrors(['page_content' => 'Content is required'])->withInput();
        }

        $slug = Str::slug($request->category ?? $request->title);

        $originalSlug = $slug;
        $count = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $data = $request->only(['category', 'title', 'date', 'page_content', 'status']);
        $data['slug'] = $slug;

        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'));
        }

        // Upload Blog Image
        if ($request->hasFile('blog_image')) {
            $data['blog_image'] = $this->uploadImage($request->file('blog_image'));
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully!');
    }

    // EDIT
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'date'         => 'required|date',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'blog_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'page_content' => 'required|string',
            'status'       => 'required|in:0,1',
        ]);

        if (trim(strip_tags($request->page_content)) == '') {
            return back()->withErrors(['page_content' => 'Content is required'])->withInput();
        }

        $slug = Str::slug($request->category ?? $request->title);

        $originalSlug = $slug;
        $count = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $data = $request->only(['category', 'title', 'date', 'page_content', 'status']);
        $data['slug'] = $slug;
        // Thumbnail Update
        if ($request->hasFile('thumbnail')) {
            $this->deleteImage($blog->thumbnail);
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'));
        }

        // Blog Image Update
        if ($request->hasFile('blog_image')) {
            $this->deleteImage($blog->blog_image);
            $data['blog_image'] = $this->uploadImage($request->file('blog_image'));
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully!');
    }

    // DELETE
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        $this->deleteImage($blog->thumbnail);
        $this->deleteImage($blog->banner_image);
        $this->deleteImage($blog->blog_image);

        $blog->delete();

        return response()->json([
            'status' => true,
            'message' => 'Blog deleted successfully'
        ]);
    }

    private function uploadImage($file)
    {
        $folderPath = public_path($this->path);

        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move($folderPath, $fileName);

        return $this->path . $fileName;
    }

    // IMAGE DELETE FUNCTION
    private function deleteImage($image)
    {
        if ($image && File::exists(public_path($image))) {
            File::delete(public_path($image));
        }
    }
}
