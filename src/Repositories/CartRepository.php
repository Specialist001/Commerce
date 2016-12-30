<?php

namespace Quarx\Modules\Hadron\Repositories;

use Session;
use Quarx\Modules\Hadron\Models\Cart;
use Quarx\Modules\Hadron\Models\Variant;

class CartRepository
{
    public function __construct()
    {
        $this->session = new Session();
        $this->user = auth()->user();
    }

    public function syncronize()
    {
        $cartContents = Session::get('cart');

        if ($cartContents) {
            foreach ($cartContents as $item) {
                $item = json_decode($item);
                $this->addToCart($item->entity_id, $item->entity_type, $item->quantity, $item->product_variants);
            }
        }

        Session::forget('cart');
    }

    public function cartContents()
    {
        return Cart::where('customer_id', $this->user->id)->orderBy('updated_at', 'desc')->get();
    }

    public function productCount($id)
    {
        $product = Cart::where('product_id', $id)->where('customer_id', $this->user->id)->first();

        if ($product) {
            return $product->quantity;
        }

        return 0;
    }

    public function getItem($id)
    {
        return Cart::where('id', $id)->where('customer_id', $this->user->id)->first();
    }

    public function addToCart($id, $type, $quantity, $variants)
    {
        $variantArray = null;

        if (json_decode($variants)) {
            foreach (json_decode($variants) as $variant) {
                $variantFound = Variant::find($variant->variant)->first();
                if ($variantFound && stristr(strtolower($variantFound->value), strtolower($variant->value))) {
                    $variantArray = $variants;
                }
            }
        }

        $input = [
            'customer_id' => $this->user->id,
            'entity_id' => $id,
            'entity_type' => $type,
            'product_variants' => $variantArray,
            'quantity' => $quantity,
        ];

        return Cart::create($input);
    }

    public function changeItemQuantity($id, $quantity)
    {
        $item = Cart::where('id', $id)->where('customer_id', $this->user->id)->first();
        $item->quantity = $quantity;

        return $item->save();
    }

    public function removeFromCart($id, $type)
    {
        $item = Cart::where('id', $id)->where('entity_type', $type)
        ->where('customer_id', $this->user->id)->first();

        return $item->delete();
    }

    public function emptyCart()
    {
        return Cart::where('customer_id', $this->user->id)->delete();
    }
}
