<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\NewMessageNotification;
use App\Http\Requests\Message\MessageStoreRequest;
use Illuminate\Support\Facades\Auth;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageStoreRequest $request)
    {
        try{
            $m = new Message();
            $m->from = Auth::User()->id;
            $m->to = $request->to;
            $m->message = $request->message;
         //   $m->save();

            event(new NewMessageNotification($m));

            return response()->json([
                'status' => true,
                'data' => $m
            ]);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => false
            ],500);
        }
    }

    public function show($id)
    {
        try{ 
            return response()->json([
                'data' => Message::byUser($id)->get(),
                'status' => true
            ]);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => false
            ],500);
        }  
    }
}
