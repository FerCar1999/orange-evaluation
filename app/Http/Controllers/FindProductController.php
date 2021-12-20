<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FindProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($key)
    {
        return Product::where('name', 'like', '%' . $key . '%')
            ->orWhere('sku', 'like', '%' . $key . '%')
            ->paginate(5);
    }
}
