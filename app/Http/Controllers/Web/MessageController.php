<?php

namespace App\Http\Controllers\Web;

use App\Model\Core\Message;

use App\Events\NewMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Traits\Web\MessageRequestTrait;

//controlador usado para las notificaciones de usuario
class MessageController extends Controller
{

    use MessageRequestTrait;

    public function __construct()
    {               
        $this->middleware('auth', ['except' => ['request','requestStore']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('message.create')
        ->with(['token' => $request->input('_token'),                
                //'success'=> [['editPasswordNOOK']]
                ])
        ->with('data',['options'=>Auth::user()->rol_options_dashboard()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        //validamos los datos
        if(!Auth::user()->validateUserStore(\Auth::user()->rel_store_id)){
            return 
            view('table.create',compact('table'))
            ->with('danger', [['NOOK']])->with('data', []);
        }
        if ($this->validator($request->all())->fails()) {
            return Redirect::back()->withErrors($this->validator($request->all()))->withInput();
        }

        $message = new Message();          
        $message->issue = $request->input('issue');
        $message->body = $request->input('body');
        $message->rel_store_id = \Auth::user()->rel_store_id;        
        $message->save();

        //guardamos el mensaje

        //enviamos la notificación, para los agentes
        if(Auth::user()->rol_id == 3){
            broadcast(new NewMessage(auth()->user(),$message))->toOthers();
        }

        $message = Message::find($message->id);  
        $message->delete();       

        return view('message.create')
        ->with(['token' => $request->input('_token'),                
                'success'=> [['messageaSendOK']]
                ])
        ->with('data',['options'=>Auth::user()->rol_options_dashboard()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $Message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $Message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $Message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $Message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $Message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $Message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $Message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $Message)
    {
        //
    }
    

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'issue' => '
                required|
                string|',
            'body' => '
                required|
                string',            
        ]);
    }
}
