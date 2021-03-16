<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $getAllOrder = Order::orderBy('created_at', 'desc')->get();
        return OrderResource::collection($getAllOrder);
    }

    public function generateOrderCode(int $number)
    {
        $padNumber = str_pad($number, 4, '0', STR_PAD_LEFT);
        $orderCode = "ORD-" . Carbon::now()->format('Ymd') . '-' . $padNumber;
        return $orderCode;
    }

    public function show($id)
    {
        $getOrder = Order::with('details')->find($id);

        return new OrderResource($getOrder);
    }

    // public function update($id){
    //     $findOrder = Order::find($id);
    //     $findOrder->details()->update
    // }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $getOrder = Order::find($id);

            if (!$getOrder) {
                return response()->json(['message' => 'Order Not Found'], 404);
            }
            // Update Customer
            $getOrder->customer_id = $request->customer_id;

            $totalPrice = 0;

            $getDetailsMenuIds = collect($request->details)->map(function ($data) {
                return $data['menu_id'];
            });

            // Remove
            OrderDetail::whereNotIn('menu_id', $getDetailsMenuIds)->delete();

            foreach ($request->details as $data) {

                $orderDetailData = [
                    'menu_id' => $data['menu_id'],
                    'price' => $data['price'],
                    'qty' => $data['qty'],

                ];
                $subTotal = $data['price'] * $data['qty'];
                $whereQuery = ['menu_id' => $data['menu_id'], "order_id" => $id];
                OrderDetail::updateOrCreate($whereQuery, $orderDetailData);
                // $getOrderDetail->menu_id = $data['menu_id'];
                // $getOrderDetail->price = $data['price'];
                // $getOrderDetail->qty = $data['qty'];
                // $getOrderDetail->save();
                $totalPrice += $subTotal;
            }
            $getOrder->total_price = $totalPrice;

            DB::commit();
            return response()->json(['message' => '']);
        } catch (\Throwable$th) {
            throw $th;
            DB::rollBack();
        }

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $orderNumber = 1;
            $dateNow = Carbon::now()->toDateString();

            $getOrderNumber = Order::whereDate('created_at', $dateNow)->max('order_number');

            if ($getOrderNumber != null) {
                $orderNumber = $getOrderNumber + 1;
            }

            $getAllMenu = Menu::get();

            /// Create New Order
            $createOrder = new Order();
            $createOrder->employee_id = auth()->id();
            $createOrder->order_code = $this->generateOrderCode($orderNumber);
            $createOrder->order_number = $orderNumber;
            $createOrder->customer_id = $request->customer_id ?? null;
            $createOrder->status = 1; // On Process
            $createOrder->save();

            $orderDetails = $request->details;

            $totalPrice = 0;

            if ($request->details) {

                foreach ($orderDetails as $data) {
                    // Find Menu
                    $findMenu = $getAllMenu->where('id', $data['menu_id'])->first();
                    // Create Order Detail
                    $createOrder->details()->create([
                        'menu_id' => $data['menu_id'],
                        'menu_data' => $findMenu,
                        'price' => $findMenu->harga,
                        'discount' => $data['discount'],
                        'qty' => $data['qty'],
                    ]);

                    $totalPrice += $findMenu['price'] - $data['discount'];
                }

            }

            DB::commit();
            return response()->json(['message' => 'success'], 201);
        } catch (\Throwable$th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function sumqty($id)
    {
        $data = Menu::findOrFail($id);
        $totalharga = 0;
        $totalharga = $data->harga * request()->qty;
        return response()->json($totalharga);
    }
}
