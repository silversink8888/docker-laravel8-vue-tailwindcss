<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Blog;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // dd(Blog::all());
        return Inertia::render('Blog/Index',['blogs' => Blog::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Blog/Create');
//        return Inertia::render('Blog/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $input = $request->all();
    
        Validator::make($input, [
            'title'   => ['required' , 'string' , 'min:5', 'max:30'],
            'content' => ['required' , 'string' , 'min:5', 'max:50']
        ])->validate();
    
        Blog::create($input);
    
        return Redirect::route('blog.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
        return Inertia::render('Blog/Edit',['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $input = $request->all();

        Validator::make($input, [
            'title'   => ['required' , 'string' , 'min:5', 'max:30'],
            'content' => ['required' , 'string' , 'min:5', 'max:50']
        ])->validate();

        $blog->update($input);
    
        return Redirect::route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Blog $blog)
    {
        $blog->delete();
    
        return Redirect::route('blog.index');
    }
    
}
