<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Session;
use Lang;
use Auth;
use View;
use Illuminate\Pagination\Paginator;
use App\Indicator;
use Mail;
use App\Mail\MessageNotify;
use Config;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['records'] = Message::all()->sortByDesc("id");

        return view('messages.index', $data);
    }

    public function contact_us(){
        return view('home.contact_us');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $input['ip'] = $request->ip();
        $input['location_api_result'] = MessageController::get_ip_geojson($request->ip());
        $record = Message::create($input);
        Mail::to($input['email'])->send(new MessageNotify('Thank you for contacting Indicators','Thank you for contacting us. We will get back to you soon.','reply_message'));

        Mail::to(Config::get('email'))->send(new MessageNotify('A new request for data has been submitted','A new request for data has been sent. Check the link : ' . url('messages/' . $record->id . '/edit'),'reply_message'));
        Mail::to('dus@pcbs.gov.ps')->send(new MessageNotify('A new request for data has been submitted','A new request for data has been sent. Check the link : ' . url('messages/' . $record->id . '/edit'),'reply_message'));

        Session::flash('flash_message', Lang::get('common.message_saved'));
        return back();
    }


    public function get_ip_geojson($ip)
    {

        $data = [];
        $url = 'http://api.ipstack.com/'.$ip . '?access_key=b362f7abb5bf181be9f5ff41a4af1d27&format=1';
        //$data = array('key1' => 'value1', 'key2' => 'value2');

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'GET'
                //,'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {
           null;
        }else{
            $data = $result;
        }
        return $data;
    }

    public function edit($id)
    {
        $data = [];
        $data['record']  = Message::find($id);
        $data['records'] = Message::all()->sortByDesc("id");

        return view('messages.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $input = $request->all();

        $record = Message::find($id);
        $record['user_reply_message'] = Auth::user()->id;
        $old_reply_message = $record['reply_message'];
        $record->update($input);

        if (strcmp(trim($old_reply_message), trim($input['reply_message'])) == 0){null;}else{
            if (!empty($input['reply_message'])){
                Mail::to($input['email'])->send(new MessageNotify('Thank you for your inquiry.',$input['reply_message'],'reply_message'));
            }
        }


        Session::flash('flash_message', Lang::get('common.updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::find($id)->delete();
        Session::flash('flash_message', Lang::get('common.updated'));
        return redirect('messages');
    }


}