@extends('layouts.master')
 
@section('title', 'Short Semester Registration Success')
 

@section('content')
<div>
    Registration for short semester was successful. 
    <div class="row">
        <div class="col-md-4">Name:</div>
        <div class="col-md-8">{{$student->name}}</div>
        <div class="col-md-4">Roll:</div>
        <div class="col-md-8">{{$student->roll}}</div>
        <div class="col-md-4">Registration No.:</div>
        <div class="col-md-8">{{$student->registration}}</div>
        <div class="col-md-4">Course 1:</div>
        <div class="col-md-8">{{$courses[$student->course1]}}</div>
        @if($student->course2 && $student->course2>0)
        <div class="col-md-4">Course 2:</div>
        <div class="col-md-8">{{$courses[$student->course2]}}</div>
        @endif
        @if($student->course3 && $student->course3>0)
        <div class="col-md-4">Course 3:</div>
        <div class="col-md-8">{{$courses[$student->course3]}}</div>
        @endif
        @if($student->course4 && $student->course4>0)
        <div class="col-md-4">Course 4:</div>
        <div class="col-md-8">{{$courses[$student->course4]}}</div>
        @endif
        @if($student->course5 && $student->course5>0)
        <div class="col-md-4">Course 5:</div>
        <div class="col-md-8">{{$courses[$student->course5]}}</div>
        @endif
    </div>
    <br>
    <div class="text-warning">If you need to change any data, please contact with your course advisor.</div>
    <br>
    <button class="btn btn-primary" onclick="location.href='/'">Go to Home</button>
</div>
@endsection