<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Requests 
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->with(['user', 'likes'])->get();
        $categories = Category::all();
        
        $like = Like::all();
        $likes = $like->groupBy('post_id')->map->count();
        $max = $likes->max();

        $postLimit = Post::orderBy('created_at', 'DESC')->with(['user', 'likes'])->paginate(4);
       
        return view('blog.blog_posts', [
            'posts' => $posts,
            'categories' => $categories,
            'max' => $max,
            'postLimit' => $postLimit, 
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|integer',
            'cover_image' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        //handleFileUpload
        if ($request->hasFile('cover_image')) {
            //getFile
            $file = $request->file('cover_image')->getClientOriginalName();
            //getFileName
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            //getExt
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();
            //storeFileName
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            //uploadFile
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $post = $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'cover_image' => $fileNameToStore
        ]);


        // $post = $request->user()->posts()->create($request->only('title','body', 'cover_image'));

        if ($post != null) {
            return back()->with('status', 'Post Created Successfully');
        }
    }

    public function show($id)
    {
        $post = Post::find($id);

        //get maximum likes of post
        $like = Like::all();
        $likes = $like->groupBy('post_id')->map->count();
        $max = $likes->max();

        //limited post
        $postLimit = Post::orderBy('created_at', 'DESC')->with(['user', 'likes'])->paginate(4);

        return view('blog.show_post', [
            'post' => $post,
            'max' => $max,
            'postLimit' => $postLimit
        ]);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('blog.edit_post', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {

        $post = Post::find($id);

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|integer',
            'cover_image' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //handleFileUpload
        if ($request->hasFile('cover_image')) {
            //getFile
            $file = $request->file('cover_image')->getClientOriginalName();
            //getFileName
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            //getExt
            $fileExt = $request->file('cover_image')->getClientOriginalExtension();
            //storeFileName
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            //uploadFile
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        


        $post = $request->user()->posts()->where('id', '=', $id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'cover_image' => $request->hasFile('cover_image') ? $fileNameToStore : $post->cover_image 
        ]);

        if ($post != null) {
            return back()->with('status', 'Post Updated Successfully');
        }


        // $post = $request->user()->posts()->create($request->only('title','body', 'cover_image'));

        
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post->ownedBy(auth()->user())) {
            return redirect('blog')->with('status', 'You Cannot Delete this Post');
        }

        if ($post->cover_image != 'noimage.jpg') {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return back()->with('status', 'Post Deleted Successfully');
    }

    public function userPosts()
    {
        $posts = Post::orderBy('created_at', 'DESC')->where('user_id', '=', Auth::user()->id)->get();
        return view('blog.list_posts', [
            'posts' => $posts
        ]);
    }
}
