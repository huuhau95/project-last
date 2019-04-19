<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Size;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SizeController extends Controller
{
    protected $sizeModel;

    public function __construct(Size $sizeModel)
    {
        $this->sizeModel = new Repository($sizeModel);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.size_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeRequest $request)
    {
        $this->sizeModel->create([
            'name' => $request->name,
            'percent' => $request->percent,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SizeRequest $request, $id)
    {
        if (Auth::user()->role_id == 2) {
            return Response::json(__('You are not admin'), 403);
        }
        $this->sizeModel->update([
            'name' => $request->name,
            'percent' => $request->percent,
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
        $this->sizeModel->delete($id);
    }

    public function getDataJson()
    {
        $sizes = $this->sizeModel->all();

        return datatables($sizes)->make(true);
    }
}
