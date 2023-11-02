<?php

namespace App\Http\Controllers;

use App\Library\MaticpressClientLib;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsiteSettingsController extends Controller
{
    //
    public function webSecurity($website_id){
        $title = 'Web Security';
        $website = Website::find(decodeSecureHash($website_id));
        return view('website.settings.websecurity', compact('title','website_id','website'));
    }

    public function dbOptimization(){
        $title = 'DB Optimization';
        return view('website.settings.dboptimization', compact('title'));
    }

    public function seo(){
        $title = 'SEO Settings';
        return view('website.settings.seo', compact('title'));
    }
    
    public function checkLoginStatus($website_id){
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->checkHideLogin();
            return response()->json($response, 200);
        }
        abort(404);
    }

    public function updateLoginStatus($website_id){
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->checkHideLogin();
            $status = ($response->status==1) ? 2 : 1;
            $response = $Client->hideLoginStatus($status);
            return response()->json($response, 200);
        }
        abort(404);
    }

    public function updateLoginUrl(Request $request, $website_id){
        $message['wp_login_url.required'] = "The Login field is required.";
        $validator = Validator::make($request->all(), [
            'wp_login_url' => 'required',
        ],$message);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 403);
        }

        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->hideLogin($request->wp_login_url);
            $return['status'] = (!empty($response->SUCCESS) && $response->SUCCESS == 1) ? 200 : 'error';
            $return['message'] = !empty($response->MSG) ? $response->MSG : 'Error!';
            $return['clickTarget'] = (!empty($response->SUCCESS) && $response->SUCCESS == 1) ? '.login-settings' : '';
            return response()->json($return, 200);
        }
        abort(404);
    }

    function updateTablePrefix(Request $request,$website_id){
        $validator = Validator::make($request->all(), [
            'table_prefix' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 403);
        }

        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $data['checkbox-prefix'] = 1;
            $data['new-prefix'] = $request->table_prefix;
            $response = $Client->changeDatabasePrefix($data);
            $return['status'] = (!empty($response->Success_Msg)) ? 200 : 'error';
            if(!empty($response->Success_Msg)){
                $return['message'] = implode(" ", $response->Success_Msg);
            }
            else{
                if(!empty($response->Error_Msg)){
                    $return['message'] = implode(" ", $response->Error_Msg);
                } 
                else{
                    $return['message'] = 'Table prefix not updated!';
                }
            }
            $return['clickTarget'] = (!empty($response->Success_Msg)) ? '.table-prefix' : '';
            return response()->json($return, 200);
        }
        abort(404);
    }

    function updateLoginUsername(Request $request,$website_id){
        $validator = Validator::make($request->all(), [
            'new_login_username' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 403);
        }

        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $new_login_username = $request->new_login_username;
            $response = $Client->changeLoginName($new_login_username);
            $return['status'] = (!empty($response->SUCCESS) && $response->SUCCESS == 1) ? 200 : 'error';
            $return['message'] = !empty($response->MSG) ? $response->MSG : 'Error!';
            $return['clickTarget'] = (!empty($response->SUCCESS) && $response->SUCCESS == 1) ? '.update-login-username' : '';
            return response()->json($return, 200);
        }
        abort(404);
    }
}
