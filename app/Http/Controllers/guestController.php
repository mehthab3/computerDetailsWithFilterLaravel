<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;
use DB;


class guestController extends Controller
{
    public function guestHome(){ 

    $products = products::all();
    list($brand,$processortype,$screensize) = $this->filterValues();
    $filter['values'][0]=1000; 
	    	$filter['values'][1]=200000; 
    // echo "<pre>"; print_r($screensize);exit();
        return view('guesthome',['products'=>$products,'brands'=>$brand,'processortype'=>$processortype,'screensize'=>$screensize,'filter'=>$filter]);
    }

    public function search(Request $request){
    	$products='';
    	$q = $request->input('q');
			if($q != ""){
			$products = products::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere ( 'brand', 'LIKE', '%' . $q . '%' )->paginate (3)->setPath ( '' );

			$pagination = $products->appends ( array (
			    'q' => $request->input('q')));
			 // echo "<pre>"; print_r(count($products));exit();
				 if (count ( $products ) > 0){
				  return view ('searchHome',['products'=>$products,'search'=>$q]);
				 }else{
				 	return view ('searchHome',['products'=>$products,'search'=>$q]);
				 }
				  
    		}
    		else{
    			$products = products::all()	;
    			list($brand,$processortype,$screensize) = $this->filterValues();
		        return view('guesthome',['products'=>$products,'brands'=>$brand,'processortype'=>$processortype,'screensize'=>$screensize]);
    		}

    }

    public function filterValues(){
    	$brands=DB::table('products')
            ->select('brand')
            ->groupBy('brand')
            ->get();

        $processortype=DB::table('products')
            ->select('processortype')
            ->groupBy('processortype')
            ->get();

        // $screensize=DB::table('products')
        //     ->select('screensize')
        //     ->groupBy('screensize')
        //     ->get();

       $screensize=$this->screensizeMaster();    
        // print_r($screensize);exit();
		
            return array($brands,$processortype,$screensize);
    }

    public function filterData(Request $request)
    {
	   // print_r($request->input('screensize'));exit();
	    
	    $brand = $request->input('brand');
	    $processortype = $request->input('processortype');
	    $touchscreen = $request->input('touchscreen');
	    $availability = $request->input('availability');
	    $screensize = $request->input('screensize');


	    if ($brand == "" && $processortype == "" && $touchscreen == "" && $availability == "" && $screensize == "" && $request->input('values') == "")  {

	    	$products = products::all();
	    	$filter['values'][0]=1000; 
	    	$filter['values'][1]=200000; 
	    	list($brand,$processortype,$screensize) = $this->filterValues();
		        return view('guesthome',['products'=>$products,'brands'=>$brand,'processortype'=>$processortype,'screensize'=>$screensize,'filter'=>$filter]);
	    }
	    else{

	    $query = products::query(); 

	    if (!empty($request->input('values'))) {
	    	$priceBar=$request->input('values');
	    	$priceBar=explode('-', $priceBar);
	    	$priceBar =preg_replace('/[^0-9\-]/','',$priceBar);
	    	$filterValues['values']=$priceBar;
	    	$query->whereBetween('price', $priceBar);
	    }
	    // print_r($priceBar);exit();
	    if (!empty($brand)) {
	       
	        $query->where('brand', $brand);
	        $filterValues['brand']=$brand;
	    }
	    if (!empty($processortype)) {
	        
	        $query->where('processortype', $processortype);
	        $filterValues['processortype']=$processortype;
	    }
	    if (!empty($touchscreen)) {
	       
	        $query->where('touchscreen', $touchscreen);
	        $filterValues['touchscreen']=$touchscreen;

	    }
	    if (!empty($availability)) {
	        
	        $query->where('availability', $availability);
	        $filterValues['availability']=$availability;

	    }
	    if (!empty($screensize)) {
	    	$screensizeMaster=$this->screensizeMaster();
	    	
	    	foreach ($screensizeMaster as $key => $value) {
	    		
	    		if($value['id'] == $screensize) {
	    			$id=$value['inch'];
	    			$filterValues['screensize']=$value['id'];
	        $filterValues['screensizeKey']=$key;
	    		}
	    	}
	    	$query->whereBetween('screensize', $id);
	    	// echo "<pre>"; print_r($value['id']);exit();

	    }

	    $collection = $query->get();
	    // $collection->paginate(5);

      		        // echo "<pre>"; print_r($filterValues);exit();

      	// $products = products::paginate(3);
    			list($brand,$processortype,$screensize) = $this->filterValues();
		        return view('guesthome',['products'=>$collection,'brands'=>$brand,'processortype'=>$processortype,'screensize'=>$screensize,'filter'=>$filterValues]);
    }
    }

    public function screensizeMaster()
    {
    	$screensize['14 inch - 14.9 inch']=array('id'=>1,'inch'=>array(14,14.9));
        $screensize['13 inch - 13.9 inch']=array('id'=>2,'inch'=>array(13,13.9));
        $screensize['15 inch - 15.9 inch']=array('id'=>3,'inch'=>array(15,15.9));
        $screensize['Below 12 inch']=array('id'=>4,'inch'=>array(0,12));
        $screensize['16 inch - 17.9 inch']=array('id'=>5,'inch'=>array(16,17.9));
        $screensize['12 inch - 12.9 inch']=array('id'=>6,'inch'=>array(12,12.9));
	    $screensize['Above 18 inch']=array('id'=>7,'inch'=>array(18,300));  

	    return $screensize;
    }
}
