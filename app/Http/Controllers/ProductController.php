<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image; //Intervention Image
use Illuminate\Support\Facades\Storage; //Laravel Filesystem


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = Category::all();
        return view('product.add')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $image= $request->file('images');
//        $new_name =rand(). '.' . $image->getClientOriginalExtension();
//        $image->move(public_path('image'), $new_name);
        $product = new Product();

        if ($request->hasFile('images')) {

            foreach($request->file('images') as $file){

                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $file->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename.'_'.uniqid().'.'.$extension;

                Storage::put('public/product_images/'. $filenametostore, fopen($file, 'r+'));
                Storage::put('public/product_images/thumbnail/'. $filenametostore, fopen($file, 'r+'));

                //Resize image here
                $thumbnailpath = public_path('storage/product_images/thumbnail/'.$filenametostore);
                $img = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($thumbnailpath);
                $product->multiple_images = $filenametostore;
            }
        }

        /*Insert The data*/

        $product->product_name = $request->input('product_name');
        $category= $request->input("categoryname");
        $categoryvalue = Category::where('category_name', 'LIKE', '%'. $category.'%' )->first();
        $product->category_id =$categoryvalue->id ;
        $product->save();
        return redirect('/allproducts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $products = Product::all();
        return view('product.allproducts')->with('products',$products);
        //return new ProductResource($products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product= DB::table('products')->where('id' , $id)->first();
        return view('product.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = array();
        $product['product_name']= $request->input('product_name');
        $product['category_id']= $request->input('category_id');
        DB::table('products')->where('id', $id)->update($product);
        return redirect('/allproducts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        DB::table('products')->where('id', $id)->delete();
       // Product::find($id)->delete();
        return redirect('allproducts');
    }
    public function showjson()
    {
        $products = Product::all();
        return new ProductResource($products);
    }
}
