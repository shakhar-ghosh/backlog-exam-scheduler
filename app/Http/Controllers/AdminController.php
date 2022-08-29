<?php

namespace App\Http\Controllers;

use App\Models\AvailableExam;
use App\Models\Course;
use App\Models\RegisteredStudent;
use Hamcrest\Core\IsTypeOf;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function students($id)
    {
        $students = RegisteredStudent::all()->where('examid','=',$id)->toArray();
        $exam = AvailableExam::all()->where('id','=',$id)->first();

        $courses = Course::all()->toArray();
        $coursemap = [];
        foreach($courses as $crs)
        {
            $coursemap[$crs['id']] = $crs['course_code'];
        }
        $stds = [];
        foreach($students as $std)
        {
            if($std['course1'] && $std['course1']>0) 
                $std['course1'] = $coursemap[$std['course1']];

            if($std['course2'] && $std['course2']>0) 
                $std['course2'] = $coursemap[$std['course2']];

            if($std['course3'] && $std['course3']>0) 
                $std['course3'] = $coursemap[$std['course3']];
            array_push($stds,$std);
        }
        return view('student')->with([
                                        'students'=>$stds, 
                                        'exam'=>$exam
                                    ]);
    }
    public function studentsupdate(Request $req)
    {
        $std = $req->input('verification');
        $examid = $req->input('examid');
        RegisteredStudent::where('examid','=', $examid)->update(array('verified'=>false));

        RegisteredStudent::wherein('id',$std)->update(array('verified'=>true));
        flash()->addSuccess('Data has been saved successfully!');

        return redirect('/students/'.$examid);
    }
    public function schedule($examid)
    {
        $courses = RegisteredStudent::all()->where('examid','=',$examid)->where('verified','=', true);
        $allstd = $courses->toArray();
        $edge = (object)[];
        $result = (object)[];
        $vertex = [];
        foreach($allstd as $std)
        {
            if($std['course1'])
                array_push($vertex, $std['course1']);
            if($std['course2'])
                array_push($vertex, $std['course2']);
            if($std['course3'])
                array_push($vertex, $std['course3']);
        }
        $vertexcount = array_count_values($vertex);
        $vertex = array_unique($vertex);
        foreach($vertex as $v)
        {
            $edge->$v = [];
            $result->$v = -1;
        }
        foreach($allstd as $std)
        {
            $items = [];
            if($std['course1'])
                array_push($items, $std['course1']);
            if($std['course2'])
                array_push($items, $std['course2']);
            if($std['course3'])
                array_push($items, $std['course3']);
            foreach($items as $item)
            {
                foreach($items as $it)
                {
                    if($item != $it)
                        array_push($edge->$item, $it);
                }
                $edge->$item = array_unique($edge->$item);
            }

        }
        foreach($vertex as $node)
        {
            $used = [];
            foreach($edge->$node as $adjacent)
            {
                if($node == $adjacent)
                    continue;
                if($result->$adjacent != -1)
                     array_push($used, $result->$adjacent);
            }
            for($i=0;$i<count($vertex);$i++)
            {
                $found = false;
                foreach($used as $c)
                {
                    if($i==$c) 
                        $found = true; 
                }
                if($found == false)
                {
                    $result->$node = $i;

                    break;
                }
            }
        }
        $ret = [];
        $colors = [];
        foreach($vertex as $v)
        {
            array_push($colors, $result->$v);
        }
        foreach($colors as $color)
        {
            $ret[$color] = [];
        }
        foreach($vertex as $v)
        {
            array_push($ret[$result->$v], $v);
        }
        $coursemap = Course::all()->wherein('id',$vertex)->pluck('course_code','id')->toArray();
        return view('schedule')->with([
            'edge'=>$edge,
            'vertex'=>$vertex,
            'vertexcount'=>$vertexcount,
            'result'=>$ret,
            'coursemap'=>$coursemap
        ]);
    }
    public function course($courseid, $examid)
    {
        if($courseid == 0)
        {
            $course = (object)[];
            $course->id=0;
            $course->course_code = "";
            $course->course_title = "";
            $course->department = "";
            $course->year = "";
            return view('course')->with([
                                    'course'=>$course,
                                    'examid'=>$examid
                                ]);
        
        }
        else {
            $course = Course::all()->where('id', '=', $courseid)->first();
            return view('course')->with([
                                    'course'=>$course,
                                    'examid'=>$examid
                                ]);
        }
            
    }
    public function courseupdate(Request $req)
    {
        $operation = $req->input('submit');
        $id = $req->input('id');
        $course_code = $req->input('course_code');
        $course_title = $req->input('course_title');
        $department = $req->input('department');
        $year = $req->input('year');
        $examid = $req->input('examid');
        if($operation == 'create') 
        {
            $course = new Course;
            $course->course_code = $course_code;
            $course->course_title = $course_title;
            $course->department = $department;
            $course->year = $year;
            if($course->save())
                flash()->addSuccess('Course added successfully');
            else 
                flash()->addError('Add course operation failed');
            return redirect('/exams/'.$examid);
        }
        else if($operation == 'update')
        {
            $res = Course::where('id','=', $id)->update(array(
                                            'course_code'=>$course_code,
                                            'course_title'=>$course_title,
                                            'department'=>$department,
                                            'year'=>$year
                                    ));
            if($res)
                flash()->addSuccess('Course updated successfully');
            else 
                flash()->addError('Update course operation failed');
            return redirect('/exams/'.$examid);
        }
        else if($operation == 'delete')
        {
            $res = Course::where('id','=', $id)->delete();
            if($res)
                flash()->addSuccess('Course deleted successfully');
            else 
                flash()->addError('Delete course operation failed');
            return redirect('/exams/'.$examid);
        }
    }
}
