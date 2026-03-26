<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CartItemModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\OrderItemsModel;
use App\Models\AddressModel;
use App\Models\UserModel;

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

    public function buyNow()
    {
        $userID = session()->get('user_id');

        if (!$userID) {
            return redirect()->to(base_url('login'))->with('error', 'Please log in first.');
        }

        $productID = (int) $this->request->getPost('productID');
        $qty = (int) $this->request->getPost('qty');

        if ($productID < 1) {
            return redirect()->back()->with('error', 'Invalid product.');
        }

        if ($qty < 1) {
            $qty = 1;
        }

        session()->set('buy_now', [
            'productID' => $productID,
            'quantity'  => $qty
        ]);

        return redirect()->to(base_url('checkout'));
    }

    public function checkout()
    {
        $userID = session()->get('user_id');

        if (!$userID) {
            return redirect()->to(base_url('login'))->with('error', 'Please log in first.');
        }

        $cartModel = new CartModel();
        $cartItemModel = new CartItemModel();
        $productModel = new ProductModel();
        $userModel = new UserModel();
        $addressModel = new AddressModel();

        $user = $userModel->find($userID);
        $savedAddress = $addressModel->where('userID', $userID)->first();
        $buyNow = session()->get('buy_now');

        $cartItems = [];

        if ($buyNow && !empty($buyNow['productID'])) {
            $cartItems[] = [
                'productID' => $buyNow['productID'],
                'quantity'  => $buyNow['quantity']
            ];
        } else {
            $cart = $cartModel->where('userID', $userID)
                              ->orderBy('cartID', 'DESC')
                              ->first();

            if ($cart) {
                $rawCartItems = $cartItemModel->where('cartID', $cart['cartID'])->findAll();

                $merged = [];
                foreach ($rawCartItems as $item) {
                    $productID = $item['productID'];

                    if (!isset($merged[$productID])) {
                        $merged[$productID] = $item;
                    } else {
                        $merged[$productID]['quantity'] += $item['quantity'];
                    }
                }

                $cartItems = array_values($merged);
            }
        }

        $addressText = '';

        if ($savedAddress) {
            $addressText =
                ($savedAddress['street'] ?? '') . ', ' .
                ($savedAddress['city'] ?? '') . ', ' .
                ($savedAddress['state'] ?? '') . ', ' .
                ($savedAddress['zip'] ?? '');
        }

        return view('checkout', [
            'cartItems'    => $cartItems,
            'productModel' => $productModel,
            'user'         => $user,
            'addressText'  => $addressText,
        ]);
    }

    public function processCheckout()
    {
        $userID = session()->get('user_id');

        if (!$userID) {
            return redirect()->to(base_url('login'))->with('error', 'Please log in first.');
        }

        $paymentMethod = $this->request->getPost('payment_method');
        $shippingFee = (float) $this->request->getPost('shipping_fee');
        $shippingMethod = $this->request->getPost('shipping_method');

        $cartModel = new CartModel();
        $cartItemModel = new CartItemModel();
        $productModel = new ProductModel();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemsModel();
        $addressModel = new AddressModel();

        $savedAddress = $addressModel->where('userID', $userID)->first();

        if (!$savedAddress) {
            return redirect()->to(base_url('profile'))->with('error', 'Please add your address first.');
        }

        $buyNow = session()->get('buy_now');
        $cartItems = [];

        if ($buyNow && !empty($buyNow['productID'])) {
            $cartItems[] = [
                'productID' => $buyNow['productID'],
                'quantity'  => $buyNow['quantity']
            ];
        } else {
            $cart = $cartModel->where('userID', $userID)
                              ->orderBy('cartID', 'DESC')
                              ->first();

            if (!$cart) {
                return redirect()->back()->with('error', 'Cart not found.');
            }

            $rawCartItems = $cartItemModel->where('cartID', $cart['cartID'])->findAll();

            if (empty($rawCartItems)) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }

            $merged = [];
            foreach ($rawCartItems as $item) {
                $productID = $item['productID'];

                if (!isset($merged[$productID])) {
                    $merged[$productID] = $item;
                } else {
                    $merged[$productID]['quantity'] += $item['quantity'];
                }
            }

            $cartItems = array_values($merged);
        }

        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'No item selected.');
        }

        $subtotal = 0;

        foreach ($cartItems as $item) {
            $product = $productModel->find($item['productID']);
            if (!$product) {
                continue;
            }

            $subtotal += ((float) $product['productPrice']) * ((int) $item['quantity']);
        }

        $totalAmount = $subtotal + $shippingFee;

        $orderModel->insert([
            'userID'         => $userID,
            'addressID'      => $savedAddress['addressID'],
            'totalAmount'    => $totalAmount,
            'shippingMethod' => $shippingMethod ?: 'None',
            'shippingCost'   => $shippingFee,
            'paymentMethod'  => $paymentMethod ?: 'None',
            'status'         => 'Pending'
        ]);

        $orderID = $orderModel->getInsertID();

        foreach ($cartItems as $item) {
            $product = $productModel->find($item['productID']);
            if (!$product) {
                continue;
            }

            $itemSubTotal = ((float) $product['productPrice']) * ((int) $item['quantity']);

            $orderItemModel->insert([
                'quantity' => (int) $item['quantity'],
                'subTotal' => $itemSubTotal,
                'productID'=> $item['productID'],
                'orderID'  => $orderID
            ]);
        }

        if ($buyNow && !empty($buyNow['productID'])) {
            session()->remove('buy_now');
        } else {
            $cart = $cartModel->where('userID', $userID)
                              ->orderBy('cartID', 'DESC')
                              ->first();

            if ($cart) {
                $cartItemModel->where('cartID', $cart['cartID'])->delete();
            }
        }

        return redirect()->to(base_url('profile'))->with('success', 'Order placed successfully.');
    }
}