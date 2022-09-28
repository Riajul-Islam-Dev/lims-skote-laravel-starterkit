<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use Session;

class ModuleController extends Controller
{
    public function showModule()
    {
        $show_module_data = Module::all();
        // $show_module_data = Module::paginate(3);

        // $show_module_data = Module::simplePaginate(3);
        return view('module/show_module', compact('show_module_data'));
        // return view('module/show_module');
    }

    public function addModule()
    {
        return view('module/add_module');
    }

    public function saveModule(Request $request)
    {

        $module = new Module();

        $module->name = $request->name;
        $module->module_folder = $request->module_folder;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $module->status = $request->status;

        $module->save();

        Session::flash('msg', 'Data saved successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect('/show_module');
    }

    public function editModule($id = null)
    {
        $edit_module_data = Module::find($id);
        return view('module/edit_module', compact('edit_module_data'));
    }

    public function updateModule(Request $request, $id)
    {
        $module = Module::find($id);

        $module->name = $request->name;
        $module->module_folder = $request->module_folder;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $module->status = $request->status;

        $module->save();

        Session::flash('msg', 'Data updated successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect('/show_module');
    }

    public function deleteModule($id = null)
    {
        $delete_module_data = Module::find($id);
        $delete_module_data->delete();

        Session::flash('msg', 'Data deleted successfully!');

        return redirect('/show_module');
    }
}
