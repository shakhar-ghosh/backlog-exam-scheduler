@extends('layouts.master')
 
@section('title', 'Update Student Information')
 

@section('content')

<form method="POST" action="/update-student">
@csrf
    <input type="hidden" name="id" value="{{$student->id}}"/>
    <input type="hidden" name="exam_type" value="{{$exam->exam_type}}"/>
    <div class="form-group">

        <label for="name">Name:</label>
        <input class="form-control" type="text" id="name" name="name" value="{{$student->name}}"/>
    
    </div>
    <div class="form-group">
        <label for="registration">Registration:</label>
        <input class="form-control" type="text" id="registration" name="registration" value="{{$student->registration}}"/>
    </div>
    <div class="form-group">
            <label for="course1">Course 1:</label>
            <select class="form-select form-control" name="course1" id="course1" placeholder="Select first subject" required>
                
                @foreach($courses as $course)
                    <option value="{{$course->id}}" <?php if($course->id == $student->course1) echo("selected");?> >{{$course->course_code}} - {{$course->course_title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="course2">Course 2:</label>
            <select class="form-select form-control" name="course2" id="course2" placeholder="Select second subject" value="{{$student->course2}}">
                <option value="0">None</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}"  <?php if($course->id == $student->course2) echo("selected");?> >{{$course->course_code}} - {{$course->course_title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="course3">Course 3:</label>
            <select class="form-select form-control" name="course3" id="course3" placeholder="Select third subject" value="{{$student->course3}}">
                <option value="0">None</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}"  <?php if($course->id == $student->course3) echo("selected");?> >{{$course->course_code}} - {{$course->course_title}}</option>
                @endforeach
            </select>
        </div>
        @if($exam->exam_type==2)
        <div class="form-group">
            <label for="course4">Course 3:</label>
            <select class="form-select form-control" name="course4" id="course4" placeholder="Select forth subject" value="{{$student->course4}}">
                <option value="0">None</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}"  <?php if($course->id == $student->course4) echo("selected");?> >{{$course->course_code}} - {{$course->course_title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="course5">Course 5:</label>
            <select class="form-select form-control" name="course5" id="course5" placeholder="Select fifth subject" value="{{$student->course5}}">
                <option value="0">None</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}"  <?php if($course->id == $student->course5) echo("selected");?> >{{$course->course_code}} - {{$course->course_title}}</option>
                @endforeach
            </select>
        </div>
        @endif
        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>

        <button type="submit" name="submit" value="delete" class="btn btn-danger">Delete</button>
</form>
@endsection