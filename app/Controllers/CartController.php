<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CartItemModel;
class CartController extends BaseController
{
public function add()
{
    $productID = $this->request->getPost('productID');
    $qty = (int) $this->request->getPost('qty');

    $userID = session()->get('user_id'); // since you have login

    $cartModel = new CartModel();
    $cartItemModel = new CartItemModel();

    // 1. Get or create cart
    $cart = $cartModel->where('userID', $userID)->first();

    if (!$cart) {
        $cartID = $cartModel->insert([
            'userID' => $userID
        ]);
    } else {
        $cartID = $cart['cartID'];
    }

    // 2. Check if product already in cart
    $existing = $cartItemModel
        ->where('cartID', $cartID)
        ->where('productID', $productID)
        ->first();

    if ($existing) {
        $cartItemModel->update($existing['cartItemID'], [
            'quantity' => $existing['quantity'] + $qty
        ]);
    } else {
        $cartItemModel->insert([
            'cartID' => $cartID,
            'productID' => $productID,
            'quantity' => $qty
        ]);
    }

    return redirect()->back();
}
}