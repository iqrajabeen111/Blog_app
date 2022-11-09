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
    //////practice////
    public function practice()
    {
        //ye srf wo post return krega jiski categry hogi category nai return krega bx
        // $check =  $this->postModel->whereHas('categories', function ($query) {
        //     $query->where('categories.id', 1);
        // })->get();

        //post jinki category id iss sy neechy hon jest retun post name s not category
        // $check =$this->postModel->has('categories', '<', 5)->get();

        //ye post k sth catgry return krega agr relation hai tb bi na ho tb i phr jiska relation 
        //hoga uski category ayegi bakio ki srf post ayegi
        // $check =$this->postModel->with('categories')->get();

        //ye post return krega sb or related categories bi jitni br hongi ids utni br categories 
        //return krega bhale same id do br ho do br same category return krega
        // $check = $this->postModel->with('categories:title')->get();

        //ye sb post return krega agr category na bi ho tb bi category nai retun krta post k sthh
        //agr category hogi post ki tw uska count dikhayega
        // $check = $this->postModel->withCount('categories')->orderBy('categories_count', 'desc')->get();
        // $check = $this->postModel->orderby('id','asc')->latest()->get();
        // echo "<pre>";
        // dd($check);
        // echo "</pre>";
        // die();
        // return view('List', ['posts' => $post]);
    }

}
