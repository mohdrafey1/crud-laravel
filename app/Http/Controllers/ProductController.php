<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    // Product page
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editButton = '';
                    $deleteButton = '';
                    $moreInfoButton = '';

                    if (Auth::user()->can('edit products')) {
                        $editButton = '<a href="' . route('products.edit', $row->id) . '" class="edit btn btn-warning btn-sm">Edit</a>';
                    }

                    if (Auth::user()->can('delete products')) {
                        $deleteButton = '<a href="#" data-product-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                        $deleteButton .= '<form id="delete-product-form-' . $row->id . '" action="' . route('products.destroy', $row->id) . '" method="post" style="display: none;">' . csrf_field() . method_field('delete') . '</form>';
                    }

                    if (Auth::user()->can('view products')) {
                        if ($row->moreInfo) {
                            $moreInfoButton = '<a href="' . route('more_infos.edit', $row->moreInfo->id) . '" class="edit btn btn-warning btn-sm">More Info</a>';
                        } else {
                            $moreInfoButton = '<a href="' . route('more_infos.create', ['product' => $row->id]) . '" class="edit btn btn-success btn-sm">Add More Info</a>';
                        }
                    }

                    return $editButton . ' ' . $deleteButton . ' ' . $moreInfoButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('products.list');
    }

    //create
    public function create()
    {
        return view('products.create');
    }

    //store product
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }



        //here insertion of product in db
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;


            //save img to product dir
            $image->move(public_path('uploads/products'), $imageName);

            $product->image = $imageName;
            $product->save();
        }
        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    //edit 
    public function edit($id)
    {
        $product = Product::findOrfail($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }

    //update 
    public function update($id, Request $request)
    {
        $product = Product::findOrfail($id);
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }



        //here update of product in db
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            //delete old image 
            File::delete(public_path('uploads/products/' . $product->image));

            //store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;


            //save img to product dir
            $image->move(public_path('uploads/products'), $imageName);
            //dave img in db
            $product->image = $imageName;
            $product->save();
        }
        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    //delete
    public function destroy($id)
    {
        $product = Product::findOrfail($id);

        //delete img
        File::delete(public_path('uploads/products/' . $product->image));

        //delete product from db
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }
}
