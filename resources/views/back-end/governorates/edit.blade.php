@extends('layouts.app')

@section('content')

        <form action="{{url('Governorate/'.$record->id)}}" method="POST">
            {{csrf_field()}}
            {{method_field('put')}}
            <input type="text" name="name" value="{{$record->name}}">
            <button type="submit" class="btn btn-primary pull-right">Update</button>
            <div class="clearfix"></div>
        </form>

@endsection

