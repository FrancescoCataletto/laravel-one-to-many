<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|string',
            'text' => 'required|string|max:255'
        ],
        [
            'title.required' => 'Bisogna inserire un titolo',
            'title.max' => 'Il titolo deve essere lungo al massimo 255 caratteri',
            'title.string' => 'Il titolo deve essere una stringa',
            'text.required' => 'Bisogna inserire una descrizione',
            'text.string' => 'Il titolo deve essere una stringa',
            'text.max' => 'La descrizion deve essere lunga al massimo 255 caratteri'
        ]
        );

        $data = $request->all();

        $new_post = new Post();

        $data['slug'] = Post::slugGenerator($new_post['title']);

        $new_post->fill($data);

        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => 'required|max:255|string',
            'text' => 'required|string|max:255'
        ],
        [
            'title.required' => 'Bisogna inserire un titolo',
            'title.max' => 'Il titolo deve essere lungo al massimo 255 caratteri',
            'title.string' => 'Il titolo deve essere una stringa',
            'text.required' => 'Bisogna inserire una descrizione',
            'text.string' => 'Il titolo deve essere una stringa',
            'text.max' => 'La descrizione deve essere lunga al massimo 255 caratteri'
        ]
        );

        $data = $request->all();

        $data['slug'] = Post::slugGenerator($post['title']);

        $post->update($data);

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect()->route('admin.posts.index')->with('post_cancellato', 'Hai cancellato correttamente il post');
    }
}
