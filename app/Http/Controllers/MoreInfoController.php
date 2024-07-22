<?php

namespace App\Http\Controllers;

use App\Models\MoreInfo;
use App\Models\Product;
use Illuminate\Http\Request;

class MoreInfoController extends Controller
{

    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('more_infos.create', compact('product'));
    }

    //storing in db
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'description' => 'nullable|string',
            'manufacturer' => 'nullable|string',
            'warranty_period' => 'nullable|string',
            'additional_features' => 'nullable|string',
        ]);

        MoreInfo::create($request->all());

        return redirect()->route('products.index')->with('success', 'More Info added successfully.');
    }

    //edit
    public function edit($id)
    {
        $moreInfo = MoreInfo::findOrFail($id);
        return view('more_infos.edit', compact('moreInfo'));
    }


    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'nullable|string',
            'manufacturer' => 'nullable|string',
            'warranty_period' => 'nullable|string',
            'additional_features' => 'nullable|string',
        ]);

        $moreInfo = MoreInfo::findOrFail($id);
        $moreInfo->update($request->all());

        return redirect()->route('products.index')->with('success', 'More Info updated successfully.');
    }


    //delete
    public function destroy($id)
    {
        $moreInfo = MoreInfo::findOrFail($id);
        $productId = $moreInfo->product_id;
        $moreInfo->delete();

        return redirect()->route('products.index')->with('success', 'More Info deleted successfully.');
    }
}
