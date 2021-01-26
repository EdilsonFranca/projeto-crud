<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        try {
            return response()->json(array(
                'success' => true,
                'data' => Product::all(),
            ));

        } catch (\Exception $e) {
            return response()->json(array(
                'success' => false,
                'message' => 'here was an error',
                'messageError' => $e->getMessage(),
            ));
        }
    }

    public function create(Request $request)
    {
        $data = $request->only(['name', 'price', 'description']);
        $validation = $this->getValidate($data);

        if ($validation->fails()) {
            return response()->json(array(
                'success' => false,
                'message' => $validation->errors()
            ));
        }

        $product = Product::where('name', $data['name'])
            ->where('price', $data['price'])
            ->where('description', $data['description'])->first();

        if (is_null($product)) {
            $product = Product::create($data);

            return response()->json(array(
                'success' => true,
                'data' => $product,
                'message' => 'product  registered successfully !'
            ));
        }

        return response()->json(array(
            'success' => false,
            'data' => $product,
            'message' => ['' => ['product with this name already exists !']],
        ));

    }

    /**
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidate(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $validation = Validator::make($data, array(
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ));
        return $validation;
    }

    public function store(Request $request){}

    public function show(int $id)
    {
        try {
            return response()->json(array(
                'success' => true,
                'data' => Product::findOrFail($id),
            ));

        } catch (\Exception $e) {
            return response()->json(array(
                'success' => false,
                'message' => 'There was an error',
                'messageError' => $e->getMessage(),
            ));
        }
    }

    public function edit(int $id){
        try {
            return response()->json(array(
                'success' => true,
                'data' => Product::findOrFail($id),
            ));

        } catch (\Exception $e) {
            return response()->json(array(
                'success' => false,
                'message' => 'There was an error',
                'messageError' => $e->getMessage(),
            ));
        }
    }

    public function update(Request $request, int $id)
    {
        $data = $request->only(['name', 'price', 'description']);
        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json([
                'message' => 'contact list not found !'
            ], 404);
        }

        $product->fill(array(
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
        ));

        $product->save();

        return response()->json(array(
            'success' => true,
            'data' => $product,
            'message' => 'product  updated successfully !'
        ));
    }

    public function destroy($id)
    {
        $qtd = Product::destroy($id);
        if ($qtd === 0) {
            return response()->json([
                'erro' => 'contact list not found !'
            ], 404);
        }
        return response()->json(array(
            'success' => true,
            'message' => 'product  successfully removed !'
        ));
    }
}
