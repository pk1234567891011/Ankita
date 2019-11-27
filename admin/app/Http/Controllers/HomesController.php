<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Product;
use App\Product_categories;
use App\Product_images;
use App\Users;
use App\Product_attributes_assoc;
use App\Product_attributes;
use App\Product_attribute_values;
use Auth;
use Illuminate\Http\Request;

class HomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $category = Category::with('children')->get();
        $sliders = Banner::orderby('id', 'desc')->paginate(10);
        $images = Product_images::where('status', 'active')->get();
        $productsAll = Product::has('imgs')->get();
        return view('Eshopper.first', compact('sliders', 'category', 'images', 'productsAll'));

    }
    /*public function products($name = null)
    {
    $categoryDetails = Category::where(['name' => name])->first();
    $productsAll = Product::has('imgs')->get();

    return view('Eshopper.listing', compact('$categoryDetails'));
    }*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            /*$request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',

            ]);*/
            $data = $request->all();
            $usersCount = Users::where('email', $data['email'])->count();
            if ($usersCount > 0) {
                return redirect()->back()->with('flash_message_error', 'Email already exists');
            } else { $user = new Users();
                $user->firstname = $request->name;
                $user->email = $request->email;
                $user->password = $request->password;
                $user->role_id = 5;
                $user->save();
                return redirect('login-register')->with('success', 'Registration successful');
            }
        }

        return view('Eshopper.login-register');
    }
    public function checklogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:3',
        ]);

        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        );

        if (Auth::attempt($user_data)) {
            return redirect('homes');
        } else {
            return back()->with('error', 'Wrong Login Details');
        }

    }

    public function successlogin()
    {
        return redirect('homes');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login-register');
    }
    public function products($url = null)
    {   $categoryDetails = Category::where(['name' => $url])->first();
        $categoryCount = Category::where(['name' => $url])->count();
        if($categoryCount==0)
        {
            abort(404);
        }
        
        $productCat = Product_categories::where(['category_id' => $categoryDetails->id])->first();
        
        if ($categoryDetails->parent_id == 0) {
            $subCategories = Category::where(['parent_id' => $categoryDetails->id])->get();
            $cat_ids = "";
            foreach ($subCategories as $subCat) {
                $cat_ids .= $subCat->id . ",";
            }
            
            $category = Category::with('children')
            ->whereIn('id' ,array($cat_ids))->get();
            $category=json_decode(json_encode($category));
            $product = Product::whereIn('id' ,array($cat_ids))->get();
            
            $category = Category::with('children')->get();
            $sliders = Banner::orderby('id', 'desc')->paginate(10);
            $images = Product_images::where('status', 'active')->get();
            $productsAll = Product::has('imgs')
                ->get();
            $image = Product_images::whereIn('product_id', $product->pluck('id'))->get();
           /* $product=json_decode(json_encode($product));
            echo "<pre>" ; print_r($product);
            die;*/
        }
         else {

        $product = Product::where(['id' => $productCat->product_id])->get();
        $category = Category::with('children')->get();
        $sliders = Banner::orderby('id', 'desc')->paginate(10);
        $images = Product_images::where('status', 'active')->get();
        $productsAll = Product::has('imgs')
            ->get();
        $image = Product_images::whereIn('product_id', $product->pluck('id'))->get();

          }
        return view('Eshopper.listing', compact('productsAll', 'product', 'image', 'sliders', 'category'));
         }
     
       
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function prod($id = null){
        $productDetails=Product::where('id',$id)->first();
        //$product = Product::where(['id' => $productCat->product_id])->get();
        $category = Category::with('children')->get();
        $sliders = Banner::orderby('id', 'desc')->paginate(10);
        //$images = Product_images::where('status', 'active')->get();
       $product_attributes_asso=Product_attributes_assoc::where('product_id',$productDetails->id)->first();
       $product_attributes=Product_attributes::where('id',$product_attributes_asso->product_attribute_id)->first();
       $product_attribute_value=Product_attribute_values::where('product_attribute_id',$product_attributes->id)->first();
      
        $productsAll = Product::has('imgs')
            ->get();
            $product_image=Product_images::where('product_id',$productDetails->id)->first();
          
      //$image = Product_images::where('image_name', $product_image->pluck('image_name'))->get();

        return view('Eshopper.details')->with(compact('category','productDetails','product_image','product_attributes','product_attribute_value'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
