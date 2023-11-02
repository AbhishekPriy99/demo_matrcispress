<?php

namespace App\Http\Controllers;

use App\Library\MaticpressClientLib;
use App\Models\Group;
use App\Models\Website;
use App\Models\WebsiteNotes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $title = 'Websites';
        return view('website.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $groups = Group::all();
        $website = new Website();
        $html = View::make('website.form', compact('website', 'groups'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'url' => 'required|url',
                'key' => 'required|string',
                'group_id' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 403);
            }

            $website = new Website();
            $website->url = $request->url;
            $website->key = $request->key;
            $website->group_id = $request->group_id ?? null;

            // generate token
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken($website->token);
            $website->token = $Client->token;
            // generate token

            $website->save();

            return response()->json(['status' => '200', 'message' => 'Data saved successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => '403', 'message' => 'Data not saved!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Website $website)
    {
        //
        $data['title'] = 'More Settings';
        $data['website'] = $website;
        addVendors(['website-settings']);
        return view('website.settings', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Website $website)
    {
        //
        $groups = Group::all();
        $html = View::make('website.form', compact('website', 'groups'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Website $website)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'url' => 'required|url',
                'key' => 'required|string',
                'group_id' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 403);
            }

            $website->url = $request->url;
            $website->key = $request->key;
            $website->group_id = $request->group_id ?? null;
            $website->save();
            return response()->json(['status' => '200', 'message' => 'Data saved successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => '403', 'message' => 'Data not saved!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Website $website)
    {
        //
        $website->delete();
        return response()->json(['status' => '200', 'message' => 'Data deleted successfully!']);
    }

    public function content()
    {
        $websites = Website::with('groups')->get();
        $html = View::make('website.content', compact('websites'))->render();
        echo $html;
    }

    public function adminLogin(Request $request, $website_id)
    {
        $referer = request()->headers->get('referer');
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id) && $referer == url('websites')) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $directLoggedIn = $Client->directLoggedIn();
            if (!empty($directLoggedIn->redirect_link)) {
                return redirect($directLoggedIn->redirect_link);
            }
        }
        abort(404);
    }

    public function checkUpdates(Request $request, $website_id)
    {
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->checkUpdate();
            return response()->json($response, 200);
        }
        abort(404);
    }

    public function wpUpdate(Request $request, $type)
    {
        $website = Website::find(decodeSecureHash($request->id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            switch ($type) {
                case 'full-update':
                    $response = $Client->fullUpdate();
                    break;
                case 'core-update':
                    $response = $Client->coreUpdate();
                    break;
                case 'plugin-update':
                    $response = $Client->pluginUpdate();
                    break;
                case 'theme-update':
                    $response = $Client->themeUpdate();
                    break;

                default:
                    abort(404);
                    break;
            }
            return response()->json($response, 200);
        }
        abort(404);
    }

    function checkSsl($website_id)
    {
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->getSslPermission();
            return response()->json($response, 200);
        }
        abort(404);
    }

    function updateSslPermission($website_id)
    {
        $website = Website::find(decodeSecureHash($website_id));
        if (!empty($website->id)) {
            $Client = new MaticpressClientLib($website);
            $Client->verifyToken();
            $response = $Client->sslPermission();
            return response()->json($response, 200);
        }
        abort(404);
    }

    public function notes($id, Request $req, WebsiteNotes $website_notes)
    {
        switch ($req->method()) {
            case 'GET':
                $action = $req->input('type');
                if ($action == 'Add') {
                    $data = [];
                    $website_id=$id; 
                    $html = View::make('website.notes', compact('website_id', 'data'))->render();
                    return response()->json(['success' => 200, 'html' => $html]);
                } else {
                    $website_id = decodeSecureHash($id);
                    $data = $website_notes::where('website_id', $website_id)->get();
                    $html = View::make('website.notes', compact('website_id', 'data'))->render();
                    return response()->json(['success' => 200, 'html' => $html]);
                }
                break;
            case 'POST':
                try {
                    $post_data = [
                        'website_id' => decodeSecureHash($id),
                        'notes' => $req->notes
                    ];
                    $website_notes::create($post_data);
                    return response()->json(['status' => '200', 'message' => 'Data saved successfully']);
                } catch (\Throwable $th) {
                    return response()->json(['status' => '200', 'message' => 'Something went wrong']);
                }
                break;
            case 'DELETE':

                try {
                    $notes_id = decodeSecureHash($id);
                    $website_notes::where('id', $notes_id)->delete();
                    return response()->json(['status' => '200', 'message' => 'Deleted successfully']);
                } catch (\Throwable $th) {
                    return response()->json(['status' => '200', 'message' => 'Something went wrong']);
                }
                break;
            case 'PATCH':
                try {
                    $notes_id = decodeSecureHash($id);
                    $website_data = $website_notes::find($notes_id);
                    if (!empty($website_data)) {

                        $website_data->website_id = $req->website_id;
                        $website_data->notes = $req->notes;
                        if($website_data->save()){
                            return response()->json(['status' => '200', 'message' => 'Data saved successfully']);
                        }
                        else{
                            return response()->json(['status' => '200', 'message' => 'Failed to update']); 
                        }
                    } else {
                        return response()->json(['status' => '200', 'message' => 'No Data Found']);
                    }
                } catch (\Throwable $th) {

                    return response()->json(['status' => '200', 'message' => 'Something went wrong']);
                }
                break;
            default:
                abort(404);
                break;
        }
    }
}
