<?php

namespace App\Http\Controllers;
use DateTime;
use DateTimeZone;
use App\Quotation;
use DB;
use Auth;
use Session;
use Crypt;

use Illuminate\Support\Facades\Input;
Use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

use App\manager;
use App\Category;
use App\items;
use App\order;
use App\users;
use App\admin;
use App\images;
use App\offer;
use App\cart;
use App\cartamount;
use App\itemDetails;


class AdminController extends Controller
{

    public function adminlogin(Request $req)
   {
      $uname = $req->input('username');
      $pass = $req->input('pass');
      // $hashed = md5($pass);
      $login =admin::where(['user_name' => $uname, 'password'=> $pass ])->get();
      if(count($login)>0)
      {
          $empid =admin::where(['user_name' => $uname, 'password'=> $pass])->value('admin_id');

          Session::put('empid',$empid);
          $notification = array(
                    'message' => 'Logged In Successfully, Welcome Admin!',
                    'alert-type' => 'success'
            );
          return redirect('dashboard')->with($notification);
      }
      else {
         $notification = array(
                    'message' => 'Invalid username or password',
                    'alert-type' => 'error'
            );
          return redirect('/FOWADMIN')->with($notification);
      }

   }

   public function alogout()
   {
    Session::forget('empid');
    Session::flush();
    $notification = array(
      'message' => 'Logged Out Successfully!',
      'alert-type' => 'info'
    );
    return redirect('/FOWADMIN')->with($notification);
   }

   public function adminchngpass(Request $request)
  {
    $npass = $request->input('npass');
    $opass = $request->input('opass');
    $cpass = $request->input('cpass');

    $sql = admin::where('password','=',$opass)->get();
    if(count($sql)>0)
    {
      if($cpass == $npass)
      {
        $aid = Session::get('empid');
        $update = admin::where('admin_id','=',$aid)
                        ->where('password','=',$opass)->update(['password'=>$npass]);
        if($update == true)
        {
          $notification = array(
            'message' => 'Password Changed successfully',
            'alert-type' => 'success'
          );
          return redirect('changepassword')->with($notification);
        }
        else
        {
          $notification = array(
            'message' => 'Failed to change',
            'alert-type' => 'error'
          );
          return redirect('changepassword')->with($notification);
        }
      }
      else
      {
        $notification = array(
          'message' => 'Password Doesnt match',
          'alert-type' => 'warning'
        );
        return redirect('changepassword')->with($notification);
      }
    }
    else
    {
      $notification = array(
          'message' => 'No Password found',
          'alert-type' => 'error'
      );
       return redirect('/changepassword')->with($notification);
    }
  }

