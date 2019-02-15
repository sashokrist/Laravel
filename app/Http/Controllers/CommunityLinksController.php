<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;
use App\CommunityLink;
use Illuminate\Support\Facades\Input;
use Session;
use App\User;


class CommunityLinksController extends Controller
{
    public function index(){
        $links = CommunityLink::where('approved', 1)->paginate(25);
        $channels = Channel::all();
        return view('community.index', compact('links', 'channels'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'channel_id' => 'required|exists:channels,id',
           'title' => 'required',
           'link' => 'required|active_url|unique:community_links'
        ]);
        //CommunityLink::from(auth()->user())->contribute($request->all());

        $link = new CommunityLink();
        $user = auth()->user();
        if($user->isTrusted()){
            $link->approve();
        }
        $link->user_id = auth()->user()->id;
        $link->channel_id = Input::get('channel_id');
        $link->title = Input::get('title');
        $link->link = Input::get('link');
        $link->save();

        // redirect
        if($user->isTrusted()){
            $request->session()->flash('status', 'Link was added successful!');
        } else {
            $request->session()->flash('status', 'Link was added successful but it is not approve yed!');
        }

       // Session::flash('message', 'Successfully created link!');
        return back();
    }
}
