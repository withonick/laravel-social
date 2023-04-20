@extends('layouts.adm')

@section('title', 'Все жалобы')

@section('content')

    <div class="table-stats order-table ov-h">
        <table class="table ">
            <thead>
            <tr>
                <th class="serial">#</th>
                <th class="avatar">Avatar</th>
                <th>Complain ID</th>
                <th>Fullname</th>
                <th>Post</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            {{$complains}}
            </tbody>
        </table>
    </div>

@endsection
