@extends('layouts.master')
 
@section('title', 'Students')
 

@section('content')
<form action="/students" method="POST">
    @csrf
    <input type="hidden" name="examid" value="{{$exam->id}}"/>
<label for="studentTable">Students that has registered for the examination:</label>
<table id="studentTable" class="table">
    <thead>
        <tr>
            <td>Roll</td>
            <td>Name</td>
            <td>Registration</td>
            <td>Course 1</td>
            <td>Course 2</td>
            <td>Course 3</td>
            @if($exam->exam_type == 2)
                <td>Course 4</td>
                <td>Course 5</td>
            @endif
            <td>Verified</td>
            <td>Update</td>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{$student['roll']}}</td>
                <td>{{$student['name']}}</td>
                <td>{{$student['registration']}}</td>
                <td>{{$student['course1']}}</td>
                <td>{{$student['course2']}}</td>
                <td>{{$student['course3']}}</td>
                @if($exam->exam_type == 2)
                    <td>{{$student['course4']}}</td>
                    <td>{{$student['course5']}}</td>
                @endif
                <td>
                    <input class="form-check-input" type="checkbox" value="{{$student['id']}}" name="verification[]" 
                    @if($student["verified"]== true)
                    checked
                    @endif
                    >
                </td>
                <td><a class="btn-sm btn-primary" role="button" href="/update-student/{{$student['id']}}" class="">Update</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<button class="btn-primary btn" type="submit" name="submit">Save</button>
</form>

@endsection