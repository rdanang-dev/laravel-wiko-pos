<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{

    public function index()
    {
        $getAllOrder = Order::orderBy('created_at', 'desc')->get();

        return response()->json($getAllOrder);
    }

    public function generateOrderCode(int $number){
        $padNumber = str_pad($number,4,'0',STR_PAD_LEFT);
        $orderCode = "ORD-".Carbon::now()->format('Ymd').'-'.$padNumber;
        return $orderCode;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($this->generateOrderCode(1));
            $orderNumber = 1;
            $dateNow = Carbon::now()->toDateString();
            // dd($dateNow);
            $getOrderNumber = Order::whereDate('created_at','2021-03-11 00:00:00')->max('order_number');
            // $getOrderNumber = Order::whereDate('created_at',$dateNow)->max('order_number');
            // dd($getOrderNumber);

            // dd($getOrderNumber);
            if($getOrderNumber != null){
                $orderNumber = $getOrderNumber + 1;
            }

            $getAllMenu = Menu::get();

            /// Create New Order
            $createOrder = new Order();
            $createOrder->employee_id = auth()->id();
            $createOrder->order_code = $this->generateOrderCode($orderNumber);
            $createOrder->order_number = $orderNumber;
            $createOrder->customer_id = $request->customer_id ?? null;
            $createOrder->save();


            $orderDetails = $request->details;

            $totalPrice = 0;

            foreach($orderDetails as $data){
                $findMenu = $getAllMenu->where('id',$data['menu_id'])->first();
                // dd($findMenu);
                $createOrder->details()->create([
                    'menu_id' => $data['menu_id'],
                    'menu_data' => $findMenu,
                    'price' => $findMenu->harga,
                    'discount' => $data['discount'],
                    'qty' => $data['qty']
                ]);

                $totalPrice += $findMenu['price'] - $data['discount'];
            }

            DB::commit();
            return response()->json(['message' => 'success'],201);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();

        }




        // foreach($)

        // dd($createOrder);
        // $createOrder->not
        // $createOrder->order_code = ;

    }
}
