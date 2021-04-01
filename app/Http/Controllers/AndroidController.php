<?php

namespace App\Http\Controllers;

use App\Quotation;
use DateTime;
use DateTimeZone;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\manager;
use App\items;
use App\Category;
use App\order;
use App\users;
use App\admin;
use App\images;
use App\cart;
use App\offer;
use App\cartamount;
use App\itemDetails;


class AndroidController extends Controller
{
    public function category()
    {
        $category = Category::where("category_status", "=", "1")->get();
        return response()->json($category);
    }
    public function itemdetails($uid, $cid)
    {
        $user = users::where('user_id', '=', $uid)->get();
        if (count($user) > 0) {
            $a = array();
            $aa = array();
            $food_items = items::where('items.category_id', '=', $cid)->where('items.i_status', '=', '1')
                // ->join('items_details','items.item_id','=','items_details.item_id')
                // ->where('items_details.i_Detailstatus','=','1')
                // ->select('items.*','items_details.*')
                ->get();
            // return $bid;
            $totalamt = cart::where('user_id', '=', $uid)
                ->where('c_status', '=', '0')
                ->sum('sub_total');

            foreach ($food_items as $item) {

                $sql = itemDetails::where('item_id', '=', $item['item_id'])->where('i_Detailstatus', '=', '1')->get();
                $itemCount = $sql->count();
                $a['item_id'] = $item['item_id'];
                $a['category_id'] = $item['category_id'];
                $a['item_name'] = $item['iname'];
                $a['item_image'] = $item['item_image'];
                $a['item_qty'] = $item['item_qty'];
                $a['item_status'] = $item['i_status'];
                $a['weight_count'] = $itemCount;

                if ($itemCount == 2) {
                    $weight = itemDetails::where('netWeight', '=', 'Kg')->where('item_id', '=', $item['item_id'])
                        ->where('i_Detailstatus', '=', '1')->first();
                    $a['item_detail_id'] = $weight->item_detail_id;
                    $item_detail_id = cart::where('user_id', '=', $uid)
                        ->where('item_id', '=', $item['item_id'])
                        ->where('c_status', '=', '0')
                        ->value('item_detail_id');
                    if ($item_detail_id != null) {
                        if ($a['item_detail_id'] != $item_detail_id) {
                            $a['item_netWeight'] = "Grams";
                        } else {
                            $a['item_netWeight'] = $weight->netWeight;
                        }
                    } else {
                        $a['item_netWeight'] = $weight->netWeight;
                    }
                    // $a['item_netWeight']['gram'] = $weightGram->netWeight;
                    $a['item_weight'] = $weight->item_weight;
                    $a['item_minqty'] = $weight->qty_min;
                    $a['item_price'] = $weight->item_price;
                    $a['item_Detail_Status'] = $weight->i_Detailstatus;
                }
                if ($itemCount == 1) {
                    $weight = itemDetails::where('item_id', '=', $item['item_id'])->where('i_Detailstatus', '=', '1')->first();
                    $a['item_detail_id'] = $weight->item_detail_id;
                    $a['item_netWeight'] = $weight->netWeight;
                    $a['item_weight'] = $weight->item_weight;
                    $a['item_minqty'] = $weight->qty_min;
                    $a['item_price'] = $weight->item_price;
                    $a['item_Detail_Status'] = $weight->i_Detailstatus;
                }

                $cartitems = cart::where('user_id', '=', $uid)
                    ->where('item_id', '=', $item['item_id'])
                    ->where('c_status', '=', '0')
                    ->first();
                if ($cartitems != null) {

                    $item_id = $cartitems->item_id;
                    if ($item['item_id'] == $item_id) {

                        $a['cart_qty'] = $cartitems->cart_qty;
                        $a['item_detail_id'] = $cartitems->item_detail_id;
                    }
                } else {
                    $a['cart_qty'] = 0;
                }
                if ($totalamt != null) {
                    $a['total_amt'] = $totalamt;
                } else {
                    $a['total_amt'] = 0;
                }


                $aa[] = $a;
            }
            return $aa;
        } else {
            return response()->json('not found');
        }
    }


