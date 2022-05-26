<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Customer;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;

class CustomerController extends Controller
{


    public function __construct()
    {
       if(env('MULTILEVEL_CUSTOMER_REGISTER') != true){
        abort(404);
       }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->src) {
            $posts=Customer::where('created_by',Auth::id())->where($request->type,'LIKE','%'.$request->src.'%')->latest()->paginate(50);
        }
       else{
         $posts=Customer::where('created_by',Auth::id())->withCount('orders')->orderBy('orders_count','DESC')->latest()->paginate(20);
       }

       $src=$request->src ?? '';

        return view('seller.customer.index',compact('posts','src'));
    }
//    EXPORT & IMPORT
    public function export()
    {
        return Excel::download(new UsersExport(), 'Customers-'.now().'.xlsx');
    }
    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = $file->hashName();
        $path = $file->storeAs('public/excel/',$nama_file);
        $import = Excel::import(new UsersImport(), storage_path('app/public/excel/'.$nama_file));
        Storage::delete($path);
        if($import) {
            return redirect()->back()->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Diimport!']);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.customer.create');
    }

    public function user(Request $request)
    {
      $user=Customer::where('created_by',Auth::id())->where('email',$request->email)->first();

      if (!empty($user)) {
        return $user->id;
      }
      else{
        return response()->json('Customer Not Found',404);
      }
    }

    public function login($id){
     $user=Customer::where('created_by',Auth::id())->findorFail($id);
     Auth::logout();
     Auth::guard('customer')->loginUsingId($user->id);

     return redirect('/user/dashboard');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//       $limit=user_limit();
//        $posts_count=Customer::where('created_by',Auth::id())->count();
//         if ($limit['customer_limit'] <= $posts_count) {
//
//         $error['errors']['error']='Maximum customers limit exceeded';
//         return response()->json($error,401);
//        }


       $validatedData = $request->validate([
        'email' => 'required|email|unique:users,email|max:50',
        'name' => 'required|max:20',
        'password' => 'required|min:6',
       ]);


       $check=Customer::where([['created_by',Auth::id()],['email',$request->email]])->first();
       if(!empty($check)){
         $error['errors']['error']='Email already exists';
         return response()->json($error,401);
       }
       $data=Auth::user();
       $user= new Customer;
       $user->name = $request->name;
       $user->email = $request->email;
       $user->created_by = $data->id;
       $user->domain_id = $data->domain_id;
       $user->password = Hash::make($request->password);
       $user->save();

       return response()->json(['User Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $info=Customer::where('created_by',Auth::id())->withCount('orders','orders_complete','orders_processing')->findorFail($id);
       $earnings=\App\Order::where('customer_id',$id)->where('payment_status',1)->sum('total');
       $orders=\App\Order::where('customer_id',$id)->with('payment_method')->withCount('order_item')->latest()->paginate(20);
       $returm_item =DB::table('orders')
           ->join('returnitems', 'orders.id', 'returnitems.order_id')
           ->join('terms', 'returnitems.term_id', 'terms.id')
           ->where('customer_id',$id)
           ->groupBy('returnitems.id')
           ->get();
//       return $returm_item;
       return view('seller.customer.show',compact('info','earnings','orders', 'returm_item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $info=Customer::where('created_by',Auth::id())->findorFail($id);
       return view('seller.customer.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
        'email' => 'required|max:50|email|unique:customers,email,' . $id,
        'name' => 'required|max:20',

       ]);

        if ($request->change_password) {
          $validatedData = $request->validate([
            'password' => 'required|min:6',
          ]);
        }
       $user=  Customer::where('created_by',Auth::id())->findorFail($id);
       $user->name = $request->name;
       $user->email = $request->email;
       if ($request->change_password) {
          $user->password = Hash::make($request->password);
       }

       $user->save();

       return response()->json(['User Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {


         if ($request->type=='delete') {
            $auth_id=Auth::id();
            foreach ($request->ids as $key => $id) {
                $user=  Customer::where('created_by',$auth_id)->findorFail($id);
                $user->delete();
            }
            return response()->json(['Customer Deleted']);
        }


    }
}
