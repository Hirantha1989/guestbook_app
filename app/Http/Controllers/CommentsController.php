<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Comment;
use DataTables;
use Session;

class CommentsController extends Controller
{
    public function index(){
        $comments = Comment::where('status', 'ACCEPTED')
            ->get();
        return view('welcome')->with('comments',$comments);
    }

    public function getComments(){

        $comments = Comment::where('status', 'ACCEPTED')
            ->get();

        $html = '<br>';

        foreach ($comments as $comment){
            $btnId = "btn_".$comment->id;
            $html .= '<h5>'. $comment->name .'</h5>';
            $html .= '<p>'. $comment->message .'</p>';
            $html .= '<button type="button" id="'.$btnId.'" data-name="'.$comment->name.'" data-message="'.$comment->message.'" onclick="shareOnFb('.$comment->id.')" class="inlineBlock _2tga _89n_ _8j9v"><span class="_8f1i"></span><div class=""><span class="_3jn- inlineBlock _2v7"><span class="_3jn_"></span><span class="_49vg _8a19"><img class="img" style="vertical-align:middle" src="https://www.facebook.com/rsrc.php/v3/yr/r/zSKZHMh8mXU.png" alt="" width="12" height="12"></span></span><span class="_49vh _2pi7"> Share</span></div></button>';
            $html .= '<hr>';
        }

        return response()->json([
            "status" => "success",
            "message" => '',
            'data' => $html
        ], 200);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:5',
        ]);

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->message = $request->message;
        $comment->save();

        Session::flash('message', 'Your message is in under moderation..!');

        return redirect('/');
    }
}
