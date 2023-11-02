<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\DataTables\GroupDataTable;
use Exception;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        addVendors(['datatable']);
        $title = 'Website Groups';
        return view('group.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $group = new Group();
        $html = View::make('group.form', compact('group'))->render();
        return response()->json(['success'=>200, 'html'=>$html]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{

            $validator  = Validator::make($request->all(), [
                'name'          => 'required|max:255',
                'description'   => 'nullable|string'
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 403);
            }
    
            $group = new Group();
            $group->name            = $request->name;
            $group->description     = $request->description??null;
            $group->save();
            return response()->json(['status' => '200', 'message' => 'Data saved successfully']);
        }catch(Exception $e){
            return response()->json(['status' => '403', 'message' => 'Data not saved!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
        $html = View::make('group.form', compact('group'))->render();
        return response()->json(['success'=>200, 'html'=>$html]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        //
        try{
            $validator  = Validator::make($request->all(), [
                'name'          => [
                    'required',
                    'max:255',
                    Rule::unique('groups', 'name')->ignore($group->id),
                ],
                'description'   => 'nullable|string'
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 403);
            }

            $group->name            = $request->name;
            $group->description     = $request->description??null;
            $group->save();
            return response()->json(['status' => '200', 'message' => 'Data saved successfully']);
        }catch(Exception $e){
            return response()->json(['status' => '403', 'message' => 'Data not saved!']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
        $group->delete();
        return response()->json(['status' => '200', 'message' => 'Data deleted successfully!']);
    }

    public function datatable(GroupDataTable $dataTable){
        return $dataTable->render('group.index');
    }
}
