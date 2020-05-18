@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead class=" text-primary">

            <th>
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Created_at
            </th>
            <th>
                Updated_at
            </th>

            <th class="text-md-left">
                Control

            </th>
            </thead>
            <tbody>

            @foreach($records as $record)
                <tr>
                    <td>
                        {{$record->id}}
                    </td>
                    <td>
                        {{$record->name}}
                    </td>
                    <td>
                        {{$record->created_at}}
                    </td>
                    <td>
                        {{$record->updated_at}}
                    </td>

                    <td><a href="{{'Governorate/'.$record->id.'/edit'}}">Edit</a></td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
@endsection