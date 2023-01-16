<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\User;
use App\Models\Lims\Role;
use PDF;

class PDFController extends Controller
{
    public function viewPDF(Request $request)
    {
        $id = $request->user_id;
        $show_user_data = User::find($id);
        $role_data = Role::find($show_user_data->role_id);
        $show_user_data->role_name = $role_data->role_name;
        
        $data = [
            'id' => $show_user_data->id,
            'name' => $show_user_data->name,
            'email' => $show_user_data->email,
            'dob' => $show_user_data->dob,
            'role_name' => $show_user_data->role_name,
            'status' => $show_user_data->status,
            'avatar' => $show_user_data->avatar,
        ];
        
        $pdf = PDF::loadView('lims.pdf.testPdf', $data);

        return $pdf->stream();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $data = [
            'title' => 'Test PDF Generate',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('lims.pdf.testPdf', $data);
    
        // return $pdf->download('lims.pdf');
        return $pdf->stream();
    }
}
