<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Produk';
        $subtitle = 'Index';
        $produks = Produk::all();
        return view('admin.produk.index',compact('title','subtitle','produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Produk';
        $subtitle = 'Create';
        $produks = Produk::all();
        return view('admin.produk.create', compact('title','subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'NamaProduk' => 'required|string|max:255',
            'Harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0'
        ]);
       $simpan = Produk::create($validateData);
       if ($simpan) {
        return response()->json(['status'=>200,'message'=>'Produk Berhasil']);
       }else{
        return response()->json(['status'=>500,'message'=>'Produk Gagal']);
       }
        // return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Produk';
        $subtitle = 'Edit';
        $Produk = Produk::find($id);

        return view('admin.produk.edit',compact('title','subtitle','Produk'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $validateData = $request->validate([
            'NamaProduk' => 'required',
            'Harga' => 'required|numeric',
            'Stok' => 'required|numeric'
        ]);

        $simpan = $produk->update($validateData);
        if ($simpan){
            return response()->json(['status' => 200, 'message' =>'Produk Berhasil Diubah']);
        } else {
            return response()->json(['status' => 200, 'message' =>'Produk Gagal']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
