<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserProductController extends Controller
{
    //  Function to view Product List
public function viewProductList(Request $request)
{
    // Forgot session
    Session::forget('menu');
    // Store Session for Home Menu Active
    Session::put('menu', 'product');
    
    $categories = Category::where('type', 'product')->where('is_active', 1)->get();
    
    if ($request->has('search')) {
        $search = $request->search;
        
        $products = Product::with(['category', 'seo', 'company'])
            ->whereHas('company', function($q) {
                $q->where('is_approved', 1)->where('is_active', 1);
            })
            ->whereHas('seo', function($q) use ($search) {
                $q->whereRaw('JSON_UNQUOTE(JSON_EXTRACT(meta_keywords, "$[*]")) LIKE ?', ['%'.$search.'%']);
            })
            ->where('is_approved', 1)
            ->where('is_active', 1)
            ->paginate(10);
        
        // Get Related SEO Keywords
        $seo = [];
        foreach ($products as $product) {
            if ($product->seo && $product->seo->meta_keywords) {
                $keywords = $product->seo->meta_keywords;
                
                // Handle both JSON string and array formats
                if (is_string($keywords)) {
                    $keywords = json_decode($keywords, true);
                }
                
                if (is_array($keywords)) {
                    foreach ($keywords as $keyword) {
                        $seo[] = $keyword;
                    }
                }
            }
        }
        
        // Get Up to 6 Related SEO Keywords
        $seo = array_unique($seo);
        $seo = array_slice($seo, 0, 6);
        
        $data = compact('products', 'seo', 'categories');
        return view('pages.product.list')->with($data);
    }
    
    $query = Product::where('is_approved', 1)->where('is_active', 1);
    
    if ($request->has('category')) {
        // Get Category ID from Category Name
        $cat_id = Category::where('name', $request->category)->first();
        if ($cat_id) {
            $query->where('category_id', $cat_id->id);
        }
    }
    
    if ($request->has('sort')) {
        if ($request->sort == 'name') {
            $query->orderBy('name', 'asc');
        } elseif ($request->sort == 'price-low-to-high') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price-high-to-low') {
            $query->orderBy('price', 'desc');
        }
    }
    
    $products = $query->with(['category', 'seo'])->paginate(12);
    
    // Get Random Products for SEO
    $seoProducts = Product::where('is_approved', 1)
        ->with('seo')
        ->inRandomOrder()
        ->limit(6)
        ->get();
    
    $seo = [];
    foreach ($seoProducts as $product) {
        if ($product->seo && $product->seo->meta_keywords) {
            $keywords = $product->seo->meta_keywords;
            
            // Handle both JSON string and array formats
            if (is_string($keywords)) {
                $keywords = json_decode($keywords, true);
            }
            
            if (is_array($keywords)) {
                foreach ($keywords as $keyword) {
                    $seo[] = $keyword;
                }
            }
        }
    }
    $seo = array_unique($seo);
    $seo = array_slice($seo, 0, 6);
    
    $data = compact('products', 'categories', 'seo');
    return view('pages.product.list')->with($data);
}

    // Function to view Product Details
    public function viewProductDetails($slug)
    {
        // Forgot session
        Session::forget('menu');

        $product = Product::where('slug', $slug)->firstOrFail();
        //  check if product has a company
        if ($product->company == null) {
            // Store Session for Home Menu Active
            Session::put('menu', 'product');
            return redirect()->back();
        }
        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->where('is_approved', 1)->where('is_active', 1)->get();
        // Get only products which have a company
        $related_products = $related_products->filter(function ($value, $key) {
            return $value->company != null;
        });
        // get the 3-random records from the database if is less than 10 then it will return all
        if (count($related_products) > 3) {
            $related_products = $related_products->random(3);
        }
        $data = compact('product', 'related_products');
        return view('pages.product.detail')->with($data);
    }
}
