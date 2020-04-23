<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\brands;
use App\processortypes;
	

class productsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index()
    // {
    //     return view('products');
    // }

    public function newproduct($isArray = false){

    	$brands = brands::select('name')->orderby('name', 'ASC')
                  			->get();
        if ($isArray) {
            return $this->convertIntoArray($brands);
        }

        $processortypes = processortypes::select('name')->orderby('name', 'ASC')
                  			->get();
        if ($isArray) {
            return $this->convertIntoArray($processortype);
        }

        return view('newproduct', compact('brands', 'processortypes'));
    	
    }

    public function add(Request $request){
        
        $this->validate($request,[
            'name' => 'required'
        ]);

        $newPro = new products;
        $newPro->name = $request->input('name');
        $newPro->price = $request->input('price');
        $newPro->brand = $request->input('brand');
        $newPro->processortype = $request->input('processortype');
        $newPro->screensize = $request->input('screensize');
        $newPro->touchscreen = $request->input('touchscreen');
        $newPro->availability = $request->input('availability');
        // $newPro->image = $request->input('image');
       	
       	$image = $request->file('image');
	    $extension = $image->getClientOriginalExtension();
    	Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));


		// $fpath = $request->file('image')->store('public');
		$newPro->image=$image->getFilename().'.'.$extension;
        // echo "<pre>";  print_r($newPro);exit();
        $newPro->save();
        
        return redirect('/products')->with('info','Product added successfully');
    }
    public function index(){ //make it index

    $products = products::paginate(5);
        return view('products',['products'=>$products]);
	}

	public function update($id){
        $products = products::find($id);
        return view('updateProduct',['products'=>$products]);
    }


    public function edit(Request $request,$id){
// echo "string";exit();
        $this->validate($request,[
            'name' => 'required'
        ]);
        $data = array(
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'brand' => $request->input('brand'),
            'processortype' => $request->input('processortype'),
            'screensize' => $request->input('screensize'),
            'touchscreen' => $request->input('touchscreen'),
            'availability' => $request->input('availability'),

        );

        $image = $request->file('image');
	    $extension = $image->getClientOriginalExtension();
    	Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));
		$data['image']=$image->getFilename().'.'.$extension;
	 
        products::where('id',$id)->update($data);
        
        
        return redirect('/products')->with('info','product updated successfully');

    }

    public function delete($id){
        products::where('id',$id)->delete();
        return redirect('/products')->with('info','product deleted successfully');
    }
}
