<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Revision;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function calculatorPost( Request $request){

        if($request->all()){

            $data = $request->all();

            $revision = new Revision;

            if (Auth::check()) {
                $revision->user_id = Auth::id();
            }else{
                $revision->user_id = null;
            }

            unset($data['_token']);
            
            $revision->data = json_encode($data['logArray']);
            $revision->logName = $data['logName'];
            $revision->save();

            if($revision){
                $response = array (
                    'code'=>100,
                );
                return $response;
            }
        }

    }

    public function calculatorGet(Request $request){
        if (Auth::check()) {

            $data = Revision::where('user_id', Auth::id())->pluck('logName','data');
            
            if($data){
                $response = array (
                    'code'=>100,
                    'data'=>$data
                );
                return json_encode($response);
            }
        }

        $response = array (
            'code'=>200,
        );
        return json_encode($response);
    }
}