  public function addmanager (Request $req)
  {
    $timezone = 'ASIA/KOLKATA'; $date = new DateTime('now', new DateTimeZone($timezone));
    $localtime = $date->format('Y-m-d');
      $mname = $req->input('name');
      $mcontact = $req->input('contact');
      $memail = $req->input('email');
      $mpassword = $req->input('pass');


      $manager = new manager();
       $manager->mname = $mname;
       $manager->mcontact = $mcontact;
       $manager->memail = $memail;
       $manager->mpass = $mpassword;
       $manager->mdate = $localtime;
       $manager->mstatus = '1';
       if($manager->save()){
           return redirect('/mnagers')->with('message', 'data saved');
       }else{

  return redirect('/addmnager')->with('error', 'failed to save');
     }
   }

// Add Category
public function addcategoryqry(Request $request)
{
  $catname = $request->input('cname');
  $image = $request->file('image');
  $pic = date('mdYHis') . uniqid() . $image->getClientOriginalName();

  $sql = Category::where('category_name','=',$catname)->get();
  if(count($sql) > 0)
  {
    $notification = array(
      'message' => 'Category already present in Database',
      'alert-type' => 'warning'
    );
    return redirect('/Category')->with($notification);
  }
  else
  {
    $category = new Category();
    $category->category_name = $catname;
    $category->category_image = $pic;
    $category->category_status = '1';
    if($category->save())
    {
      $destinationPath = 'category_image';
      $image->move($destinationPath, $pic);
      $notification = array(
        'message' => 'Category added to Database',
        'alert-type' => 'success'
      );
      return redirect('/Category')->with($notification);
    }
    else
    {
      $notification = array(
        'message' => 'Error occurred',
        'alert-type' => 'error'
      );
      return redirect('/Category')->with($notification);
    }
  }
}

public function categorystatus($cid,$status)
{
  if($status == 'disable')
  {
    $update = Category::where('category_id','=',$cid)->update(['category_status'=>'0']);
    if($update == true)
    {
      $notification = array(
        'message' => 'Category Disabled',
        'alert-type' => 'success'
      );
      return redirect('/Category')->with($notification);
    }
    else
    {
      $notification = array(
        'message' => 'Error occurred',
        'alert-type' => 'error'
      );
      return redirect('/Category')->with($notification);
    }
  }
  elseif($status == 'enable')
  {
    $update = Category::where('category_id','=',$cid)->update(['category_status'=>'1']);
    if($update == true)
    {
      $notification = array(
        'message' => 'Category Enabled',
        'alert-type' => 'success'
      );
      return redirect('/Category')->with($notification);
    }
    else
    {
      $notification = array(
        'message' => 'Error occurred',
        'alert-type' => 'error'
      );
      return redirect('/Category')->with($notification);
    }
  }
}

public function updatecategory(Request $request)
{
  $cid = $request->input('cat_id');
  $catname = $request->input('cname');
  $update = Category::where('category_id','=',$cid)->update(['category_name'=>$catname]);
  if($update == true)
  {
    $notification = array(
      'message' => 'Category Updated',
      'alert-type' => 'success'
    );
    return redirect('/Category')->with($notification);
  }
  else
  {
    $notification = array(
      'message' => 'Error occurred',
      'alert-type' => 'error'
    );
    return redirect('/Category')->with($notification);
  }
}

public function updatecategorypic(Request $request)
{
  $cid = $request->input('cid');
  $cat_img = $request->input('cat_img');
  $image = $request->file('photo');
  $pic = date('mdYHis') . uniqid() . $image->getClientOriginalName();
  $update = Category::where('category_id','=',$cid)->update(['category_image'=>$pic]);
  if($update == true)
  {
    // Delete Image From Folder
    $filename = 'category_image/'.$cat_img;
    \File::delete($filename);
    $destinationPath = 'category_image';
    $image->move($destinationPath, $pic);
    $notification = array(
      'message' => 'Category Image Updated',
      'alert-type' => 'success'
    );
    return redirect('/Category')->with($notification);
  }
  else
  {
    $notification = array(
      'message' => 'Error occurred',
      'alert-type' => 'error'
    );
    return redirect('/Category')->with($notification);
  }
}

// End

  //  Items Products
  public function additems(Request $req)
  {
    $cid = $req->input('category');
    $iname = $req->input('name');
    $image = $req->file('image');
    $iiname = date('mdYHis') . uniqid() . $image->getClientOriginalName();
    $kilogram = $req->input('kilogram');
    $Grams = $req->input('Grams');
    $Piece = $req->input('Piece');
    $iweight1 = $req->input('weight1');
    $iqty = $req->input('qty');
    $iprice1 = $req->input('price1');
    $iweight2 = $req->input('weight2');
    $iprice2 = $req->input('price2');
    $iweight3= $req->input('weight3');
    $iprice3 = $req->input('price3');
    $minkg = $req->input('minkg');
    $mingrams = $req->input('mingrams');
    $minPiece = $req->input('minPiece');


    $items = new items();
    $items->category_id = $cid;
    $items->iname = $iname;
    $items->item_image = $iiname;
    $items->item_qty = $iqty;
    $items->i_status ='1';
    if($items->save())
    {
      if($req->input('kilogram'))
      {
        $idetail = new itemDetails();
        $idetail->item_id = $items->id;
        $idetail->netWeight = $kilogram;
        $idetail->item_weight = $iweight1;
        $idetail->item_price = $iprice1;
        $idetail->qty_min = $minkg;
        $idetail->i_Detailstatus = '1';
        $idetail->save();
      }
      if($req->input('Grams'))
      {
        $idetail = new itemDetails();
        $idetail->item_id = $items->id;
        $idetail->netWeight = $Grams;
        $idetail->item_weight = $iweight2;
        $idetail->item_price = $iprice2;
        $idetail->qty_min = $mingrams;
        $idetail->i_Detailstatus = '1';
        $idetail->save();
      }
      if($req->input('Piece'))
      {
        $idetail = new itemDetails();
        $idetail->item_id = $items->id;
        $idetail->netWeight = $Piece;
        $idetail->item_weight = $iweight3;
        $idetail->item_price = $iprice3;
        $idetail->qty_min = $minPiece;
        $idetail->i_Detailstatus = '1';
        $idetail->save();
      }
      $destinationPath = 'itemimage';
      $image->move($destinationPath, $iiname);
      $notification = array(
        'message' => 'Product added to Database',
        'alert-type' => 'success'
      );
      return redirect('/items')->with($notification);

    }
    else
    {
      $notification = array(
        'message' => 'Error occurred',
        'alert-type' => 'error'
      );
      return redirect('/additems')->with($notification);

    }
  }

