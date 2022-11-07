<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * @var \App\Models\Post|null
     */
    private $postModel = null;

    /**
     * @var \App\Models\Category|null
     */
    private $categoryModel = null;

    public function __construct(Post $postModel, Category $categoryModel)
    {
        $this->postModel = $postModel;
        $this->categoryModel = $categoryModel;
    }

    public function index()
    {
        $post =  $this->postModel->with('categories')->get();
        return view('List', ['posts' => $post]);
    }

    public function create()
    {
        $category = $this->categoryModel->get();
        return view('Post', ['categories' => $category]);
    }

    public function store(PostRequest $request)
    {

        $request->validate([
            'title' => 'required',

        ]);
        $data = $request->all();
        $post = $this->postModel->create([
            'title' => $data['title'],

        ]);

        $category = $this->categoryModel->find($request->category);
        $post->categories()->attach($category->id);
        return redirect()->back()->with('message', 'Category Added Successfully');
    }


    public function edit($postid)
    {
        $post = $this->postModel->find($postid);
        $categories = $this->categoryModel->get();
        return view('EditPost', ['posts' => $post, 'categories' => $categories]);
    }

    public function destroy($id)
    {
        $post = $this->postModel->find($id);
        //delete child rows first then delete the actual row
        $post->categories()->detach();
        $post->delete();
        return redirect()->route('index')->with('success', 'Task removed.');
    }
    public function update(Request $request, $id)
    {
        $post = $this->postModel->find($id);
        $post->title =  $request->get('title');
        $post->save();
       
        $post->categories()->sync($request->categories);
        return redirect()->route('index')->with('success', 'Post updated.');
    }
}
