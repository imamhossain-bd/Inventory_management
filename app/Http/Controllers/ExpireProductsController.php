<?php

namespace App\Http\Controllers;

use App\Models\ExpireProduct;
use Illuminate\Http\Request;

class ExpireProductsController extends Controller
{

    public function index()
    {
        $expireProducts = ExpireProduct::latest()->paginate(10);
        return view('backend.expire-products.index', compact('expireProducts'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $expire = ExpireProduct::findOrFail($id);
        return view('backend.expire-products.show', compact('expire'));
    }


    public function edit(ExpireProduct $expireProducts)
    {
        //
    }


    public function update(Request $request, ExpireProduct $expireProducts)
    {
        //
    }


    public function destroy(ExpireProduct $expireProducts)
    {
        $expireProducts->delete();
        return redirect()->route('backend.expire-products.index')->with('success', 'Expired product deleted successfully.');
    }
}
