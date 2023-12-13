<?php

namespace App\Http\Controllers;

//import Model "blog
use App\Models\blog;

use Illuminate\Http\Request;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get blog
        $blog = blog::latest()->paginate(5);

        //render view with blog
        return view('blog.index', compact('blog'));
    }
    /**
     * create
     * 
     *  @return View
     * 
     */
    public function tampil(): View
    {
        //get blog
        $blog = blog::latest()->paginate(5);

        //reader view  with blog
        return view('tampil', compact('blog'));
        
    }

    /**
     * index
     *
     * @return View
     */
    public function create(): View
    {
        return view('blog.create');
    }

    public function header(): View
    {
        return view('shared.header');
    }
    public function footer(): View
    {
        return view('shared.footer');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'content'   => 'required|min:10'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/blog', $image->hashName());

        //create post
        blog::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        //redirect to index
        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get blog by ID
        $blog = blog::findOrFail($id);

        //render view with blog
        return view('blog.show', compact('blog'));
    }
  
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get blog by ID
        $blog = blog::findOrFail($id);

        //render view with blog
        return view('blog.edit', compact('blog'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required|min:5',
            'content'   => 'required|min:10'
        ]);

        //get blog by ID
        $blog = blog::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/blog', $image->hashName());

            //delete old image
            Storage::delete('public/blog/'.$post->image);

            //update blog with new image
            $blog->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);

        } else {

            //update blog without image
            $blog->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }

        //redirect to index
        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
     /**
     * destroy
     *
     * @param  mixed $blog
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get blog by ID
        $blog = blog::findOrFail($id);

        //delete image
        Storage::delete('public/blog/'. $blog->image);

        //delete blog
        $blog->delete();

        //redirect to index
        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function search (Request $request)
    {
        $search = $request->search;
        $blog = DB::table('blogs')
        ->where('title', 'like', "%".$search."%")
        ->paginate();
        return view('blog.index', compact('blog'));

    }
  

}
