<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Website;

class WordpressPosts extends Controller
{
    //
    public function index(){
        $title = 'Wordpress Posts';
        return view('website.posts.index', compact('title'));
    }

    public function content()
    {
        $websites = Website::get();
        $html = View::make('website.posts.content', compact('websites'))->render();
        echo $html;
    }

    public function lists(){
        $title = 'Posts Lists';
        addVendors(['quill-editor']);
        return view('website.posts.lists', compact('title'));
    }

    public function save(Request $request){
        dd($request->all());
    }

    public function destroy($post){
        
    }
}
