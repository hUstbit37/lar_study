<?php

namespace App\Http\Controllers;

use App\Comment;
use App\QlVideo;
use Auth;
use Illuminate\Http\Request;

class VueController extends Controller
{
    public function home()
    {
        return view("VueVideo/HomeVue");
    }
    public function listVideo()
    {
        $list = QlVideo::with('user')->get();
        // dd($list);
        return response([
            'listVideo' => $list,
        ]);
    }
    public function addCmt(Request $request, $id)
    {
        $unitCmt = new Comment();
        $unitCmt->comment_content = $request->comment_content;
        $unitCmt->id_video = $request->id_video;
        $unitCmt->id_user = Auth::user()->id;
        $unitCmt->save();
        return response([
            'mess' => 'Success',
            'unitCmt' => $unitCmt,
            'nameUserCmt' => Auth::user()->name,
        ]);
    }
    public function commentPaganationVue(Request $request)
    {
        $page = $request->page;
        $id = $request->id;
        $start = ($page - 1) * 4;
        $cmt_count = QlVideo::find($id)->comment()->count();
        $cmt = QlVideo::find($id)->comment()->orderBy('created_at', 'desc')->skip(0)->take($start)->get();

        return response([
            'message' => 'success',
            'cmt' => $cmt,
            'cmt_count' => $cmt_count,
        ]);
    }
}
