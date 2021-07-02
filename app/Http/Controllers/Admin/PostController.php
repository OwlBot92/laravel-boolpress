<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ]; 

        return view('admin.posts.create', $data);
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
            'title'=>'required|max:255',
            'content'=>'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'cover-image' => 'nullable|image'
        ]);

        $new_post_data = $request->all();

        $new_post = new Post();
        $new_post->fill($new_post_data);
        
        
        $new_slug = Str::slug($new_post_data['title'], '-');
        $base_slug = $new_slug;


        $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
        $counter = 1;

        while ($existing_post_with_slug) {
            $new_slug = $base_slug . '-' . $counter;
            $counter++;
            $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
        }

        $new_post_data['slug'] = $new_slug;

        if (isset($new_post_data['cover-image'])) {
            $uploaded_img_path = Storage::put('posts-cover', $new_post_data['cover-image']);

            if ($uploaded_img_path) {
                $new_post_data['cover'] = $uploaded_img_path;
            }

        }

        $new_post = new Post();
        $new_post->fill($new_post_data);
        $new_post->save();

        //sync degli id dei tagm, dopo il save perchè sync è immediato.
        //altrimenti non troverebbe nulla
        if (isset($new_post_data['tags']) && is_array($new_post_data['tags']) ) {
            $new_post->tags()->sync($new_post_data['tags']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        
        $data = [
            'post' => $post,
            'post_category' => $post->category,
            'post_tags' => $post->tags
        ];
        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', $data);
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
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ]);

        $updated_post_data = $request->all();
        $post = Post::findOrFail($id);   
        //SLUG
        if ($updated_post_data['title'] != $post->title) {
            
            $new_slug = Str::slug($post->title, '-');
            $base_slug = $new_slug;

            // Controllo univocità
            $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
            $counter = 1;

            while ($existing_post_with_slug) {
                $new_slug = $base_slug . '-' . $counter;
                $counter++;
                $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
            }

            $post->slug = $new_slug;
        }
        //FINE SLUG

        if (isset($new_post_data['cover-image'])) {
            $uploaded_img_path = Storage::put('posts-cover', $new_post_data['cover-image']);

            if ($uploaded_img_path) {
                $new_post_data['cover'] = $uploaded_img_path;
            }

        }
            
        $post->update($updated_post_data); 

        if (isset($updated_post_data['tags']) && is_array($updated_post_data['tags'])) {
            $post->tags()->sync($updated_post_data['tags']);  
        }
        else {
            $post->tags()->sync([]); 
        }

        return redirect()->route('admin.posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::find($id);
        $post_to_delete->tags()->sync([]); //sync([]) e non detach perchè non sappiamo chi vogliamo passare e con sync aggiorna al valore passato
        $post_to_delete->delete();
        return redirect()->route('admin.posts.index');
    }















    //funzione sluggify da finire
    public function sluggify($title)
    {
        $post = Post::findOrFail($id);
        $new_slug = Str::slug($title, '-');
        $base_slug = $new_slug;

        // Controllo univocità
        $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
        $counter = 1;

        while ($existing_post_with_slug) {
            $new_slug = $base_slug . '-' . $counter;
            $counter++;
            $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
        }

        $post->slug = $new_slug;

        return $post;
    }

}
