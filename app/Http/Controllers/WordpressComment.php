<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Library\MaticpressClientLib;

class WordpressComment extends Controller
{
    //
    public function index(){
        $title = 'Wordpress Comments';
        return view('website.comments.index', compact('title'));
    }

    public function content()
    {
        $websites = Website::get();
        $html = View::make('website.comments.content', compact('websites'))->render();
        echo $html;
    }

    public function lists( $website ){
        $title = 'Comments Lists';
        addVendors(['quill-editor']);
        return view('website.comments.lists', compact('title', 'website'));
    }

    public function listsContent($website_id){
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->getComments();
            return view('website.comments.listscontent', compact('response', 'website_id'));
        }
        abort(404);
    }

    public function replyForm($postid, $comment_id, $website_id){
        $html = View::make('website.comments.reply', compact('postid', 'comment_id', 'website_id'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function save(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'comment' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 403);
            }

            $website = Website::find(decodeSecureHash($request->website_id));
            $data = $request->all();
            unset($data['_token']);
            unset($data['website_id']);
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->replyComments($data);
            if($response){
                return response()->json(['status' => '200', 'message' => 'Data saved successfully!']);
            }else{
                return response()->json(['status' => '403', 'message' => 'Data not saved!']);
            }

        } catch (Exception $e) {
            return response()->json(['status' => '403', 'message' => 'Data not saved!']);
        }

        
    }

    public function changeStatus($comment, $status ,$website_id){
        $website = Website::find(decodeSecureHash($website_id));
        if( $comment && !empty($website->id) ){
            $data = [
                'id'    => $comment,
                'status'  => $status
            ];

            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->statusComments($data);
            if( $response ){
                return response()->json(['status' => '200', 'message' => 'Status changed successfully!']);
            }else{
                return response()->json(['status' => '403', 'message' => 'Status not changed!']);
            }
        }
    }

    public function destroy($comment, $website_id){
        $website = Website::find(decodeSecureHash($website_id));
        if( $comment && !empty($website->id) ){
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->deleteComments($comment);
            if( $response ){
                return response()->json(['status' => '200', 'message' => 'Data deleted successfully!']);
            }else{
                return response()->json(['status' => '403', 'message' => 'Data not deleted!']);
            }
        }
    }
}
