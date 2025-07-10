@extends('layouts.master')
 
@section('title', 'Schedule')
 

@section('content')
<div>
    Courses:
    <table class="table">
        <thead>
            <td>Course</td>
            <td>No. of Student(s)</td>
            <td>Students</td>
        </thead>
        <tbody>
            @foreach($vertexcount as $v=>$count)
                <tr>
                    <td>{{$coursemap[$v]}}</td>
                    <td>{{$count}}</td>
                    <td>
                            @foreach($courseStudentMap->$v as $std)
                                {{$std}}&nbsp;&nbsp;
                            @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
<br>
<div>
    Dependencies on courses:
    <table class="table">
        <thead>
                <td>Course</td>
                <td>Dependencies</td>
        </thead>
        <tbody>
            @foreach($vertex as $v)
                <tr>
                    <td>{{$coursemap[$v]}}</td>
                    <td>
                        @foreach($edge->$v as $e)
                        {{$coursemap[$e]}}&nbsp;&nbsp;
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    <br>
    <br>
Day wise exam: <button id="export" onclick="exportToExcel()">Export</button>
<table class="table" id="final_table">
    <thead>
        <td>Date no.</td>
        <td>Exam(s)</td>
        <td>Student(s)</td>
    </thead>
    <tbody>
        @foreach($result as $days)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td></td>
                <td></td>
</tr>
                    @foreach($days as $exam)
                    <tr>
                        <td></td>
                        <td>{{$coursemap[$exam]}}&nbsp;&nbsp;</td>
                        <td>
                            @foreach($courseStudentMap->$exam as $std)
                                {{$std}}&nbsp;&nbsp;
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
        @endforeach
    </tbody>
</table>
</div>
<script>
    function exportToExcel()
    {
        var table = $("#final_table");
          if(table && table.length){
            $(table).table2excel({
              filename: "Final Schedule" + new Date().toLocaleString().toString() + ".xls"
            });
          }
    }
</script>
@endsection