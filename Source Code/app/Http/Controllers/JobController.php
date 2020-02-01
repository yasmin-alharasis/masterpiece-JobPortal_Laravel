<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Company;
use App\Category;
use App\Http\Requests\JobPostRequest;
use Auth;
use App\User;
use App\Post;

class JobController extends Controller
{   
    public function __construct(){
        $this->middleware(['employer'],['except'=>array('index','show','apply','allJobs')]);
    }

    public function index(){
        $jobs=Job::latest()->limit(10)->where('status',1)->get();
        $companies = Company::latest()->limit(12)->get();
        $posts = Post::where('status',1)->get();
        $categories = Category::with('jobs')->get();
        return view('welcome',compact('jobs','companies','categories','posts'));
    }

    public function show($id,Job $job){
        //dd($job);
        //$job=Job::find($id);
        return view('jobs.show',compact('job'));
    }

    public function company(){
        return view('company.index');
    }

    public function create(){
        return view('jobs.create');
    }

    public function store(JobPostRequest $request){
    
        $user_id = auth()->user()->id;
        $company = Company::where('user_id',$user_id)->first();
        $company_id = $company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title' => request('title'),
            'slug' => str_slug(request('title')),
            'description' => request('description'),
            'roles' => request('roles'),
            'category_id' => request('category'),
            'position' => request('position'),
            'address' => request('address'),
            'type' => request('type'),
            'status' => request('status'),
            'last_date' => request('last_date'),
            'experience' =>request('experience'),
            'salary' =>request('salary'),

        ]);
        return redirect()->back()->with('message','Job posted successfully!');
    }

    
    public function myjob(){
        $jobs = Job::where('user_id',auth()->user()->id)->get();
        return view('jobs.myjob',compact('jobs'));
    }

    public function edit($id){
        $job = Job::findOrFail($id);
        return view('jobs.edit',compact('job'));
    }
    public function update(JobPostRequest $request,$id){
        $job = Job::findOrFail($id);
        $job->update($request->all());
        return redirect()->back()->with('message','Job Sucessfully Updated!');

    }

    
    public function apply(Request $request,$id){
        $jobId = Job::find($id);
        $jobId->users()->attach(Auth::user()->id);
        return redirect()->back()->with('message','Application sent!');

    }

    public function applicant(){
        $applicants = Job::has('users')->where('user_id',auth()->user()->id)->get();
        return view('jobs.applicants',compact('applicants'));
    }

    public function allJobs(Request $request){

        $search = $request->get('search');
        $address1 = $request->get('address1');
        if($search && $address1 ){
            $jobs = Job::where('position','LIKE','%'.$search.'%')
                ->orWhere('type','LIKE','%'.$search.'%')
                ->orWhere('title','LIKE','%'.$search.'%')
                ->orWhere('address','LIKE','%'.$address1.'%')
                ->paginate(10);
            return view('jobs.alljobs',compact('jobs'));
            
        }

        $keyword = $request->get('position');
        $type = $request->get('type');
        $category = $request->get('category_id');
        $address = $request->get('address');

        if($keyword||$type||$category||$address){
            $jobs = Job::where('position','LIKE','%'.$keyword.'%')
                        ->orWhere('type',$type)
                        ->orWhere('category_id',$category)
                        ->orWhere('address',$address)
                        ->paginate(10);
                        return view('jobs.alljobs',compact('jobs'));
        }else{
            $jobs = Job::latest()->paginate(10);
            return view('jobs.alljobs',compact('jobs'));
        }
    }

    
    
}