  public function edititems($iid)
  {
    $id = Crypt::decrypt($iid);
    $category = Category::all();
    $item_image = items::where('item_id','=',$id)->get();
    $item= items::where('items.item_id','=',$id)
                ->join('category','items.category_id','=','category.category_id')
                ->select('items.*','category.*')
                ->get();
    return view('Admin/edititems',compact('item_image','item','category'));
  }

  public function itemDetails($iid)
  {
    $id = Crypt::decrypt($iid);
    $item= itemDetails::where('items_details.item_id','=',$id)
                ->join('items','items_details.item_id','=','items.item_id')
                ->select('items_details.*','items.*')
                ->get();
    return view('Admin/itemDetails',compact('item'));
  }

public function updateitems(request $req)
{
  $id = $req->input('item_id');
  $name = $req->input('name');
  $category = $req->input('category');

  // cart quantity
  $cartqty = cart::where('item_id','=',$id)
                ->where('c_status','=','0')
                ->value('cart_qty');
  // order id
  $oid = cart::where('item_id','=',$id)
                ->where('c_status','=','0')
                ->get();

  // $stotal = $cartqty*$price;

  $update = items::where('item_id','=',$id)->update(['category_id'=>$category,'iname' => $name]);
  if($update==true)
  {
    // items quantity update(re stock)
    // $cartupdate = cart::where('item_id','=',$id)->where('c_status','=','0')->update(['cart_price'=>$price,'sub_total'=>$stotal]);
    $notification = array(
      'message' => 'Stock Updated Successfully',
      'alert-type' => 'success'
    );
    return redirect('items')->with($notification);

  }
  else
  {
    $notification = array(
      'message' => 'Error Occurred',
      'alert-type' => 'error'
    );
    return redirect('items')->with($notification);
  }

}


public function deleteitems($iid)
{
 try
 {
    $id = Crypt::decrypt($iid);
    $itemimg = items::where('item_id','=',$id)->value('item_image');
    $sql = cart::where('item_id','=',$id)->get();
    if(count($sql))
    {
      $notification = array(
        'message' => 'Items are present in user order, item cannot be deleted!',
        'alert-type' => 'warning'
      );
      return redirect('/items')->with($notification);
    }
    else
    {
      $qry = items::where('item_id','=',$id)->delete();
      if($qry == true)
      {
        $qry = itemDetails::where('item_id','=',$id)->delete();
        // Delete Image From Folder
        $filename = 'itemimage/'.$itemimg;
        \File::delete($filename);
        $notification = array(
          'message' => 'Products has been deleted',
          'alert-type' => 'success'
        );
          return redirect('/items')->with($notification);
      }
      else
      {
        $notification = array(
          'message' => 'Error Occurred',
          'alert-type' => 'error'
        );
        return redirect('/items')->with($notification);
      }
    }
 }
   catch (\Exception $e) {
       return $e->getMessage();
   }

}

public function deactiveitems($iid)
{
  $id = Crypt::decrypt($iid);
  $sql = items::where('item_id','=',$id)
              ->where('item_qty','!=','0')
              ->get();
  if(count($sql)>0)
  {
    $notification = array(
      'message' => 'Cannot deactivate the item, stock is full, please update the stock',
      'alert-type' => 'warning'
    );
    return redirect('/items')->with($notification);
  }
  else
  {
    $itm = items::where('item_id','=',$id)->update(['i_status' => '0']);
    if($itm == true)
    {
      $qry = itemDetails::where('item_id','=',$id)->update(['i_Detailstatus'=>'0']);
      $notification = array(
        'message' => 'Product has been deactivated',
        'alert-type' => 'success'
      );
      return redirect('/items')->with($notification);
    }
    else
    {
      $notification = array(
        'message' => 'Error Occurred',
        'alert-type' => 'error'
      );
      return redirect('/items')->with($notification);
    }
  }
}



