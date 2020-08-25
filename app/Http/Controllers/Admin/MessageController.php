<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\DatatableInterface;
use App\Model\Message;
use App\Events\Message\Shown;

class MessageController extends Controller
{
    /**
     * Show list of messages
     * if request wants json, we show datatable response
     *
     * @param Illuminate\Http\Request $request
     *
     */
    public function index(Request $request)
    {

        if($request->wantsJson()) {
            $message = new Message();
            if($message instanceof DatatableInterface) {
                $list = $message->datatable($request);
                $list['system'] = ['code' => 200, 'message' => 'OK'];
                return response()->json($list);    
            }
        }

        return view('admin.message-index');
    }

    /**
     * Show detail of message
     *
     * @param Illuminate\Http\Request $request
     * @param string $id
     */
    public function show(Request $request, string $id)
    {
        $message = Message::find($id);

        event(new Shown($message));

        return view('admin.modal.message-show', ['message' => $message, 'id' => $id]);
    }
}
