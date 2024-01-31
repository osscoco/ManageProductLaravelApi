<?php


namespace App\Managers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductManager
{
    public function create(array $data)
    {
        $product = Product::create([
            'label' => $data['label'],
            'created_at' => Carbon::now(),
            'updated_at' => NULL
        ]);
        $product->save();
        return $product;
    }

    public function update(Product $product, array $request)
    {
        $request['updated_at'] = Carbon::now();
        $product = Product::where('id', $product->id)->update($request);
        return $product;
    }

    public function delete(Product $product)
    {
        $product = Product::where('id', $product->id)->delete();
    }
}
