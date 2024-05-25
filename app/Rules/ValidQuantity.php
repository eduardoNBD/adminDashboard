<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Product;

class ValidQuantity implements Rule
{
    protected $type;
    protected $itemId;

    public function __construct($itemId)
    { 
        $this->itemId = $itemId;
    }

    public function passes($attribute, $value)
    {
        
        $product = Product::find($this->itemId); 
        return $product && $product->qty >= $value;
    }

    public function message()
    {
        return 'La cantidad solicitada del producto excede la cantidad disponible.';
    }
}
