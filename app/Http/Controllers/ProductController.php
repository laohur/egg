<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Record;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products=DB::table('products')->get();
        return view('product.index',compact('products'));
    }

    public function admin()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        $products=DB::table('products')->get();
        $user = Auth::user();
        $username = $user->name;
        return view('product.admin',compact(['products','username']));
    }

    public function search($keyword)
    {
        $products=DB::table('products')->where('product_name','like','%'.$keyword.'%')->get();
//        return view('product.index',compact('products'));
        return $products;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        $user = Auth::user();
        $username = $user->name;
        return view('product.create',compact('username'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if(!Auth::check()){
            return redirect('login');
        }
        $product = new Product();
        $product->status=$request->get('status');
        $product->min_amount=$request->get('min_amount');
        $product->shelf=$request->get('shelf');
        $product->risk=$request->get('risk');
        $product->rank=$request->get('rank');
        $product->life=$request->get('life');
        $product->product_start=$request->get('product_start');
        $product->product_end=$request->get('product_end');
        $product->min_rate=$request->get('min_rate');
        $product->area=$request->get('area');
        $product->bank=$request->get('bank');
        $product->product_name=$request->get('product_name');
        $product->introduction=$request->get('introduction');
        $product->save();
        var_dump($product->product_id);
        //新增record
        $user = Auth::user();
        $record=new Record();
        $record->admin_id=$user->id;
        $record->admin_name=$user->name;
        $record->product_id=$product->product_id;
        $record->save();

//        return redirect('product.show')->with('success', 'Information has been added');//width in session
        return view('product.show',compact(['product','record']));//product.show中显示结果
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($product_id)
    {
        $product=DB::table('products')->where('product_id',$product_id)->first();
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($product_id)
    {
        if(!Auth::check()){
            return redirect('login');
        }
        $username = Auth::user()->name;
//        print_r($user);
        $product=DB::table('products')->where('product_id',$product_id)->first();
        return view('product.edit',compact('product','username'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$product_id)
    {
        if(!Auth::check()){
            return redirect('login');
        }
        $product=DB::table('products')->where('product_id',$product_id)->first();
        $product->status=$request->get('status');
        $product->min_amount=$request->get('min_amount');
        $product->shelf=$request->get('shelf');
        $product->risk=$request->get('risk');
        $product->rank=$request->get('rank');
        $product->life=$request->get('life');
        $product->product_start=$request->get('product_start');
        $product->product_end=$request->get('product_end');
        $product->min_rate=$request->get('min_rate');
        $product->area=$request->get('area');
        $product->bank=$request->get('bank');
        $product->product_name=$request->get('product_name');
        $product->introduction=$request->get('introduction');

        //新增record
        $user = Auth::user();
        $record=new Record();
        $record->admin_id=$user->id;
        $record->admin_name=$user->name;
        $record->product_id=$product->product_id;
        $record->save();

        return view('product.show',compact(['product','record']));//product.show中显示结果
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request,$product_id)
    {
        if(!Auth::check()){
            return redirect('login');
        }
        $product=DB::table('products')->where('product_id',$product_id)->first();
        $product->delete();
        return redirect('product')->with('success','delected!');
    }
}