    public function GramDetails($uid, $item_id)
    {
        $totalamt = cart::where('user_id', '=', $uid)
            ->where('c_status', '=', '0')
            ->sum('sub_total');
        $food_items = items::where('item_id', '=', $item_id)->where('i_status', '=', '1')->first();
        $item = array();
        $item['item_id'] = $food_items->item_id;
        $item['category_id'] = $food_items->category_id;
        $item['item_name'] = $food_items->iname;
        $item['item_image'] = $food_items->item_image;
        $item['item_qty'] = $food_items->item_qty;
        $item['item_status'] = $food_items->i_status;
        $weightGram = itemDetails::where('netWeight', '=', 'Grams')->where('item_id', '=', $item['item_id'])
            ->where('i_Detailstatus', '=', '1')->first();
        $item['item_detail_id'] = $weightGram->item_detail_id;
        $item['item_netWeight'] = $weightGram->netWeight;
        $item['item_weight'] = $weightGram->item_weight;
        $item['item_minqty'] = $weightGram->qty_min;
        $item['item_price'] = $weightGram->item_price;
        $item['item_Detail_Status'] = $weightGram->i_Detailstatus;
        $cartitems = cart::where('user_id', '=', $uid)
            ->where('item_id', '=', $item['item_id'])
            ->where('c_status', '=', '0')
            ->first();

        if ($cartitems != null) {

            $item_id = $cartitems->item_id;
            if ($item['item_id'] == $item_id) {

                $item['cart_qty'] = $cartitems->cart_qty;
            }
        } else {
            $item['cart_qty'] = 0;
        }
        if ($totalamt != null) {
            $item['total_amt'] = $totalamt;
        } else {
            $item['total_amt'] = 0;
        }

        return $item;
    }

    public function kiloGramDetails($uid, $item_id)
    {
        $totalamt = cart::where('user_id', '=', $uid)
            ->where('c_status', '=', '0')
            ->sum('sub_total');
        $food_items = items::where('item_id', '=', $item_id)->where('i_status', '=', '1')->first();
        $item = array();
        $item['item_id'] = $food_items->item_id;
        $item['category_id'] = $food_items->category_id;
        $item['item_name'] = $food_items->iname;
        $item['item_image'] = $food_items->item_image;
        $item['item_qty'] = $food_items->item_qty;
        $item['item_status'] = $food_items->i_status;
        $weightGram = itemDetails::where('netWeight', '=', 'Kg')->where('item_id', '=', $item['item_id'])
            ->where('i_Detailstatus', '=', '1')->first();
        $item['item_detail_id'] = $weightGram->item_detail_id;
        $item['item_netWeight'] = $weightGram->netWeight;
        $item['item_weight'] = $weightGram->item_weight;
        $item['item_minqty'] = $weightGram->qty_min;
        $item['item_price'] = $weightGram->item_price;
        $item['item_Detail_Status'] = $weightGram->i_Detailstatus;
        $cartitems = cart::where('user_id', '=', $uid)
            ->where('item_id', '=', $item['item_id'])
            ->where('c_status', '=', '0')
            ->first();

        if ($cartitems != null) {

            $item_id = $cartitems->item_id;
            if ($item['item_id'] == $item_id) {

                $item['cart_qty'] = $cartitems->cart_qty;
            }
        } else {
            $item['cart_qty'] = 0;
        }
        if ($totalamt != null) {
            $item['total_amt'] = $totalamt;
        } else {
            $item['total_amt'] = 0;
        }

        return $item;
    }

