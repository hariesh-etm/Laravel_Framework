<?php
namespace App\Http\Controllers\Controllers\Frontend;
  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Route;
use Helper;
use Session;

  
class Sitemapcontroller extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index($value='')
    {
        //$posts = Post::latest()->get();

        $post = '[{"slug":"test"},{"slug":"test1"}]';

        $posts = json_decode($post);
        //print_r($posts);
        //echo $posts;
        //exit;


  
        return response()->view('frontend.sitemap', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }
}
?>