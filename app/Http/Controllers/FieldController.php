<?php

namespace App\Http\Controllers;

use App\Rules\ProductCount;
use Illuminate\Http\Request;
use App\Field;
use App\Product;
use Illuminate\Validation\Rule;

class FieldController extends Controller
{

    public function index()
    {
        $fields = Field::all();

        return view('fields.fields', compact('fields'));
    }


    public function create()
    {
        $products = Product::all();

        if (!count($products)) {

            return redirect('/field')->withErrors('There are not any products. Please create at least one product before');
        }

        return view('fields.create_form', compact('products'));
    }


    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->except('_token');

            $request->validate([
                'qnty' => ['array', new ProductCount()],
                'name' => ['required', 'unique:fields', 'max:30'],
            ]);

            $field = new Field();
            $field->fill($input);

            if ($field->save()) {
                $count = count($input['product']);
                $i = 0;
                $array = [];
                while ($count) {
                    $el = [ $input['product'][$i] => ['quantity' => $input['qnty'][$i]] ];
                    $array += $el;
                    $i++;
                    $count--;
                }

                $field->products()->attach( $array );

                return redirect('/field')->with('status', 'The Field was created');

            } else {

                return redirect('/field')->with('status', 'The Field wasn\'t created');
            }
        }
    }


    public function show(Field $field)
    {
        $products = $field->products()->get();
        $data = [
            'field' => $field ,
            'products' => $products
        ];

        return view('fields.field', $data);
    }


    public function edit(Field $field)
    {
        $old_field = $field;
        $products = $old_field->products()->get();
        $num_products = count($products);
        $all_products = Product::all();
        $data = [
            'old_field' => $old_field,
            'products' => $products,
            'num_products' => $num_products,
            'all_products' => $all_products
        ];

        return view('fields.edit_form', $data);
    }


    public function update(Request $request, Field $old_field)
    {
        if ($request->isMethod('POST')) {
            $input = $request->except('_token');

            $request->validate([
                'qnty' => ['array', new ProductCount()],
                'name' => ['required',Rule::unique('fields')->ignore($input['id']), 'max:30'],
            ]);

            $old_field->products()->detach();
            $old_field->fill($input);

            if ($old_field->update()) {
                $count = count($input['product']);
                $i = 0;
                while ($count) {
                    $old_field->products()->attach( [ $input['product'][$i] => ['quantity' => $input['qnty'][$i]] ]);
                    $i++;
                    $count--;
                }

                return redirect('/field/show/'.$old_field->id)->with('status', 'The Field was update');
            }
        }
    }


    public function destroy(Request $request, Field $field)
    {
        if ($request->isMethod('DELETE')) {
            $field->products()->detach();
            $field->delete();

            return redirect('/field/')->with('status', 'The Field was deleted');
        }

        return redirect('/field/')->withErrors('The Field wasn\'t delete');
    }
}
