<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;
use Exception;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Show all the orders
        $pedidos = Pedidos::with('user')->get();

        return response()->json([
            'data' => $pedidos
        ],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //create a new order

        try{
            $request->validate([
                'producto' => 'required|string|max:255',
                'cantidad' => 'required|integer',
                'total' => 'required|numeric',
                'user_id' => 'required|exists:users,id'
            ]);

            $pedido = Pedidos::create([
                'producto' => $request->producto,
                'cantidad' => $request->cantidad,
                'total' => $request->total,
                'user_id' => $request->user_id
            ]);

            return response()->json([
                'data' => $pedido
            ],201);
            
        }catch(Exception $error){
            return response()->json([
                'error' => $error->getMessage()
            ],400);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update an order
        $pedido = Pedidos::findOrFail($id);

        $request->validate([
            'produto' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'total' => 'required|numeric'
        ]);

        $pedido->update($request->all());

        return response()->json([
            'message' => 'Order updated',  
            'data' => $pedido
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pedidos $pedidos)
    {
        //erase an order
        $pedido = Pedidos::findOrFail($id);

        $pedido->delete();

        return response()->json([
            'message' => 'Order deleted'
        ],200);
    }

    public function ordersByUser($id){
        //Show all the orders of a user
        $pedidos = Pedidos::where('user_id',$id)->get();

        return response()->json([
            'data' => $pedidos
        ],200);
    }

    public function OrdersInTotalRange($min,$max){
        //Show all the orders in a total range
        $pedidos = Pedidos::whereBetween('total',[$min,$max])->get();

        return response()->json([
            'data' => $pedidos
        ],200);
    }
    
    public function ordersWithUserDesc()
    {
        // Show all the orders with the user in descending order sorted by total
        $pedidos = Pedidos::with('user')->orderBy('total', 'desc')->get();
    
        return response()->json([
            'data' => $pedidos
        ], 200);
    }

    public function allOrdersTotal(){
        //Show the total of all the orders
        $total = Pedidos::sum('total');

        return response()->json([
            'Total' => $total
        ],200);
    }

    public function cheapestOrder()
    {
        // Show the cheapest order with only the user's name
        $pedido = Pedidos::with(['user' => function($query) {
            $query->select('id', 'name'); // Select only the id and name fields
        }])->orderBy('total', 'asc')->first();
    
        return response()->json([
            'data' => [
                'producto' => $pedido->producto,
                'cantidad' => $pedido->cantidad,
                'total' => $pedido->total,
                'user' => $pedido->user->name // Only include the user's name
            ]
        ], 200);
    }

    public function getOrdersGroupedByUser(){
        //Show the orders grouped by user
        $pedidos = Pedidos::with('user')
            ->select('user_id', 'producto', 'cantidad', 'total')
            ->get()
            ->groupBy('user_id');


        return response()->json([
            'data' => $pedidos
        ],200);
    }



}
