<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->ID);
        $per_page = $request->per_page;
        return response()->json(['roles' => Role::paginate($per_page)]);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->name);
        $role = Role::create([
            'name' => $request->name,
        ]);
        if($role)
        {
            return response()->json(['status' => "New Role Inserted"]);
        }
        else
        {
            return respose()->json(['status'=>'Sorry! Some Error Occured']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->update([
            "name" => $request->name,
        ]);
        if($role){
            return response()->json(['status' => "Record Updated"]);
        }
        else
        {
            return  response()->json(['status' => 'Record was not updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if($role->destroy($id)){
            return  response()->json(['status' => "Record deleted successfully"]);
        }
        else
        {
            return response()->json(['status' => 'Could not delete record']);
        }
    }
}
