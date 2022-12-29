<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentValidationRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class AjaxCrudController extends Controller
{
    public function index()
    {
        return view('student.app');
    }

    // Store 
    public function store(StudentValidationRequest $request)
    {
        if ($request->ajax()) {

            if ($request->file('avater') != null) {
                $avater = $request->file('avater');

                $ext = $avater->getClientOriginalExtension();
                $uniqueName = uniqid().'.'.$ext;
                $avater->move('profile/', $uniqueName);
            }

            Student::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'birthday'=> $request->birthday,
                'avater'=> $uniqueName,
            ]);

            return response()->json([
                'status'=> 'success',
                'message'=> 'Data Inserted!',
            ]);
        }
    }

    // Show 
    public function show()
    {
        $students = Student::latest('id')->get();
        $code = '';
        foreach ($students as $key => $student) {
            $serial = $key+1;
            $bithday = $student->birthday ? date('d-m-Y', strtotime($student->birthday)) : '---';
            $img = '<img src="'."profile/".$student->avater.'" alt="'.$student->name.'" class="profile-img">';
            $code .= '<tr>
                        <td>'.$serial.'</td>
                        <td>'.$student->name.'</td>
                        <td>'.$student->email.'</td>
                        <td>'.$bithday.'</td>
                        <td>'.$img.'</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-sm btn-info edit-btn me-2" data-id="'.$student->id.'" onClick="edit_data('."'Edit Student'".','."'Update'".')">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="'.$student->id.'">Delete</button>
                            </div>
                        </td>
                    </tr>';
        }

        return response()->json($code);
    }
    // Edit 
    public function edit(Request $request)
    {
        if($request->ajax()){
            $student = Student::findOrFail($request->student_id);

            return response()->json($student);
        }
    }

    // Update 
    public function update(StudentValidationRequest $request)
    {
        if ($request->ajax()) {
            $student = Student::findOrFail($request->update);
            if($request->hasFile('avater')){
                if ($student->avater != null) {
                    if (file_exists('profile/'.$student->avater)) {
                       unlink('profile/'.$student->avater);
                    }
               }
               $avater = $request->file('avater');
    
               $ext = $avater->getClientOriginalExtension();
               $uniqueName = uniqid().'.'.$ext;
               $avater->move('profile/', $uniqueName);
            }else{
                $uniqueName = $student->avater;
            }

            $student->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'birthday'=> $request->birthday,
                'avater'=> $uniqueName,
            ]);

            return response()->json([
                'status'=> 'success',
                'message'=> 'Data Updated!',
            ]);
        }
    }
    // Destroy
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $student = Student::findOrFail($request->student_id);
            if ($student->avater != null) {
                 if (file_exists('profile/'.$student->avater)) {
                    unlink('profile/'.$student->avater);
                 }
            }
            $student->delete();
            
            return response()->json([
                'status'=> 'success',
                'message'=> 'Data Deleted!',
            ]);
        }
    }
}
