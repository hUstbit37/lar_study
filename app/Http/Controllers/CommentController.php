<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function post_comment($id, Request $req)
    {
        // $req->validate([
        //     'comment'=>'required|min:30'
        // ], [
        //     'comment.required'=>'Comment không để trống',
        //     'comment.min'=>'Comment tối thiểu 30 ký tự',
        // ]);
        // return response()->json(['message'=>'Done'], 200);
        
        if($req->ajax())
        {
            $s= new Comment();
            $s->comment_content=$req->comment;
            $s->id_video=$id;
            $s->id_user=Auth::user()->id;
            $s->save();

            $html=view('Test_ItemCmt', compact('s'))->render();
            return response([
                'html' => $html,
                'message' => 'Viet binh luan thanh cong'
                ]);
            // if($check){
            //     Session::flash('thongbao', 'Viet bl thanh cong');
            // }     
        }
    }
}
