@extends('layouts.master')
 
@section('title', 'Exam')
 

@section('content')
    <form action="/exams" method="POST">
        @csrf
        <div class="form-group">
            <label for="exam_name">Name:</label>
            <input type="text" name="exam_name" class="form-control" id="exam_name"  placeholder="Example: 1st year backlog examination 2020" value="{{$exam->exam_name}}" required>
        </div>
        <div class="form-group">
            <label for="department">Department:</label>
            <input type="text" class="form-control" name="department" id="department" placeholder="Example: Computer Science &amp; Engineering" value="{{$exam->department}}" required>
        </div>
        
        <div class="form-group">
            <label for="series">Series:</label>
            <input type="text" class="form-control" name="series" id="series" placeholder="Example: 19" value="{{$exam->series}}"required>
        </div>
        <div class="form-group">
            <label for="deadline">Deadline:</label>
            <input type="date" class="form-control" name="deadline" id="deadline" value="{{$exam->deadline}}" required/>
        </div>
        <div class="form-check">
            <label class="form-check-input">Exam Type:</label></br>
            <input class="form-check-input" type="radio" name="exam_type" id="radio_backlog" value="1" <?php if($exam->exam_type == 1) echo("checked");?> />
            <label class="form-check-label" for="radio_backlog">Backlog</label><br/>
            <input class="form-check-input" type="radio" name="exam_type" id="radio_short" value="2" <?php if($exam->exam_type == 2) echo("checked");?>/>
            <label class="form-check-label" for="radio_short">Short Semester</label>
        </div>
        <div class="row">
            <div class="md-col-6">
                <label for="courseTable">Select the courses available for this exam:</label>
            </div>
            <div class="md-col-6 ml-auto">
                <a class="btn btn-success btn-sm" href="/courses/0/{{$exam->id}}">Add new course</a>
            </div>
        </div>
        <table id="courseTable" class="table md-col-12">
            <thead>
                <tr>
                    <td>Selected</td>
                    <td>Course Code</td>
                    <td>Course Title</td>
                    <td>Department</td>
                    <td>Year</td>
                </tr>
            </thead>
            <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>
                        <input type="checkbox" name="assignedcourses[]" value="{{$course->id}}" id="course_{{$course->id}}" />
                        </td>
                    <td>{{$course->course_code}}</td>
                    <td>{{$course->course_title}}</td>
                    <td>{{$course->department}}</td>
                    <td>{{$course->year}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/courses/{{$course->id}}/{{$exam->id}}">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($new==true)
            <button type="submit" name="submit" value="create" class="btn btn-primary">Create Exam</button>
        @else
            <input type="hidden" name="exam_id" value="{{$exam->id}}"/>
            <button type="submit" name="submit" value="update" class="btn btn-success">Update</button>
            <button type="submit" name="submit" value="delete" class="btn btn-danger">Delete</button>
        @endif
        
    </form>

    
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$("#courseTable").fancyTable({
			sortable: false,
			pagination: true,
			perPage:25,
			globalSearch:false,
            onInit:function(){
                @if($selected)
                @foreach($selected as $val)
                    $('#course_{{$val}}').prop('checked',true);
                @endforeach
                @endif
                
            }
		});		
	});
</script>
@endsection