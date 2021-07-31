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

    public function index(Request $request)
    {
        $getAllOrder = Order::orderBy('created_at', 'desc');
        $status = 1;
        if ($request->status) {
            $status = $request->status;
            $getAllOrder = $getAllOrder->where('status', $status);
        }
        if ($request->filter) {
            $getAllOrder = $getAllOrder->where('order_code', 'like', "%$request->filter%");
        }
        if ($request->fromdate) {
            $fromdate = $request->fromdate;
            if ($request->fromdate && $request->todate) {
                $todate = Carbon::parse($request->todate)->addDay();
                $getAllOrder = $getAllOrder->whereBetween('created_at', [$fromdate . '%', $todate . '%']);
            } else {
                $getAllOrder = $getAllOrder->where('created_at', 'like', "$fromdate%");
            }
        }
        $getAllOrder = $getAllOrder->get();
        return OrderResource::collection($getAllOrder);
    }

    public function generateOrderCode(int $number)
    {
        $padNumber = str_pad(
            $number,
            4,
            '0',
            STR_PAD_LEFT
        );
        $orderCode = "ORD-" . Carbon::now()->format('Ymd') . '-' . $padNumber;
        return $orderCode;
    }

    public function show($id)
    {
        $getOrder = Order::with(['details', 'employee'])->find($id);
        return new OrderResource($getOrder);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $getOrder = Order::find($id);
            if (!$getOrder) {
                return response()->json(['message' => 'Order Not Found'], 404);
            }
            $totalPrice = 0;
            if ($request->has('checkout')) {
                $getOrder->status = 2;
            }
            $getDetailsMenuIds = collect($request->details)->map(function ($data) {
                return $data['menu_id'];
            });

            // Remove
            OrderDetail::where('order_id', $id)->whereNotIn('menu_id', $getDetailsMenuIds)->delete();

            $discountValue = request()->discount_value ?? 0;

            $getOrder->discount_percentage = request()->discount_percentage ?? 0;
            $getOrder->discount_value = $discountValue;

            foreach ($request->details as $data) {
                $orderDetailData = [
                    'menu_id' => $data['menu_id'],
                    'price' => $data['price'],
                    'qty' => $data['qty'],
                ];
                $subTotal = $data['price'] * $data['qty'];
                $whereQuery = ['menu_id' => $data['menu_id'], "order_id" => $id];
                OrderDetail::updateOrCreate($whereQuery, $orderDetailData);
                $totalPrice += $subTotal;
            }
            $getOrder->total_price = $totalPrice - $discountValue;
            $getOrder->cash = request()->cash;
            $getOrder->change = request()->cash - $getOrder->total_price;
            $getOrder->save();
            DB::commit();
            return response()->json(['message' => '']);
        } catch (\Throwable $th) {
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
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    public function getUnfinishedTransactionCount()
    {
        $getAllOrder = Order::where('status', '=', 1)->get()->count();
        return $getAllOrder;
    }
}