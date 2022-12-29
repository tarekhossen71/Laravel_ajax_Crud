<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Ajax;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index(){
        return view('ajax.index');
    }

    // Store 
    public function store(StudentRequest $request){

        $avater = $this->file_upload($request->file('avater'), 'avater/');
        
        $data = Ajax::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'roll'    => $request->roll,
            'reg'     => $request->reg,
            'board'   => $request->board,
            'session' => $request->session,
            'avater'  => $avater,
        ]);

        if($data){
            $output = ['status'=>'success','message'=>'Data has been created.'];
        }else{
            $output = ['status'=>'error','message'=>'Something Error!'];
        }

        return response()->json($output);
    }

    // Show
    public function show(Request $request){
        if ($request->ajax()) {
            $getData = Ajax::latest()->get();

            $code = '';

            foreach ($getData as $key => $student) {
                $serial = $key+1;
                $code .= '<tr>
                            <td>'.$serial.'</td>
                            <td>'.$student->name.'</td>
                            <td>'.$student->email.'</td>
                            <td>'.$student->phone.'</td>
                            <td>'.$student->roll.'</td>
                            <td>'.$student->reg.'</td>
                            <td>'.$student->board.'</td>
                            <td>'.$student->session.'</td>
                            <td>
                            <img src="avater/'.$student->avater.'" class="avater-img" alt="'.$student->name.'" />
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning edit-btn" data-id="'.$student->id.'" onClick="edit('."'Edit Student'".', '."'Update'".')">Edit</button>
                                <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="'.$student->id.'">Delete</button>
                            </td>
                        </tr>';
            }

            return response()->json($code);
        }
        
    }

    // Edit 
    public function edit(Request $request){
        if ($request->ajax()) {
            $student= Ajax::findOrFail($request->student_id);

            return response()->json($student);
        }
    }

    // Update 
    public function update(StudentRequest $request){

        if ($request->ajax()) {
            $student = Ajax::findOrFail($request->update);

            if ($request->hasFile('avater')) {
                $avater = $this->file_update($request->file('avater'), 'avater/', $student->avater);
            }else{
                $avater = $student->avater;
            }
            
            $data = $student->update([
                'name'    => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                'roll'    => $request->roll,
                'reg'     => $request->reg,
                'board'   => $request->board,
                'session' => $request->session,
                'avater'  => $avater,
            ]);

            if($data){
                $output = ['status'=>'success','message'=>'Data has been updated.'];
            }else{
                $output = ['status'=>'error','message'=>'Something Error!'];
            }

            return response()->json($output);
        }
    }

    // Borad Select 
    public function boardSelect(Request $request){
        if ($request->ajax()) {
            $student= Ajax::findOrFail($request->student_id);
            $dhaka = $student->board == 'Dhaka' ? 'selected' : '';
            $sylhet = $student->board == 'Sylhet' ? 'selected' : '';
            $rajshahi = $student->board == 'Rajshahi' ? 'selected' : '';

            $output = '';
            $output .= '
                <label class="form-label" for="board">Board</label>
                <select class="form-control" name="board" id="board">
                    <option value="">select board</option>
                    <option value="Dhaka" '.$dhaka.'>Dhaka</option>
                    <option value="Sylhet" '.$sylhet.'>Sylhet</option>
                    <option value="Rajshahi" '.$rajshahi.'>Rajshahi</option>
                </select>
            ';
            return response()->json($output);
        }
    }

    // Destroy
    public function destroy(Request $request){
        if ($request->ajax()) {
            $student = Ajax::findOrFail($request->student_id);
            
            if($student->avater != null){
                if(file_exists('avater/'.$student->avater)){
                    unlink('avater/'.$student->avater);
                }
            }
            $student->delete();

            $output = ['status'=>'success', 'message'=>'Data has been deleted.'];
            return response()->json($output);
        }
    }
}