  public function activeitems($iid)
  {
    $id = Crypt::decrypt($iid);
    $itm = items::where('item_id','=',$id)->update(['i_status' => '1']);
    if($itm == true)
    {
      $qry = itemDetails::where('item_id','=',$id)->update(['i_Detailstatus'=>'1']);
      $notification = array(
        'message' => 'Product has been activated',
        'alert-type' => 'success'
      );
      return redirect('/items')->with($notification);
    }
    else
    {
      $notification = array(
        'message' => 'Error Occurred',
        'alert-type' => 'error'
      );
      return redirect('/items')->with($notification);
    }

  }


public function updateitempic(Request $request)
{
  $iid = $request->input('itemid');
  $image = $request->file('item_pic');
  $itemimg = $request->input('itemimg');
  $iiname = date('mdYHis') . uniqid() . $image->getClientOriginalName();
  $update = items::where('item_id','=',$iid)->update(['item_image'=>$iiname]);
  if($update==true)
  {
    $destinationPath = 'itemimage';
    $image->move($destinationPath, $iiname);

    // Delete Image From Folder
    $filename = '/itemimage'.$itemimg;
    \File::delete($filename);

    return redirect('items/')->with('message','Updated successfully');
  }
  else
  {
    return redirect('items/')->with('error','failed to updated');
  }
}

public function updatestock($iid)
{
  $id = Crypt::decrypt($iid);
  $item = items::where('item_id','=',$id)->get();
  return view('Admin/stockupdate',compact('item'));
}

public function stockupdateqry(Request $request)
{
  $iid = $request->input('item_id');
  $stock = $request->input('stock');
  $update=items::where('item_id','=',$iid)->increment('item_qty', $stock);
  if($update==true)
  {
    return redirect('items')->with('success','Updated successfully');
  }
  else
  {
    return redirect('items')->with('error','failed to updated');
  }
}

// End Items

public function editmanager($mid)
{

  $emnger = manager::where('m_id','=',$mid)->get();
  return view('Admin/editmanager',compact('emnger'));

}

public function updatemnager(request $req)
{
  $id = $req->input('mid');
  $name = $req->input('name');
  $contact = $req->input('contact');
  $email = $req->input('email');
  $pass = $req->input('pass');

  $manager = new manager();
  $update = manager::where('m_id','=',$id)->update(['mname' => $name, 'mcontact' => $contact, 'memail' => $email, 'mpass' => $pass]);
  if($update==true)
  {
    return redirect('mnagers/')->with('message','Updated successfully');

  }else
  {
    return redirect('editmanager/')->with('error','failed to updated');
  }

}
public function deletemanager($id)
{
  try{
    $mangr = manager::where('m_id','=',$id)->delete();
    if($mangr == true)
    {
        return redirect('mnagers')->with('message', 'Data Saved');
    }
    else
    {
        return redirect('/mnagers')->with('error', 'Failed to Save');
    }
  }
  catch (\Exception $e) {
      return $e->getMessage();
  }

}
public function deactivemanager($mid)
{
  $manager = manager::where('m_id','=',$mid)->update(['mstatus' => '0']);
  if($manager == true)
  {
    return redirect('/mnagers');
  }
  else
  {
    return redirect('/mnagers');
  }
}

