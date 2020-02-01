<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Job;

class DashboardController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(20);
        return view('admin.index',compact('posts'));
     }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required|min:3',
            'content'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png'
        ]);
        if($request->hasFile('image')){
            

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/image/',$filename);
            Post::create([
                'title'=>$title=$request->get('title'),
                'slug'=>str_slug($title),
                'content'=>$request->get('content'),
                'image'=>$filename,
                'status'=>$request->get('status')
            ]);
        }
        return redirect('/dashboard')->with('message','Post created successfully');
    }
    public function destroy(Request $request){
        $id = $request->get('id');
        $post = Post::find($id);
        $post->delete();
            return redirect()->back()->with('message','Post deleted successfully');
    }

    public function edit($id){
        $post = Post::find($id);
        return view('admin.edit',compact('post'));
    }

    public function update($id,Request $request){
        $this->validate($request,[
            'title'=>'required|min:3',
            'content'=>'required',
        ]);
        if($request->hasFile('image')){
   
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/image/',$filename);
            Post::where('id',$id)->update([
                'title'=>$title=$request->get('title'),
                'content'=>$request->get('content'),
                'image'=>$filename,
                'status'=>$request->get('status')
                
            ]);
        }
        return redirect()->back()->with('message','Post Updated successfully');

    }

    public function trash(){
        $posts = Post::onlyTrashed()->paginate(10);
        return view('admin.trash',compact('posts'));
    }

    public function restore($id){
        Post::onlyTrashed()->where('id',$id)->restore();
        return redirect()->back()->with('message','Post restored successfully');

    }
    public function show($id){
        $post = Post::find($id);
        return view('admin.read',compact('post'));
    }

    public function getAlljobs(){
        $jobs = Job::latest()->paginate(20);
        return view('admin.job',compact('jobs'));
    }
    
    public function changeJobStatus($id){
        $job = Job::find($id);
        $job->status = !$job->status;
        $job->save();
        return redirect()->back()->with('message','Status updated successfully');
    }

}
