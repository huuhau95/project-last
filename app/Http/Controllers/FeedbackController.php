<?php

namespace App\Http\Controllers;

use Cache;
use Redis;
use App\User;
use App\Product;
use App\Feedback;
use App\Mail\SendEmail;
use App\Events\FeedbackEvent;
use App\Repositories\Repository;

use Yajra\Datatables\Datatables;
use Pusher\Pusher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    protected $userModel;
    protected $productModel;
    protected $feedbackModel;

    public function __construct(Feedback $feedbackModel, User $userModel, Product $productModel)
    {
        // set the model
        $this->userModel = new Repository($userModel);
        $this->productModel = new Repository($productModel);
        $this->feedbackModel = new Repository($feedbackModel);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.feedback_list');
    }

    public function json()
    {
        // get all user but dont get current user
        // if (!Redis::get('feedback:all')) {
            // $name, $with from repository
            // $this->feedbackModel->setRedisAll('feedback:all', ['user', 'product']);
        // }

        // set true to return array
        // $data = json_decode(Redis::get('feedback:all'), true);
        $data = Feedback::all()->load(['user', 'product']);

        return datatables($data)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->product_id == '' || $request->content == '' && !Auth::check()) {
            abort(403);
        }

        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'user_avatar' => $user->image,
            'user_name' => $user->name,
            'product_id' => $request->product_id,
            'content' => $request->content,
            'status' => 0,
        ];

        // create feedback
        $feedback = $this->feedbackModel->create($data);
        // $this->feedbackModel->setRedisAll('feedback:all', ['user', 'product']);

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $d = [
            'id' => $feedback->id,
            'user_id' => $user->id,
            'user_avatar' => $user->image,
            'user_name' => $user->name,
            'product_id' => $request->product_id,
            'content' => $request->content,
            'status' => 0,
        ];

        try {
            $pusher->trigger(
                'FeedbackEvent',
                'send-feedback',
                $d
            );
        } catch (\Exception $e) {
            dd($e);
        }

        return $data;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function active(Feedback $feedback)
    {
        $data = $this->feedbackModel->update(
            [
                'status' => $feedback->status == 1 ? 0 : 1
            ],
            $feedback->id
        );

        // $name, $with
        // $this->feedbackModel->setRedisAll('feedback:all', ['user', 'product']);
        // $name, $id, $data
        // $this->feedbackModel->setRedisById('feedback:' . $feedback->id, Feedback::where('id', $feedback->id));

        $check = ($feedback->status == 1 ? 0 : 1);

        if ($check == 0) {
            return response()->json($feedback);
        }

        return 'actived';
    }
}
