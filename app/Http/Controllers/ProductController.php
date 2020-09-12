<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return view('products.products', compact('products'));
    }


    public function create()
    {
        return view('products.create_form');
    }


    public function store(StoreProductRequest $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->except('_token');
            $product = new Product();
            $product->fill($input);
            if ($this->checkProduct($product->name)) {

                return redirect()->route('product_create')->withErrors('There is Product with the same name');
            }
            if ($product->save()) {

                return redirect('/product/')->with('status', 'Product was create');
            } else {

                return redirect('/product/')->withErrors('Product wasn\'t create');
            }
        }
    }


    public function edit(Product $product)
    {
        return view('products.edit_form', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $input = $request->except('_token');

        $request->validate([
            'name' => 'bail|required|max:11',
        ]);

        if ($this->checkProduct($input['name'])) {

            return redirect()->route('product_edit', $product->id)->withErrors('There is Product with the same name');
        }

        $product->fill($input);
        if($product->save()){

            return redirect('/product')->with('status', 'Product was update');
        }

        return redirect('/product')->withErrors('Product wasn\'t update');
    }


    public function destroy(Request $request, Product $product)
    {
        if ($request->isMethod('DELETE')) {
            if (count($product->fields()->get()) > 0) {

                return redirect('/product/')->withErrors('The Product is used! You must delete it form fields');
            }
            $product->delete();

            return redirect('/product/')->with('status', 'The Product was deleted');
        }

        return redirect('/product/')->withErrors('Product wasn\'t delete');
    }

    /**
     * Check if exist a product with a same name
     * @param string
     * @return boolean
     */
    public function checkProduct($name)
    {
        $products = Product::all();
        $product_names = [];
        foreach ($products as $product) {
            $product_names[] = $product->name;
        }

        return (in_array($name, $product_names)) ? true : false;
    }
}
