<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Models\Website;
use App\Library\MaticpressClientLib;

class WordpressUsers extends Controller
{
    public function index()
    {
        $title = "Wordpress Users";
        return view('website.users.index', compact('title'));
    }

    public function create($website_id)
    {
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = [];
            $roles = $Client->getWpRoles();
            $html = View::make('website.users.form', compact('website', 'response', 'roles'))->render();
            return response()->json(['success' => 200, 'html' => $html]);
        }
        abort(404);
    }

    public function save($website_id, Request $req)
    {
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $post_data['first_name']  = $req->first_name;
            $post_data['last_name']  = $req->last_name;
            $post_data['user_name']  =$req->user_name;
            $post_data['user_email']  = $req->user_email;
            $post_data['users_password']  = $req->password; 
            $post_data['user_status']  = true;
            $post_data['user_role']  =[$req->user_role]; 
            $response = $Client->createUser($post_data); 
            $return['status'] = (!empty($response->SUCCESS) && $response->SUCCESS == 1) ? 200 : 'error';
            $return['message'] = !empty($response->MSG) ? $response->MSG : 'Error!';
            return response()->json($return, 200);
        }
    }

    public function content()
    {
        $websites = Website::get();
        $html = View::make('website.users.content', compact('websites'))->render();
        echo $html;
    }


    public function lists($website)
    {
        $title = 'User Lists';
        addVendors(['quill-editor']);
        return view('website.users.lists', compact('title', 'website'));
    }

    public function listsContent($website_id)
    {
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->getUsers();
            return view('website.users.listscontent', compact('response', 'website_id'));
        }
        abort(404);
    }

    public function updateModal($userid, $website_id)
    {
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->getUserDetails($userid);
            $roles = $Client->getWpRoles();
            $html = View::make('website.users.form', compact('website', 'response', 'roles'))->render();
            return response()->json(['success' => 200, 'html' => $html]);
        }
        abort(404);
    }

    public function update($userid, $website_id, Request $req)
    {

        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $post_data['first_name']  = $req->first_name;
            $post_data['last_name']  = $req->last_name;
            $post_data['password']  = $req->password;
            $post_data['password_confirm']  = $req->password_confirm;
            $post_data['user_role']  = $req->user_role;
            $post_data['company']  = $req->company;
            $response = $Client->updateUser($post_data, $userid);
            $return['status'] = (!empty($response->SUCCESS) && $response->SUCCESS == 1) ? 200 : 'error';
            $return['message'] = !empty($response->MSG) ? $response->MSG : 'Error!';
            return response()->json($return, 200);
        }
    }

    public function destroy($userid, $website_id)
    {

        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->deleteUser($userid); 
            $return['status'] = (!empty($response->SUCCESS) && $response->SUCCESS == 1) ? 200 : 'error';
            $return['message'] = !empty($response->MSG) ? $response->MSG : 'Error!';
            return response()->json($return, 200);
        }
    }
}
