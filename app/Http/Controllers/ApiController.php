<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class ApiController extends Controller
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

    public function getdata()
    {

        return ["name"=>"iqra jabeen"];
     
    }
}
