<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Langauge;
use App\Models\User;
use App\Models\Category;

use App\Http\Requests\Site\ExpertsDataRequest;


class HomeController extends Controller
{
    public function index(){
        // $data['datas'] =  Data::with(['activity' => function($act) {
        //     $act -> with('criteria');
        // },'mission' => function($mis) {
        //     $mis -> with('rule');
        // }]) -> active() -> orderBy('id','DESC') -> paginate(PAGINATION_COUNT);

        // $data['main_criteria'] = Main_criteria::active()->orderBy('id','DESC') -> get();
        // $data['rules'] = Role::active()->orderBy('id','DESC') -> get();
        // return $datas;

        return view('site.home.data-step-one');
    }

    public function createStepOne(Request $request) {
        $data = [];
        $data['nationalities'] = Country::select('id','nationality')->get();
        $data['langauges'] = Langauge::select('id','name')->get();

        // $data['tags'] = Tag::active()->select('id')->get();
        // $data['categories'] = Category::active()->select('id')->get();
        $user = $request->session()->get('user');
        return view('site.home.data-step-one',$data,compact('user'));
    }

    public function storeStepOne(ExpertsDataRequest $request) {

        if(empty($request->session()->get('user'))){
            $user = new User();
            $user -> fill($request->toArray());
            $request->session()->put('user', $user);
        }else{
            $user = $request->session()->get('user');
            $user->fill($request->toArray());
            $request->session()->put('user', $user);
        }

        return redirect()->route('create.data.step.two');
    }

    public function createStepTwo(Request $request)
    {
        $data = [];
        $data['countries'] = Country::select('id','name')->get();
        $data['categories'] = Category::select('id','name') -> where('parent_id',NULL)->get();
        $user = $request->session()->get('user');
        return view('site.home.data-step-two',$data,compact('user'));
    }

    public function storeStepTwo(ProductPriceRequest $request)
    {
        if (!$request->has('flash_deals')){
            $request->request->add(['flash_deals' => 0]);
        }
        else{
            $request->request->add(['flash_deals' => 1]);
        }

        $product = $request->session()->get('product');
        $product->fill($request->toArray());
        $request->session()->put('product', $product);

        return redirect()->route('admin.create.product.step.three');
    }

    public function createStepThree(Request $request)
    {
        $product = $request->session()->get('product');
        return view('admin.products.create-step-three',compact('product'));
    }

    public function storeStepThree(ProductStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $product = $request->session()->get('product');
            $product->fill($request->toArray());

            $request->session()->put('product', $product);
            $productt = Product::create([
                'slug' => $product->slug,
                'brand_id' => $product->brand_id,
                'is_active' => $product->is_active,
                'price' => $product->price,
                'special_price' => $product->special_price,
                'special_price_type' => $product->special_price_type,
                'special_price_start' => $product->special_price_start,
                'special_price_end' => $product->special_price_end,
                'sku' => $product->sku,
                'in_stock' => $product->in_stock,
                'trending' => $product->trending,
                'flash_deals' => $product->flash_deals,
                'manage_stock' => $product->manage_stock,
                'qty' => $product->qty,
            ]);

            //save translations
            $productt->name = $product->name;
            $productt->description = $product->description;
            $productt->short_description = $product->short_description;

            //save product categories
            $productt->categories()->attach($product->categories);

            //save product tags
            $productt->tags()->attach($product->tags);

            $productt->save();

            $request->session()->forget('product');

            DB::commit();
            return redirect()->route('admin.products')->with(['success' => __('admin/product.added successfully')]);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.products')->with(['error' => __('admin/product.something went wrong')]);
        }
    }

    public function getSubCats(Request $request) {
        $data['categories'] = Category::select('id','name') -> where('parent_id',$request ->main_cat)->get();
        return response()->json($data);
    }


}