    public function adduser(Request $request)
    {
        $mid = $request->input('mid');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $aadhar = $request->input('aadhar');
        $address = $request->input('address');
        $password = md5($request->input('pass'));
        $file = $request->input('image');
        $uploadedFile = request()->file($file);
        $filename = date('mdYHis') . uniqid();
        $filepath = "/var/www/public_html/shopimage/" . $filename . '.jpg';

        $timezone = 'ASIA/KOLKATA';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $localtime = $date->format('Y-m-d');

        $chkcont = users::where('ucontact', '=', $phone)->get();
        $chkemail = users::where('uemail', '=', $email)->get();

        if (count($chkcont) > 0) {
            return response()->json('Contact Number already exists');
        } elseif (count($chkemail) > 0) {
            return response()->json('Email-Id already exists');
        } else {
            if ($email == null) {
                $user = new users();
                $user->m_id = $mid;
                $user->uname = $name;
                $user->ucontact = $phone;
                $user->uemail = '0';
                $user->user_Aadhar = $aadhar;
                $user->uaddress = $address;
                $user->shop_image = $filename . '.jpg';
                $user->upass = $password;
                $user->udate = $localtime;
                $user->ustatus = '1';
                if ($user->save()) {
                    file_put_contents($filepath, base64_decode($file));
                    $id = $user->id;
                    // return response()->json(['status'=>'success','msg'=>'message', 'Data Saved','user_id'=>$id]);
                    return response()->json('success');
                } else {
                    return response()->json(['status' => 'error', 'msg' => 'Failed to Save']);
                }
            } else {
                $user = new users();
                $user->m_id = $mid;
                $user->uname = $name;
                $user->ucontact = $phone;
                $user->uemail = $email;
                $user->user_Aadhar = $aadhar;
                $user->uaddress = $address;
                $user->shop_image = $filename . '.jpg';
                $user->upass = $password;
                $user->udate = $localtime;
                $user->ustatus = '1';
                if ($user->save()) {
                    file_put_contents($filepath, base64_decode($file));
                    $id = $user->id;
                    // return response()->json(['status'=>'success','msg'=>'message', 'Data Saved','user_id'=>$id]);
                    return response()->json('success');
                } else {
                    return response()->json(['status' => 'error', 'msg' => 'Failed to Save']);
                }
            }
        }
    }

    public function getimage()
    {
        $img = images::all();
        return response()->json($img);
    }



