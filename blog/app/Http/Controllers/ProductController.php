<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCartItem;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('products')->get();
        return response($data);
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
        /*$data = $this->getData();
        $newData = $request->all();
        $data->push(collect($newData));
        dump($data);
        return response($data);*/
        
        $productData = $request->all();
        DB::table('products')->insert([
                                    'title'=> $productData['title'],
                                    'content'=> $productData['content'],
                                    'price'=> $productData['price'],
                                    'quantity'=> $productData['quantity'],
                                    'created_at'=>now(),
                                    'updated_at'=>now()]);
        return response(true);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = $request->all();
        $data = $this->getData();
        $selectdata = $data->where('id',$id)->first();
        $selectdata = $selectdata->merge(collect($form));
        return response($selectdata);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->getData();
        $data = $data->filter(function($product) use($id){ 
            return $product['id']!=$id;
        });
        return response($data->values());
    }

   

    public function getData()
    {
        return collect([
            collect([
                'id'=>0,
                'title'=>'測試商品一',
                'content'=>'很棒的商品',
                'price'=>'50'
            ]),
            collect([
                'id'=>1,
                'title'=>'測試商品二',
                'content'=>'不錯的商品',
                'price'=>'30'
            ]),
        ]);
    }
}
