<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToppingRequest;
use App\Topping;
use App\Repositories\Repository;

class TopingController extends Controller
{
    protected $toppingModel;

    public function __construct(Topping $toppingModel)
    {
        $this->toppingModel = new Repository($toppingModel);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.topping_list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToppingRequest $request)
    {
        $this->toppingModel->create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ToppingRequest $request, $id)
    {
        if (Auth::user()->role_id == 2) {
            return Response::json(__('You are not admin'), 403);
        }
        $this->toppingModel->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ], $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->role_id == 2) {
            return Response::json(__('You are not admin'), 403);
        }
        $this->toppingModel->delete($id);
    }

    public function getDataJson()
    {
        $toppings = $this->toppingModel->all();

        return datatables($toppings)->make(true);
    }
}