    public function addcrt(Request $req)
   {

        $user_id = $req->input('uid');
        $item_id = $req->input('item_id');
        $item_detail_id = $req->input('item_detail_id');
        $item_qty = $req->input('iqty');
        $item_price = $req->input('itemprice');

        $chkwgt = itemDetails::where('item_detail_id','=',$item_detail_id)->value('netWeight');
        $chkqty = items::where('item_id','=',$item_id)
        ->value('item_qty');
        $cart_qty = cart::where('item_detail_id','=',$item_detail_id)
                 ->where('user_id','=',$user_id)
                 ->value('cart_qty');
        if($chkwgt == 'Kg')
        {
           $tamt = $item_qty*$item_price;
           $chkstckqty = $cart_qty + $item_qty;

        }
        elseif($chkwgt == 'Grams')
        {
            $nwgt=itemDetails::where('item_detail_id','=',$item_detail_id)->value('item_weight');
            $aa = $item_qty * $item_price;
            $tamt = $aa / $nwgt;
            $chkstckqty = ($cart_qty + $item_qty) / 1000;
        }
        elseif($chkwgt == 'Piece')
        {
            $tamt = $item_qty*$item_price;
            $chkstckqty = $cart_qty + $item_qty;
        }


        if($chkstckqty > $chkqty)
        {
            return 'No Stock';
        }
        else
        {
            $cartorder=cart::where('user_id','=',$user_id)
                            ->where('c_status','=','0')
                            ->get();

            if(count($cartorder) > 0)
            {
                    $cartitem = cart::where('item_detail_id','=',$item_detail_id)
                                    ->where('user_id','=',$user_id)
                                    ->where('c_status','=','0')
                                    ->get();

                    if(count($cartitem)>0)
                    {
                        $updateqty = cart::where('item_detail_id','=',$item_detail_id)
                                        ->where('user_id','=',$user_id)
                                        ->where('c_status','=','0')
                                        ->increment('cart_qty',$item_qty);
                        if($updateqty == true)
                        {
                            $update = cart::where('item_detail_id','=',$item_detail_id)
                                        ->where('user_id','=',$user_id)
                                        ->where('c_status','=','0')
                                        ->increment('sub_total',$tamt);
                                        $tmt = cart::where('user_id','=',$user_id)
                                                    ->where('c_status','=','0')
                                                    ->sum('sub_total');

                                        return response()->json(['total_amt' => $tmt,]);
                        }
                    }
                    else
                    {
                        $cart = new cart();
                        $cart->order_id='0';
                        $cart->user_id = $user_id;
                        $cart->item_id=$item_id;
                        $cart->item_detail_id = $item_detail_id;
                        $cart->cart_qty=$item_qty;
                        $cart->cart_price=$item_price;
                        $cart->sub_total=$tamt;
                        $cart->c_status = '0';
                        if($cart->save()){
                            $tmt = cart::where('user_id','=',$user_id)
                                        ->where('c_status','=','0')
                                        ->sum('sub_total');
                                    return response()->json(['total_amt' => $tmt]);
                        }
                    }
            }
            else
            {

                $timezone = 'ASIA/KOLKATA'; $date = new DateTime('now', new DateTimeZone($timezone));
                $localdate = $date->format('Y-m-d');
                $localtime = $date->format('h:s');

                $cartitem = cart::where('item_detail_id','=',$item_detail_id)
                                ->where('user_id','=',$user_id)
                                ->where('c_status','=','0')
                                ->get();

                if(count($cartitem)>0)
                {
                    $updateqty = cart::where('item_detail_id','=',$item_detail_id)
                                    ->where('user_id','=',$user_id)
                                    ->where('c_status','=','0')
                                    ->increment('cart_qty','=',$item_qty);
                    if($updateqty == true)
                    {
                        $update = cart::where('item_detail_id','=',$item_detail_id)
                                        ->where('user_id','=',$user_id)
                                        ->where('c_status','=','0')
                                        ->increment('sub_total','=',$tamt);
                        // $tmt = order::where('order_id','=',$oid)->value('total_amt');
                        $tmt = cart::where('user_id','=',$user_id)
                                    ->where('c_status','=','0')
                                    ->sum('sub_total');
                        return response()->json(['total_amt' => $tmt]);
                    }
                }
                else
                {
                    $cart = new cart();
                    $cart->order_id='0';
                    $cart->user_id = $user_id;
                    $cart->item_id=$item_id;
                    $cart->item_detail_id = $item_detail_id;
                    $cart->cart_qty=$item_qty;
                    $cart->cart_price=$item_price;
                    $cart->sub_total=$tamt;
                    $cart->c_status = '0';
                    if($cart->save()){
                        $tmt = cart::where('user_id','=',$user_id)
                                    ->where('c_status','=','0')
                                    ->sum('sub_total');
                        return response()->json(['total_amt' => $tmt]);
                    }
                }

                }
        }
   }

