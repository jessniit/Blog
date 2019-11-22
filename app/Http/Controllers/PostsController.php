<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
Use DB;
use Prophecy\Exception\Doubler\ReturnByReferenceException;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts=Post::all();
        //$posts=Post::orderBy('created_at','ASC')->get();
        $posts=Post::orderBy('created_at','DESC')->paginate(5);
       
        // $posts=Post::where('active',1)
        // ->orderBy('name','desc')
        //->take(2);
        // ->get();
        //$posts=DB::select('select * from posts');
          return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request,[
            'ttl'=>'required',
            'bdy'=>'required',
            'cover_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            
         
 if($request->hasFile('cover_image'))
 {
//get complete file name with extension
    $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
    
    //get file name
$filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
//get extension
$extension=$request->file('cover_image')->getClientOriginalExtension();
//filename to store if multiple file has same name
$fileNameToStore=$filename.'_'.time().'.'.$extension;
//upload image
//1.store img to db,uplod img to folder in hardisk(public/storage/cover_imges)
   //$path=$request->file('cover_image')->storeAs("public/cover_images",$fileNameToStore);
Storage::disk('s3')->put($fileNameToStore,fopen($request->file('cover_image'),'r+'),'public');
// return " ".$extension." ".$filename." ".$fileNameToStore  ;
}
else{
    $fileNameToStore='noimage.jpg';
}

    $p=new Post();
    $p->title=$request->input('ttl');
    $p->body=$request->input('bdy');
    $p->user_id=auth()->user()->id;
    $p->cover_image=$fileNameToStore;
    $p->save();
    //
    
    return redirect('/dashboard')->with('success','New Post Created Successfully');
    // return redirect('/posts')->with('success','Post Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $post= Post::find($id);
    $path="https://blogpicturesbucket.s3.ap-south-1.amazonaws.com";
    $data=array("post"=>$post,"path"=>$path);
        return view('posts.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
       if(auth()->user()->id!==$post->user_id)
        {
    return redirect('/posts')->with('error','unauthorised page');
        }
        return view('posts.edit')->with('post',$post);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'ettl'=>'required',
            'ebdy'=>'required',
            'cover_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
    $p=Post::find($id);
    $p->title=$request->input('ettl');
    $p->body=$request->input('ebdy');
    if($request->hasFile('cover_image'))
 {
    $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
   $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
$extension=$request->file('cover_image')->getClientOriginalExtension();
$fileNameToStore=$filename.'_'.time().'.'.$extension;
//$path=$request->file('cover_image')->storeAs("public/cover_images",$fileNameToStore);
Storage::disk('s3')->put($fileNameToStore,fopen($request->file('cover_image'),'r+'),'public');
}
else{
    $fileNameToStore='noimage.jpg';
    }
$p->cover_image=$fileNameToStore;
    $p->save();
    return redirect('/dashboard')->with('success','Post Updated Successfully');
    // return redirect('/posts')->with('success','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);

        if(auth()->user()->id!==$post->user_id)
        {
    return redirect('/posts')->with('error','unauthorised page');
        }
        $post->delete();
        return redirect('/dashboard')->with('success','Post deleted successfully');
    }
}
