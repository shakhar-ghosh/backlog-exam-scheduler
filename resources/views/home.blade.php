@extends('layouts.master')
 
@section('title', 'Homepage')
 

@section('content')
    @if(count($exams) > 0) 
    @foreach($exams as $exam)
    <div class="card">
        <h5 class="card-header">{{$exam->exam_name}}</h5>
        <div class="card-body">
            <h5 class="card-title">Department: {{$exam->department}}</h5>
            <p class="card-text">Series: {{$exam->series}}<hr/><span class="text-danger">Deadline: {{$exam->deadline}}</span></p>
            <a href="/register/{{$exam->id}}" class="btn btn-primary">Register</a>
        </div>
    </div>
    <br>
    <br>
    @endforeach
    @else
    <h2>No scheduled exams found. Please comeback later</h2>
    @endif

@stop