    public function delcart(Request $req)
    {
        $user_id = $req->input('uid');
        $item_id = $req->input('item_id');
        $item_detail_id = $req->input('item_detail_id');
        $item_qty = $req->input('iqty');
        $item_price = $req->input('itemprice');

        $chkwgt = itemDetails::where('item_detail_id','=',$item_detail_id)->value('netWeight');
        if($chkwgt == 'Kg')
        {
           $tamt = $item_qty*$item_price;
        }
        elseif($chkwgt == 'Grams')
        {
            $nwgt=itemDetails::where('item_detail_id','=',$item_detail_id)->value('item_weight');
            $aa = $item_qty * $item_price;
            $tamt = $aa / $nwgt;
        }
        elseif($chkwgt == 'Piece')
        {
            $tamt = $item_qty*$item_price;
        }
        $cart = cart::where('user_id', '=', $user_id)
            ->where('c_status', '=', '0')
            ->get();
        if (count($cart) > 0) {
            $samt = cart::where('user_id', '=', $user_id)
                ->where('item_detail_id', '=', $item_detail_id)
                ->where('c_status', '=', '0')
                ->decrement('cart_qty', $item_qty);
            if ($samt == true) {
                $crt = cart::where('item_detail_id', '=', $item_detail_id)
                    ->where('user_id', '=', $user_id)
                    ->where('c_status', '=', '0')
                    ->decrement('sub_total', $tamt);
            }

            $chkcart = cart::where('item_detail_id', '=', $item_detail_id)
                ->where('user_id', '=', $user_id)
                ->where('c_status', '=', '0')
                ->where('cart_qty', '=', '0')
                ->get();
            if (count($chkcart) > 0) {
                $delete = cart::where('item_detail_id', '=', $item_detail_id)
                    ->where('user_id', '=', $user_id)
                    ->where('c_status', '=', '0')
                    ->delete();
            }
            $tmt = cart::where('user_id', '=', $user_id)
                ->where('c_status', '=', '0')
                ->sum('sub_total');
            return response()->json([
                'total_amt' => $tmt,
            ]);
        } else {
            return response()->json('No Items');
        }
    }

    public function viewcarts(Request $req)
    {
        $user_id = $req->input('uid');
        $tmt = cart::where('user_id', '=', $user_id)
            ->where('c_status', '=', '0')
            ->sum('sub_total');
        $getdata = cart::where('user_id', '=', $user_id)
            ->where('c_status', '=', '0')
            ->join('items', 'cart.item_id', '=', 'items.item_id')
            ->join('items_details', 'cart.item_detail_id', '=', 'items_details.item_detail_id')
            ->select('items.*', 'items_details.*', 'cart.cart_id', 'cart.sub_total', 'cart.order_id', 'cart.item_id', 'cart.cart_qty', 'cart.cart_price', 'cart.sub_total', 'cart.c_status')
            ->get();
        foreach ($getdata as $item) {
            $sql = itemDetails::where('item_id', '=', $item->item_id)->where('i_Detailstatus', '=', '1')->get();
            $itemCount = $sql->count();
            $item['weight_count'] = $itemCount;
        }
        $getdata->map(function ($post) use ($tmt) {
            $post['total_amt'] = $tmt;
            return $post;
        });
        return response()->json($getdata);
    }

