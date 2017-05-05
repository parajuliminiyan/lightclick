<?php

namespace App\Http\Controllers;

use App\comments;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    function home(){
        if(Auth::check()){
            $posts = Post::where(function($query){
               return $query->where('user_id',Auth::user()->id)
                   ->orWhereIn('user_id',Auth::user()->friends()->lists('id'));
            })->orderBy('created_at','desc')->paginate(10);

            return view('users.homee',['posts' => $posts]);
        }
//        $posts = Post::orderby('created_at','desc')->get();
        return view('users.homee');

    }
        function postCreatePost(Request $request)
        {
            if ($request->hasFile('image')) {
                $caption = $request['body'];
            $image = $request->file('image');
            $filename = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('post-photos/'), $filename);
            $ipost = new Post();
            $ipost->image = $filename;
                $ipost->caption = $caption;
                $message = 'There was an error';
                if ($request->user()->posts()->save($ipost) ) {
                    $message = 'Your photo was successfully posted ';
                }
                return redirect()->route('home')->with(['message' => $message]);
//            $ipost->save();

        }


                $this->validate($request, ['body' => 'required|max:1000']);
                $post = new Post();
                $post->body = $request['body'];
//                $ipost->image = $request['image'];
                $message = 'There was an error';
                if ($request->user()->posts()->save($post) ) {
                    $message = 'Your Post was successfully created ';
                }
                return redirect()->route('home')->with(['message' => $message]);
            }

        function getDeletePost(Request $request ,Post $post)
        {
    //            if(Auth::user() != $post->user){
    //                return redirect()->back();
    //            }

             $post->delete();
            if($post->delete() == true){
                return redirect()->route('home')->with(['message' => 'Successfully Deleted']);
            }else {
                return redirect()->route('home')->with(['message' => 'Something Went Wrong']);
            }


        }

        function editPost(Request $request){
            $this->validate($request,[
               'body' => 'required'
            ]);
            $post = Post::find($request['postId']);
            if(Auth::user() != $post->user){
                return redirect()->back();
            }
            $post->body = $request['body'];
            $post->update();
            return response()->json(['new_body' => $post->body],200);
        }

    function postcomments(Request $request,$post_id){
//        print_r(Auth::id());

        $post = Post::find($post_id);
        $user = Auth::id();
        $comment = new comments();
        $comment->body = $request->comment;
        $comment->user_id = $user;
        $comment->post()->associate($post);
//        $comment->user()->associate($user);
        $comment->save();
        $comment->user_id;

        return redirect()->back();
    }

    public function getLike($postId){
        $post = Post::find($postId);
        if(!$post){
            return redirect()->route('home');
        }

        if(!Auth::user()->isFriendsWith($post->user)){
            return redirect()->route('home');
        }

        if(Auth::user()->hasLikedPost($post)){
            return redirect()->back();
        }

        $like = $post->likes()->Create([]);
         Auth::user()->likes()->save($like);

        return redirect()->back();
    }

    function editcomment(Request $request,$id){
        $comment = Comments::find($id);
        $comment->body  = $request['comment'];
        $comment->update;
        return redirect()->back();
    }

}
