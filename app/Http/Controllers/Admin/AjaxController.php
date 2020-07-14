<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Area;
use App\City;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shop;
use App\ShopProduct;
use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller {
    public function __construct() {
        $this->middleware('auth:admin');
    }

    //Return City according to Region
    public function getCities() {
        $cities = City::where('region_id', $_POST['region_id'])->pluck('name', 'id')->all();
        $data = '<option value=""></option>';
        foreach ($cities as $key => $value) {
            $data .= '<option value="' . $key . '">' . $value . '</option>';
        }
        return $data;
    }

    //Return Area according to City
    public function getAreas() {
        $areas = Area::where('city_id', $_POST['city_id'])->pluck('name', 'id')->all();
        $data = '<option value=""></option>';
        foreach ($areas as $key => $value) {
            $data .= '<option value="' . $key . '">' . $value . '</option>';
        }
        return $data;
    }

    //Return Product Price
    public function getProductPrice() {
        $price = 0;
        $product = Product::where('id', $_POST['product_id'])->first();
        if ($product) {
            $price = $product->price;
        }
        return $price;
    }

    //Return Shop Product Price
    public function getShopProductPrice() {
        $data = [
            'price' => null,
            'offer_price' => null,
        ];
        $shopProduct = ShopProduct::where('id', $_POST['shop_product_id'])->first();
        if ($shopProduct) {
            $data = [
                'price' => $shopProduct->price,
                'offer_price' => $shopProduct->offer_price,
            ];
        }
        return $data;
    }

    //Search Users
    public function searchUsers(Request $request) {
        $users = User::where('mobile', 'like', $request->get('search') . '%')
            ->orWhere('name', 'like', '%' . $request->get('search') . '%')->get()
            ->pluck('mobile_with_name', 'id')->all();

        $final = [];

        foreach ($users as $key => $user) {
            $final[] = ['id' => $key, 'text' => $user];
        }

        $data = [
            'results' => $final,
        ];

        return response()->json($data);
    }

    //Search Shop
    public function searchShops(Request $request) {
        $shops = Shop::where('contact', 'like', $request->get('search') . '%')
            ->orWhere('name', 'like', '%' . $request->get('search') . '%')->get()
            ->pluck('name_with_contact', 'id')->all();

        $final = [];

        foreach ($shops as $key => $user) {
            $final[] = ['id' => $key, 'text' => $user];
        }

        $data = [
            'results' => $final,
        ];

        return response()->json($data);
    }

    //Get User Return
    public function getAddresses() {
        $address = Address::where('user_id', $_POST['user_id'])->get()->pluck('full_address', 'id')->all();
        $data = '<option value=""></option>';
        foreach ($address as $key => $value) {
            $data .= '<option value="' . $key . '">' . $value . '</option>';
        }

        return $data;
    }
}