    public function checkouts(Request $req)
    {
        try {
            $timezone = 'ASIA/KOLKATA';
            $date = new DateTime('now', new DateTimeZone($timezone));
            $localdate = $date->format('Y-m-d');
            $localtime = $date->format('h:m');

            $uid = $req->input('uid');

            $ddate = $req->input('ddate');
            $sql = order::where('user_id', '=', $uid)
                ->where('u_status', '=', '1')
                ->where('paid_status', '=', 'Unpaid')
                ->first();
            if ($sql == true) {
                return response()->json('Unpaid');
            } else {
                $tamt = cart::where('user_id', '=', $uid)
                    ->where('c_status', '=', '0')
                    ->sum('sub_total');
                $offer = offer::value('offer_price');
                $per = ($tamt * $offer) / 100;
                $discount = $tamt - $per;
                $qry = offer::first();
                if ($qry == true) {
                    $number = mt_rand(1000000000, 9999999999);
                    $fow = 'FOW';
                    $order_number = $fow . $number;
                    $chknumber = order::where('order_number', '=', $order_number)->get();
                    if (count($chknumber) > 0) {
                        $number = mt_rand(1000000000, 9999999999);
                        $fow = 'FOW';
                        $order_number = $fow . $number;
                    }
                    $order = new order();
                    $order->order_number = $order_number;
                    $order->user_id = $uid;
                    $order->offer_price = $offer;
                    $order->offer_amt = $per;
                    $order->actual_amt = $tamt;
                    $order->total_amt = $discount;
                    $order->u_status = '1';
                    $order->order_date = $localdate;
                    $order->order_time = $localtime;
                    $order->paid_status = 'Unpaid';
                    $order->d_date = $ddate;
                    if ($order->save()) {
                        $oid = order::where('user_id', '=', $uid)
                            ->where('u_status', '=', '1')
                            ->value('order_id');
                        $cart = cart::where('user_id', '=', $uid)
                            ->where('c_status', '=', '0')
                            ->update(['order_id' => $oid, 'c_status' => '1']);
                        $data = $req->input('data1');
                        $array = json_decode($data, true);
                        foreach ($array as $value) {
                            $chkwgt = itemDetails::where('item_detail_id', '=', $value['item_detail_id'])->value('netWeight');
                            if ($chkwgt == 'Kg') {
                                $supdate = items::where('item_id', '=', $value['item_id'])->decrement('item_qty', $value['item_qty']);
                            } elseif ($chkwgt == 'Grams') {
                                $gr = $value['item_qty'] / 1000;
                                $total_gram = $gr;
                                $supdate = items::where('item_id', '=', $value['item_id'])->decrement('item_qty', $total_gram);
                            } elseif ($chkwgt == 'Piece') {
                                $supdate = items::where('item_id', '=', $value['item_id'])->decrement('item_qty', $value['item_qty']);
                            }
                        }
                        return response()->json('checkout successfull');
                    } else {
                        return response()->json('failed');
                    }
                } else {
                    $number = mt_rand(1000000000, 9999999999);
                    $fow = 'FOW';
                    $order_number = $fow . $number;
                    $chknumber = order::where('order_number', '=', $order_number)->get();
                    if (count($chknumber) > 0) {
                        $number = mt_rand(1000000000, 9999999999);
                        $fow = 'FOW';
                        $order_number = $fow . $number;
                    }
                    $order = new order();
                    $order->order_number = $order_number;
                    $order->user_id = $uid;
                    $order->offer_price = '0';
                    $order->offer_amt = '0';
                    $order->actual_amt = $tamt;
                    $order->total_amt = $tamt;
                    $order->u_status = '1';
                    $order->order_date = $localdate;
                    $order->order_time = $localtime;
                    $order->paid_status = 'Unpaid';
                    $order->d_date = $ddate;
                    if ($order->save()) {
                        $oid = order::where('user_id', '=', $uid)
                            ->where('u_status', '=', '1')
                            ->value('order_id');
                        $cart = cart::where('user_id', '=', $uid)
                            ->where('c_status', '=', '0')
                            ->update(['order_id' => $oid, 'c_status' => '1']);
                        $data = $req->input('data1');
                        $array = json_decode($data, true);
                        foreach ($array as $value) {
                            $chkwgt = itemDetails::where('item_detail_id', '=', $value['item_detail_id'])->value('netWeight');
                            if ($chkwgt == 'Kg') {
                                $supdate = items::where('item_id', '=', $value['item_id'])->decrement('item_qty', $value['item_qty']);
                            } elseif ($chkwgt == 'Grams') {
                                $gr = $value['item_qty'] / 1000;
                                $total_gram = $gr;
                                $supdate = items::where('item_id', '=', $value['item_id'])->decrement('item_qty', $total_gram);
                            } elseif ($chkwgt == 'Piece') {
                                $supdate = items::where('item_id', '=', $value['item_id'])->decrement('item_qty', $value['item_qty']);
                            }
                        }
                        return response()->json('checkout successfull');
                    } else {
                        return response()->json('failed');
                    }
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function login_user(Request $req)
    {
        try {
            $mob = $req->input('mob');
            $pass = md5($req->input('pass'));

            $login = users::where('ucontact', '=', $mob)
                ->where('upass', '=', $pass)
                ->where('ustatus', '=', '1')
                ->get();
            if (count($login) > 0) {
                $user_id = users::where('ucontact', '=', $mob)
                    ->where('upass', '=', $pass)
                    ->where('ustatus', '=', '1')
                    ->value('user_id');

                return response()->json(['message' => 'success', 'user_id' => $user_id]);
            } else {
                return response()->json(['message' => 'failed']);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function recentorders($uid)
    {
        $order = order::where('user_id', '=', $uid)
            ->whereIn('u_status', array(1, 2))
            ->get();
        return response()->json($order);
    }

    public function recentordersitems($uid, $oid)
    {
        $getdata = order::where('order.order_number', '=', $oid)
            ->whereIn('order.u_status', array(1, 2))
            ->join('cart', 'order.order_id', '=', 'cart.order_id')
            ->join('items', 'cart.item_id', '=', 'items.item_id')
            ->join('items_details', 'items_details.item_detail_id', '=', 'cart.item_detail_id')
            ->select('order.*', 'cart.*', 'items.*', 'items_details.*')
            ->get();
        return response()->json($getdata);
    }

    public function userprofile($uid)
    {
        $users = users::where('user_id', '=', $uid)->get();
        return response()->json($users);
    }

    public function billdetails($uid)
    {
        $offer = offer::first();
        if ($offer == null) {
            $offer_price = 0;
        } else {
            $offer_price = $offer->offer_price;
        }

        $tamt = cart::where('user_id', '=', $uid)
            ->where('c_status', '=', '0')
            ->sum('sub_total');
        return response()->json(['offer_price' => $offer_price, 'actual_amt' => $tamt]);
    }

    public function managerlogin(Request $request)
    {
        $mbno = $request->input('mobile');
        $pass = $request->input('password');
        $sql = manager::where('mcontact', '=', $mbno)
            ->where('mpass', '=', $pass)
            ->where('mstatus', '=', '1')
            ->get();
        if (count($sql) > 0) {
            $mid = manager::where('mcontact', '=', $mbno)
                ->where('mpass', '=', $pass)
                ->value('m_id');
            return response()->json(['message' => 'success', 'mid' => $mid]);
            // return $mid;
        } else {
            return response()->json(['message' => 'Failed']);
        }
    }

    public function managerprofile($mid)
    {
        $data = manager::where('m_id', '=', $mid)->get();
        return $data;
    }

    public function newusers()
    {
        $users = users::where('ustatus', '=', '0')->get();
        return response()->json($users);
    }

    public function userapprove($uid)
    {
        $update = users::where('user_id', '=', $uid)->update(['ustatus' => '1']);
        if ($update == true) {
            return response()->json('Approved');
        }
    }

    public function user_reject($uid)
    {
        $delete = users::where('user_id', '=', $uid)->delete();
        if ($delete == true) {
            return response()->json('Deleted');
        }
    }

    public function offer()
    {
        $offer = offer::first();
        return $offer;
    }

    public function musers($mid)
    {
        $users = users::where('m_id', '=', $mid)->get();
        return $users;
    }

    public function mshoporder($mid)
    {
        $users = users::where('users.m_id', '=', $mid)
            ->join('order', 'order.user_id', 'users.user_id')
            ->select('users.*', 'order.*')
            ->where('order.u_status', '=', '1')
            ->get();
        return $users;
    }

    public function shoporderitems($oid)
    {
        $getdata = cart::where('cart.order_id', '=', $oid)
            ->join('items', 'cart.item_id', '=', 'items.item_id')
            ->join('items_details', 'items_details.item_detail_id', '=', 'cart.item_detail_id')
            ->select('cart.*', 'items.*', 'items_details.*')
            ->get();
        return response()->json($getdata);
    }

    // Total amount in cart
    public function cart_total($uid)
    {
        $cart = cart::where('user_id', '=', $uid)
            ->where('c_status', '=', '0')
            ->sum('sub_total');
        return response()->json(['Total' => $cart]);
    }

    // cart minimum amount
    public function Cart_Minimum_Amount()
    {
        $cartamount = cartamount::first();
        return response()->json($cartamount);
    }
}
