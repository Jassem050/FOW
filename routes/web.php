<?php
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;



use Carbon\Carbon;
use App\manager;
use App\Category;
use App\items;
use App\itemDetails;
use App\order;
use App\users;
use App\admin;
use App\images;
use App\offer;
use App\cart;
use App\cartamount;


Route::get('/', function () {
    $images = images::all();
    $items = items::all();
    return view('home',compact('images','items'));
});

Route::get('about',function(){
    return view('about');
});
Route::get('appabout',function(){
    return view('androidabout');
});


Route::get('FOWADMIN', function () {
    if(Session::get('empid'))
    {
      $timezone = 'ASIA/KOLKATA'; 
      $date = new \DateTime('now', new \DateTimeZone($timezone)); 
      $localdate = $date->format('Y-m-d');
      // $date = date('Y-m-d');

      $norder = order::where('u_status','=','1')
                ->get(); 
      $ncount = $norder->count(); 
      $items = items::where('i_status','=','1')->get();
      $itemcount = $items->count();
      $users = users::all();
      $usercount = $users->count(); 
      $profit = order::where('paid_status','=','Paid')
                    ->whereDate('updated_at','=',$localdate)
                    ->sum('total_amt');    
      $itemsold = order::where('order.paid_date','=',$localdate)
            ->join('cart','order.order_id','=','cart.order_id')
            ->join('items','cart.item_id','=','items.item_id')
            ->join('items_details','items.item_id','=','items_details.item_id')
            ->select('cart.item_id','items.item_id','items.iname','items_details.item_price',DB::raw('sum(cart.sub_total) AS total'),DB::raw('sum(cart.cart_qty) AS qty'),'order.paid_date')
            ->groupBy('cart.item_id','order.paid_date','items_details.item_detail_id')
            ->get();   
             $rbuyer = order::where('order.paid_date','=',$localdate)
                ->join('users','order.user_id','=','users.user_id')
                ->get();   
          $pbuyer = order::where('order.order_date','=',$localdate)
          ->join('users','order.user_id','=','users.user_id')
          ->get();                
      $paid = order::where('order.order_date','=',$localdate)
      ->where('order.paid_status','=','Paid')
      ->join('users','order.user_id','=','users.user_id')
      ->get();  
      $pcount = $paid->count();    
      $unpaid = order::where('order.order_date','=',$localdate)
      ->where('order.paid_status','=','Paid')
      ->join('users','order.user_id','=','users.user_id')
      ->get();  
      $ucount = $unpaid->count();        
      return view('Admin/dashboard',compact('ncount','itemcount','usercount','profit','itemsold','rbuyer','pbuyer','pcount','ucount'));
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('dashboard', function () {
    if(Session::get('empid'))
    {
      $timezone = 'ASIA/KOLKATA'; 
      $date = new \DateTime('now', new \DateTimeZone($timezone)); 
      $localdate = $date->format('Y-m-d');
      // $date = date('Y-m-d');

      $norder = order::where('u_status','=','1')
                ->get(); 
      $ncount = $norder->count(); 
      $items = items::where('i_status','=','1')->get();
      $itemcount = $items->count();
      $users = users::all();
      $usercount = $users->count(); 
      $profit = order::where('paid_status','=','Paid')
                    ->whereDate('updated_at','=',$localdate)
                    ->sum('total_amt');   
      
      $itemsold = order::where('order.paid_date','=',$localdate)
            ->join('cart','order.order_id','=','cart.order_id')
            ->join('items','cart.item_id','=','items.item_id')
            ->join('items_details','items.item_id','=','items_details.item_id')
            ->select('cart.item_id','items.item_id','items.iname','items_details.item_price',DB::raw('sum(cart.sub_total) AS total'),DB::raw('sum(cart.cart_qty) AS qty'),'order.paid_date')
            ->groupBy('cart.item_id','order.paid_date','items_details.item_detail_id')
            ->get();       
      $rbuyer = order::where('order.paid_date','=',$localdate)
                ->join('users','order.user_id','=','users.user_id')
                ->get();   
      $pbuyer = order::where('order.order_date','=',$localdate)
      ->join('users','order.user_id','=','users.user_id')
      ->get();   
      $paid = order::where('order.order_date','=',$localdate)
      ->where('order.paid_status','=','Paid')
      ->join('users','order.user_id','=','users.user_id')
      ->get();  
      $pcount = $paid->count();    
      $unpaid = order::where('order.order_date','=',$localdate)
      ->where('order.paid_status','=','Paid')
      ->join('users','order.user_id','=','users.user_id')
      ->get();  
      $ucount = $unpaid->count();        
      return view('Admin/dashboard',compact('ncount','itemcount','usercount','profit','itemsold','rbuyer','pbuyer','pcount','ucount'));
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('changepassword', function () {
    if(Session::get('empid'))
    {
      return view('Admin/changepass');
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('Category', function () {
  if(Session::get('empid'))
  {
    $cat = Category::all();
    return view('Admin/Category',compact('cat'));
  } 
  else
  {
    return view('Admin/login');
  }
});

Route::get('addcategory', function () {
  if(Session::get('empid'))
  {
    return view('Admin/addcategory');
  } 
  else
  {
    return view('Admin/login');
  }
});

Route::get('items', function () {
  if(Session::get('empid'))
  {
    $item= items::join('category','items.category_id','=','category.category_id')
                ->join('items_details','items.item_id','=','items_details.item_id')         
                ->select('items.*','category.*','items_details.*','items_details.item_id')
                ->groupBy('items_details.item_id','items_details.item_detail_id','items.item_id')
                ->get();                  
    return view('Admin/items',compact('item'));
  }
  else
  {
      return view('Admin/login');
  }
});

Route::get('additem', function () {
  if(Session::get('empid'))
  {
    $category = Category::all();
    return view('Admin/additem',compact('category'));
  }
  else
  {
      return view('Admin/login');
  }
});

Route::get('mnagers', function () {
    if(Session::get('empid'))
    {
      $manager= DB::table('manager')->get();
      return view('Admin/mnager',compact('manager'));
    }
    else
    {
        return view('Admin/login');
    }
    
});

Route::get('addmnager', function () {
    if(Session::get('empid'))
    {
      return view('Admin/addmanager');
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('offer', function () {
    if(Session::get('empid'))
    {
        $offer = offer::all();
      return view('Admin/offer',compact('offer'));
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('addoffer', function () {
    if(Session::get('empid'))
    {
      return view('Admin/addoffer');
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('customers', function () {
    if(Session::get('empid'))
    {
      $users = users::join('manager','manager.m_id','=','users.m_id')
                    ->select('manager.*','users.*')
                    ->get();  
      return view('Admin/customers',compact('users'));
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('itemsales',function(){
	if(Session::get('empid'))
	{
		  $timezone = 'ASIA/KOLKATA'; 
      $date = new \DateTime('now', new \DateTimeZone($timezone)); 
  		$localdate = $date->format('Y-m-d');
  		$itemsold = order::where('order.paid_date','=',$localdate)
              					->join('cart','order.order_id','=','cart.order_id')
              					->join('items','cart.item_id','=','items.item_id')
              					->select('cart.item_id','items.item_id','items.iname','items.item_price',DB::raw('sum(cart.sub_total) AS total'),DB::raw('sum(cart.cart_qty) AS qty'),'order.paid_date')
              					->groupBy('cart.item_id','order.paid_date')
              					->get();
		return view('Admin/itemsales',compact('itemsold'));
	}
	else
    {
        return view('Admin/login');
    }
});

Route::get('orders', function () {
    if(Session::get('empid'))
    {
      $ordr = order::where('order.u_status','=','1')
                ->join('users','users.user_id','=','order.user_id')
                ->join('manager','manager.m_id','=','users.m_id')
                ->select('order.*','users.*','manager.*')
                ->get();
     return view('Admin/order',compact('ordr'));
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('previousorders', function () {
    if(Session::get('empid'))
    {
      $ordr = order::where('order.u_status','=','2')
                ->where('order.paid_status','=','Paid')
                ->join('users','users.user_id','=','order.user_id')
                ->select('order.*','users.*')
                ->get();
     return view('Admin/previousorders',compact('ordr'));
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('CanceledOrders', function () {
    if(Session::get('empid'))
    {
      $ordr = order::where('order.u_status','=','Canceled')
                ->where('order.paid_status','=','Canceled')
                ->join('users','users.user_id','=','order.user_id')
                ->select('order.*','users.*')
                ->get();
     return view('Admin/CanceledOrders',compact('ordr'));
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('image', function () {
    if(Session::get('empid'))
    {
      $img = DB::table('images')->get();
      return view('Admin/images',compact('img'));
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('addimage', function () {
    if(Session::get('empid'))
    {
      return view('Admin/addimage');
    }
    else
    {
        return view('Admin/login');
    }
});

Route::get('cartAmount', function () {
  if(Session::get('empid'))
  {
    $amt = cartamount::get();
    return view('Admin/cartAmount',compact('amt'));
  }
  else
  {
    return view('Admin/login');
  }
});

Route::get('randnumber', function () {
   $number = mt_rand(1000000000, 9999999999);
   $fow = 'FOW';
   return $fow.$number;
});

Route::post('adminlog','AdminController@adminlogin');
Route::get('alogout','AdminController@alogout');
Route::post('insertmanagerqry','AdminController@addmanager');
Route::post('addcategoryqry','AdminController@addcategoryqry');
Route::get('categorystatus/{cid}/{status}','AdminController@categorystatus');
Route::post('updatecategory','AdminController@updatecategory');
Route::post('updatecategorypic','AdminController@updatecategorypic');
Route::post('insertitemsqry','AdminController@additems');
Route::get('delmanager/{id}','AdminController@deletemanager');
Route::get('edmanager/{mid}','AdminController@editmanager');
Route::post('updatemanager','AdminController@updatemnager');
Route::post('adminchngpass','AdminController@adminchngpass');
Route::get('actmnger/{mid}','AdminController@activemanager');
Route::get('dctmnger/{mid}','AdminController@deactivemanager');
Route::get('edititems/{iid}','AdminController@edititems');
Route::get('itemDetails/{iid}','AdminController@itemDetails');
Route::post('updateitemqry','AdminController@updateitems');
Route::get('deleteitems/{iid}','AdminController@deleteitems');
Route::get('activeitemsqry/{iid}','AdminController@activeitems');
Route::get('deactiveitemsqry/{iid}','AdminController@deactiveitems');
Route::post('inserimageqry','AdminController@inserimageqry');
Route::get('deleteimage/{im_id}/{iurl}','AdminController@deleteimage');
Route::get('customerorderitems/{id}/{uid}','AdminController@customerorderitems');
Route::get('porderitems/{id}/{uid}','AdminController@porderitems');
Route::get('ordercancelitems/{id}/{uid}','AdminController@ordercancelitems');
Route::get('orderpaid/{oid}','AdminController@orderpaid');
Route::get('mnagercustomers/{mid}','AdminController@mnagercustomers');
Route::post('offerqry','AdminController@offerqry');
Route::post('offerupdateqry','AdminController@offerupdateqry');
Route::get('deloffer/{oid}','AdminController@deloffer');
Route::get('cust_action/{uid}/{status}','AdminController@cust_action');
Route::post('updateitempic','AdminController@updateitempic');
Route::get('updatestock/{iid}','AdminController@updatestock');
Route::post('stockupdateqry','AdminController@stockupdateqry');
Route::get('cancelorder/{oid}/{uid}','AdminController@cancelorder');
Route::post('cartamtary','AdminController@cartamtary');
Route::post('updatecartamtary','AdminController@updatecartamtary');