    public function activemanager($mid)
   {
    $manager = manager::where('m_id','=',$mid)->update(['mstatus' => '1']);
    if($manager == true)
    {
        return redirect('/mnagers');
    }else{
      return redirect('/mnagers');
    }

  }


public function customerorderitems($id,$uid)
{
  $item_id = Crypt::decrypt($id);
  $user_id = Crypt::decrypt($uid);
  try
  {
    $view = order::where('order.order_id','=',$item_id)
                  ->join('cart','cart.order_id','order.order_id')
                  ->join('items','items.item_id','cart.item_id')
                  ->join('items_details','items_details.item_detail_id','cart.item_detail_id')
                  ->select('items.*','cart.*','order.*','items_details.*')
                  ->get();
    $order = order::where('order_id','=',$item_id)->get();

    $user =users::where('users.user_id','=',$user_id)->get();
    return View('Admin/customerorderitems',compact('view','user','order'));
   }
   catch (\Exception $e)
   {
     return $e->getMessage();
   }
}


   public function porderitems($id,$uid)
   {
      try
      {
        $view = order::where('order.order_id','=',$id)
                    ->join('cart','cart.order_id','order.order_id')
                    ->join('items','items.item_id','cart.item_id')
                     ->join('items_details','items_details.item_detail_id','cart.item_detail_id')
                    ->select('items.*','cart.*','order.*','items_details.*')
                    ->get();
        $order = order::where('order_id','=',$id)->get();
        $user =users::where('users.user_id','=',$uid)->get();
        return View('Admin/previousOrderitems',compact('view','user','order'));
      }
      catch (\Exception $e)
      {
        return $e->getMessage();
      }
   }

