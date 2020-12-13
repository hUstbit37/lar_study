<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\QlVideo;
use App\User;
use App\Friend;

use Illuminate\Http\Request;

class VueController extends Controller
{

    public function home()
    {
        return view("VueVideo/HomeVue");
    }
    public function upload()
    {
        // dd(Auth::check());
    }
    public function sub(Request $request)
    {
        $check1 = Friend::where('user_id', $request->user_id)->where('friend_id', $request->friend_id)->first();
        if ($check1) {
            $a = Friend::where('user_id', $request->user_id)->where('friend_id', $request->friend_id)->delete();
            return response([
                'check' => true
            ]);
        } else {
            $b = Friend::firstOrCreate($request->all());
            return response([
                'check' => false
            ]);
        }
    }
    public function getSub(Request $request)
    {
        if (($request->id)) {
            $id = $request->id;
            $listVideoFriend = 1;
            $s = User::find($id)->friendsOfMine()->get();
        }
        // dd($s);
        $end = array();
        foreach ($s as $item) {
            $k = $item->pivot->friend_id;
            $q = User::find($k)->video()->get()->toArray();
            $end =  array_merge($end, $q);
        }
        arsort($end);
        // dd($end);
        $video_sub = (object) $end;

        return response([
            'listVideo' => $video_sub,

        ]);
    }
    public function listVideo(Request $request)
    {
        $h = null;
        $end = null;
        if ($request->id) {
            $h = User::find($request->id)->friendsOfMine()->get();
            // dd($h);
            $end = [];
            foreach ($h as $value) {
                $k = $value->id;
                $end =  array_merge($end, (array) $k);
            }
        }

        // $list = QlVideo::with('user')->paginate(4)->toArray();
        $list = QlVideo::with('user')->orderBy('created_at', 'desc')->get();
        // dd($list);
        return response([
            'listVideo' => $list,
            'friendListId' => $end
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
    public function testUpload(Request $request)
    {
        // dd($request->all());
        if ($request->file) {
            $thumbnail = $request->file->getClientOriginalName();
            $request->file->move(public_path('video/thumbnails'), $thumbnail);
        }
    }
}
