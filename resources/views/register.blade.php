@extends('layouts.master')

@section('title', 'register')
 

@section('content')
    
    <form action="/register" method="POST">
        @csrf
        <input type="text" name="examid" value="{{$exam->id}}" hidden/>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter your name" required>
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group">
            <label for="roll">Roll:</label>
            <input type="text" class="form-control" name="roll" id="roll" placeholder="Enter your roll" required>
        </div>
        <!-- <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <div class="form-group">
            <label for="registration">Registration no:</label>
            <input type="text" class="form-control" name="registration" id="registration" placeholder="Enter your registration" required>
        </div>
        <div class="form-group">
            <label for="course1">Course 1:</label>
            <select class="form-select" name="course1" id="course1" placeholder="Select first subject" required>
                
                @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->course_code}} - {{$course->course_title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="course2">Course 2:</label>
            <select class="form-select" name="course2" id="course2" placeholder="Select second subject">
                <option value="0">None</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->course_code}} - {{$course->course_title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="course3">Course 3:</label>
            <select class="form-select" name="course3" id="course3" placeholder="Select third subject">
                <option value="0">None</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->course_code}} - {{$course->course_title}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@stop