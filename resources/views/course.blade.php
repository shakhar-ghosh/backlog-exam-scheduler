@extends('layouts.master')
 
@section('title', 'Course')
 

@section('content')
    <form action="/course" method="POST">
        @csrf
        <input type="hidden" name="examid" value="{{$examid}}"/>
        <input type="hidden" name="id" value="{{$course->id}}"/>
        <div class="form-group">
            <label for="course_code">Course code:</label>
            <input type="text" name="course_code" class="form-control" id="course_code" value="{{$course->course_code}}" required>
        </div>
        <div class="form-group">
            <label for="course_title">Course title:</label>
            <input type="text" name="course_title" class="form-control" id="course_title" value="{{$course->course_title}}" required>
        </div>
        <div class="form-group">
            <label for="department">Department:</label>
            <input type="text" name="department" class="form-control" id="department" value="{{$course->department}}" required>
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" name="year" class="form-control" id="year" value="{{$course->year}}" required>
        </div>
        @if($course->id==0)
            <button type="submit" name="submit" value="create" class="btn btn-primary">Create Course</button>
        @else
            <button type="submit" name="submit" value="update" class="btn btn-success">Update Course</button>
            <button type="submit" name="submit" value="delete" class="btn btn-danger">Delete Course</button>
        @endif
    </form>
@endsection