<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\QlVideo;
use App\Comment;
use App\User;
use App\Test;
use Auth;
use App;

class MyController extends Controller
{
    // public function index()
    // {
    //     return view('Blade_templates/content');
    // }

    public function view_upload()
    {   
        
        $data=DB::table('ql_video')->where('id_user', Auth::user()->id)->get();
        $data3=User::find(Auth::user()->id);
        //  dd($data3->video);
        $comment_v=DB::table('comment')->get();
        if(empty($data))
        {
            Session::flash('noVideo', 'Bạn chưa có video nào');
        }
        else
        {
            return view('ViewUpload', compact('data'), compact('data3'));
        }
    }

    public function upload(Request $req)
    {
        if($req->hasFile('video_name'))
        {
            // $$req->validate($req, [
            //     'video_name'=>'mimetypes:video/ogg, video/mp4, video/webm'
            // ],[
            //     'video_name.mimetypes'=>'Chỉ chấp nhận video đuôi ogg, mp4, webm'
            // ]);
            $video=$req->file('video_name');
            $getvideo=$video->getClientOriginalName();
            $destinationPath = public_path('upload/video');
            // dd($getvideo);
            $video->move($destinationPath, $getvideo);
        }
        
        $k =DB::table('ql_video')->insert([
            'video_name'=> $getvideo,
            'id_user'=>Auth::user()->id
        ]);
        if ($k) {
            Session::flash('success', 'Thêm mới video thành công!');
        }else {                        
            Session::flash('error', 'Thêm thất bại!');
        }
        
        
        // $s=DB::table('ql_video')->where('id_user', Auth::user()->id)->get();
        $s=$getvideo;
        return view('testvideo', compact('s'));
        
            
    }
    
    public function listvideo()
    {
        //$data=DB::table('ql_video')->where('id_user', Auth::user()->id)->get();
        $data2=User::find(Auth::user()->id);
        return view('listvideo', compact('data', 'data2'));
    }

    public function watch($id, Request $req)
    {
        
        // $video_watch=DB::table('ql_video')->find($id);
        $video_watch=QlVideo::find($id);
        // $video_watch->comment()->with('user')->paginate(5);
        // dd($comment1);
        $comment=QlVideo::find($id)->comment()->orderBy('created_at', 'desc')->paginate(5);
        // dd($comment);

        return view('WatchVideo', compact('video_watch'),compact('comment') );
        
    }

    public function commentPagination($id, Request $req)
    {
        
        if($req ->ajax())
        {
            $page=$req->page;
            // dd($page);
            $start=($page-1)*5;
            $cmt_count=QlVideo::find($id)->comment()->count();
            // dd($cmt_number);
            $cmt=QlVideo::find($id)->comment()->orderBy('created_at', 'desc')->skip($start)->take(5)->get();
            $html= view('ShowCommentList', compact('cmt'))->render();
            return response([
                'html'=> $html,
                'cmt_count'=> $cmt_count,
                'cmt'=> $cmt
            ]);
        }
       
    }

    public function testwatch($id)
    {
        $dat=DB::table('ql_video')->find($id);
        return view('testwatch', compact('dat'));
    }

    public function test(){
        $um=App\Test::search('he')->get();
        dd($um);
    }

    // public function ajaxView()
    // {
    //     $data=DB::table('tests')->orderBy('created_at', 'desc')->paginate(4);
    //     return view('testajax', compact('data'));

    // }
    // public function ajaxPagination(Request $req)
    // {
        
    //     if($req -> ajax())
    //     {
    //         $data=DB::table('tests')->orderBy('created_at', 'desc')->paginate(4);
    //         return view('TestAjax_ShowCmt', compact('data'))->render();

    //     }
    // }

    // public function add(Request $req)
    // {
    //     if($req->ajax())
    //     {   
    //         $s=new Test();
    //         $s->content=$req->comment;
    //         $s->name='Duc';
    //         $s->save();
            
    //     }
    // }
    
}

