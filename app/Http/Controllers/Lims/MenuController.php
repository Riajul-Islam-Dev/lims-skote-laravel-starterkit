<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Module;
use Session;

class MenuController extends Controller
{
    public function showMenu()
    {
        $show_menu_data = Menu::all();
        // $show_menu_data = Menu::paginate(3);

        // $show_menu_data = Menu::simplePaginate(3);
        return view('menu/show_menu', compact('show_menu_data'));
        // return view('menu/show_menu');
    }

    public function addMenu()
    {
        $module_data = Module::pluck('name')->toArray();
        // dd($module_data);
        return view('menu/add_menu', compact('module_data'));
    }

    public function saveMenu(Request $request)
    {
        $menu = new Menu();

        $menu->name = $request->name;
        $menu->module_name = $request->module_name;
        $menu->icon = $request->icon;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $menu->status = $request->status;

        $menu->save();

        Session::flash('msg', 'Data saved successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect('/show_menu');
    }

    public function editMenu($id = null)
    {
        $edit_menu_data = Menu::find($id);
        $module_data = Module::pluck('name')->toArray();

        return view('menu/edit_menu', compact('edit_menu_data', 'module_data'));
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::find($id);

        $menu->name = $request->name;
        $menu->module_name = $request->module_name;
        $menu->icon = $request->icon;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $menu->status = $request->status;

        $menu->save();

        Session::flash('msg', 'Data updated successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect('/show_menu');
    }

    public function deleteMenu($id = null)
    {
        $delete_menu_data = Menu::find($id);
        $delete_menu_data->delete();

        Session::flash('msg', 'Data deleted successfully!');

        return redirect('/show_menu');
    }
}