   public function ordercancelitems($id,$uid)
   {
      try
      {
        $view = order::where('order.order_id','=',$id)
                    ->join('cart','cart.order_id','order.order_id')
                    ->join('items','items.item_id','cart.item_id')
                    ->join('items_details','items_details.item_detail_id','=','cart.item_detail_id')
                    ->select('items.*','cart.*','order.*','items_details.*')
                    ->get();
        $order = order::where('order_id','=',$id)->get();
        $user =users::where('users.user_id','=',$uid)->get();
        return View('Admin/ordercancelitems',compact('view','user','order'));
      }
      catch (\Exception $e)
      {
        return $e->getMessage();
      }
   }

public function orderpaid($oid)
{
  $timezone = 'ASIA/KOLKATA'; $date = new \DateTime('now', new \DateTimeZone($timezone));
  $localdate = $date->format('Y-m-d');
  $update = order::where('order_id','=',$oid)->update(['u_status'=>'2','paid_status'=>'Paid','paid_date'=>$localdate]);
   if($update == true)
   {
       $cart = cart::where('order_id','=',$oid)->update(['c_status'=>'2']);
       return redirect('/orders')->with('message', 'Payment done');
   }
   else
   {
       return redirect('/orders')->with('error', 'Failed to update');
   }
}

public function mnagercustomers($mid)
{
  $users = users::where('m_id','=',$mid)->get();
  return view('Admin/mnagercustomers',compact('users'));
}

public function offerqry(Request $request)
{
  $offerprice = $request->input('offerprice');
  $offer = new offer();
  $offer->offer_price = $offerprice;
  if($offer->save())
  {
    $notification = array(
      'message' => 'Data Saved',
      'alert-type' => 'success'
    );
    return redirect('/offer')->with($notification);
  }
  else
  {
    $notification = array(
      'message' => 'Failed to save',
      'alert-type' => 'error'
    );
    return redirect('/addoffer')->with($notification);
  }
}

public function offerupdateqry(Request $request)
{
  $off_id = $request->input('off_id');
  $offerprice = $request->input('offerprice');
  $update = offer::where('offer_id','=',$off_id)->update(['offer_price'=>$offerprice]);
  if($update == true)
  {
    $notification = array(
      'message' => 'Offer Price Updated',
      'alert-type' => 'success'
    );
    return redirect('/offer')->with($notification);
  }
  else
  {
    $notification = array(
      'message' => 'Failed to save',
      'alert-type' => 'error'
    );
    return redirect('/addoffer')->with($notification);
  }
}

public function deloffer($oid)
{
  $delete = offer::where('offer_id','=',$oid)->delete();
  if($delete == true)
  {
    $notification = array(
        'message' => 'Offer Deleted',
        'alert-type' => 'success'
    );
    return redirect('/offer')->with($notification);
  }
  else
  {
    $notification = array(
        'message' => 'Opps Some Error Occured',
        'alert-type' => 'error'
    );
    return redirect('/offer')->with($notification);
  }
}

public function cust_action($uid,$status)
{
  if($status == 'block')
  {
    $update = users::where('user_id','=',$uid)->update(['ustatus'=>'0']);
    return redirect('/customers');
  }
  elseif ($status == 'unblock')
  {
    $update = users::where('user_id','=',$uid)->update(['ustatus'=>'1']);
    return redirect('/customers');
  }
}

public function inserimageqry(Request $req)
{
  try
  {
    $imagename = $req->input('imagename');
    $file = $req->file('image');
    $iiname = date('mdYHis') . uniqid() . $file->getClientOriginalName();

    $img = new images();

    $img->image_name = $imagename;
    $img->img_url = $iiname;
    if($img->save())
    {
      $destinationPath = 'itemimage';
      $file->move($destinationPath, $iiname);
      return redirect('/image')->with('message','data saved');

    }else
    {
      return redirect('/addimag')->with('error', 'failed to save');

    }
  }
  catch (\Exception $e)
  {
      return $e->getMessage();
  }
}

public function deleteimage($im_id,$iurl)
{
  $image = images::where('im_id','=',$im_id)->value('img_url');
  $delete = images::where('im_id','=',$im_id)->delete();
  if($delete==true)
  {
    // Delete Image From Folder
    $filename = 'itemimage/'.$image;
    \File::delete($filename);
    $notification = array(
        'message' => 'Deleted successfully',
        'alert-type' => 'success'
    );
    return redirect('image')->with($notification);
  }
  else
  {
    $notification = array(
      'message' => 'Error Occured',
      'alert-type' => 'error'
    );
    return redirect('image')->with($notification);
  }
}

public function cancelorder($oid,$uid)
{
  $orderdel = order::where('order_id','=',$oid)->where('user_id','=',$uid)->update(['u_status'=>'Canceled','paid_status'=>'Canceled']);
  if($orderdel==true)
  {
    $data = cart::where('order_id','=',$oid)->where('c_status','=','1')->get();
    $array = json_decode($data,true);
    foreach($array as $value)
    {
      $deletecart = cart::where('order_id','=',$oid)->where('c_status','=','1')->update(['c_status'=>'Canceled']);
      $chkwgt = itemDetails::where('item_detail_id','=',$value['item_detail_id'])->value('netWeight');
      if($chkwgt == 'Grams')
      {
          $nw = itemDetails::where('item_detail_id','=',$value['item_detail_id'])->value('item_weight');
          $gr = $value['cart_qty'] / 1000;
          $total_gram = $gr;
          $supdate = items::where('item_id','=',$value['item_id'])->increment('item_qty', $total_gram);
      }
      else
      {
          $supdate = items::where('item_id','=',$value['item_id'])->increment('item_qty', $value['cart_qty']);
      }
      // $supdate = items::where('item_id','=',$value['item_id'])->increment('item_qty', $value['cart_qty']);
    }
    return redirect('orders')->with('message','Order Canceled');
  }
  else
  {
    return redirect('orders')->with('error','failed to cancel');
  }
}

public function cartamtary(Request $request)
{
  $amount = $request->input('amount');
  $cart = new cartamount();
  $cart->minimum_amount = $amount;
  if($cart->save())
  {
    $notification = array(
        'message' => 'Added successfully',
        'alert-type' => 'success'
    );
    return redirect('cartAmount')->with($notification);
  }
  else
  {
    $notification = array(
      'message' => 'Error Occured',
      'alert-type' => 'error'
    );
    return redirect('cartAmount')->with($notification);
  }
}

public function updatecartamtary(Request $request)
{
  $camt_id = $request->input('camt_id');
  $amount = $request->input('amount');
  $update = cartamount::where('cart_min_id','=',$camt_id)->update(['minimum_amount'=>$amount]);
  if($update == true)
  {
     $notification = array(
      'message' => 'Amount Updated',
      'alert-type' => 'success'
    );
    return redirect('cartAmount')->with($notification);
  }
  else
  {
    $notification = array(
      'message' => 'Error Occured',
      'alert-type' => 'error'
    );
    return redirect('cartAmount')->with($notification);
  }
}





}
