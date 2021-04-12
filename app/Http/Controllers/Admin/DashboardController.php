<?php

namespace App\Http\Controllers\Admin;

use App\Models\Entities;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(){
        $entities = Entities::all();
        return view('admin.index', compact(['entities']));
    }

    public function adminIndex($entity_id){
        if(auth()->user()->hasRole('Admin')){
            $entity_id = auth()->user()->entity_id;
        }
        $entityOne = Entities::find($entity_id);
        $departments = ($entityOne)->department;
        return view('admin.index', compact(['departments','entity_id']));
    }

}
