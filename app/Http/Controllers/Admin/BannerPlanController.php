<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerPlan;
use Yajra\DataTables\Facades\DataTables;

class BannerPlanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = BannerPlan::latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('price', function ($row) {
                    return '₹ ' . number_format($row->price, 2);
                })

                ->addColumn('duration', function ($row) {
                    return $row->duration . ' Days';
                })

                ->addColumn('status', function ($row) {
                    return $row->status
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', function ($row) {
                    return '
                    <a href="' . route('admin.bannerplans.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger delete" data-route="' . route('admin.bannerplans.destroy', $row->id) . '">Delete</button>
                ';
                })

                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.banner_plans.index');
    }


    // CREATE PAGE
    public function create()
    {
        return view('admin.banner_plans.create');
    }


    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'plan_name' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'max_banners' => 'required|integer',
        ]);

        BannerPlan::create([
            'plan_name'    => $request->plan_name,
            'price'        => $request->price,
            'duration'     => $request->duration,
            'max_banners'  => $request->max_banners,
            'description'  => $request->description,
            'status'       => $request->status ?? 1,
        ]);

        return redirect()->route('admin.bannerplans.index')
            ->with('success', 'Banner Plan Added Successfully');
    }


    // EDIT
    public function edit($id)
    {
        $data = BannerPlan::findOrFail($id);

        return view('admin.banner_plans.edit', compact('data'));
    }


    // UPDATE
    public function update(Request $request, $id)
    {
        $data = BannerPlan::findOrFail($id);

        $request->validate([
            'plan_name' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'max_banners' => 'required|integer',
        ]);

        $data->update([
            'plan_name'    => $request->plan_name,
            'price'        => $request->price,
            'duration'     => $request->duration,
            'max_banners'  => $request->max_banners,
            'description'  => $request->description,
            'status'       => $request->status,
        ]);

        return redirect()->route('admin.bannerplans.index')
            ->with('success', 'Banner Plan Updated Successfully');
    }


    // DELETE
    public function destroy($id)
    {
        BannerPlan::findOrFail($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully'
        ]);
    }
}
