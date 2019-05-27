<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Repositories\Repository;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Support\Facades\Response;

class ContactController extends Controller
{
    protected $ContactModel;

    public function __construct(Contact $ContactModel)
    {
        $this->ContactModel = new Repository($ContactModel);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Contacts = $this->ContactModel->all();

        return view('admin.contact_list', compact('Contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Contact = Contact::findOrFail($id);

        return response($Contact, 200);
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

       $this->ContactModel->delete($id);
    }

    public function getAllData()
    {
        $Contact = Contact::get();

        return datatables($Contact)->make(true);
    }
}
