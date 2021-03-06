<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    //
    public function index()
    {
        return view('admin.permissions.index', ['permissions' => Permission::all()]);
    }
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }
   
    public function update(Request $request, Permission $permission)
    {
        
        $data = $request->validate(['display_name' => 'required']);
        
        
        $permission->update($data);
        

        return redirect()->route('admin.permissions.edit',$permission)->with('status', 'Se ha guardado un permiso');
    }
}
