<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreMessageRequest;
use App\Model\Message;
use App\Model\Subscriber;
use Illuminate\Support\Arr;

class MessageController extends Controller
{
    public function question()
    {
        return view('web.modal.question');
    }

    public function course(Request $request)
    {
        $course = $request->input('course');

        return view('web.modal.course', ['course' => $course]);
    }

    public function store(StoreMessageRequest $request)
    {
        $data = $request->validated();
        
        $subscribed = (bool)$data['newsletter'];
        $message_data = Arr::only($data, ['type', 'email', 'phone', 'name', 'course', 'message']);
        $subscriber_data = Arr::only($data, ['email']);

        $message = Message::create($message_data);

        if($subscribed === true) {
            $subscriber = Subscriber::where('email', '=', $subscriber_data['email'])->first();

            if($subscriber === null) {
                $subscriber = Subscriber::create($subscriber_data); 
            } 
        }

        $response = [];
        $response['system'] = ['code' => 200, 'message' => 'ok'];

        return response()->json($response);
    }
}
