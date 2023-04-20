@extends('layouts.adm')

@section('title', 'Запросы на подтверждение')

@section('content')

    <div class="table-stats order-table ov-h">
        <table class="table ">
            <thead>
            <tr>
                <th class="serial">#</th>
                <th class="avatar">Avatar</th>
                <th>ID</th>
                <th>Fullname</th>
                <th>Username</th>
                <th>Passport</th>
                <th>Article</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i<count($users); $i++)
                <tr>
                    <td class="serial">{{$i+1}}.</td>
                    <td class="avatar">
                        <div class="round-img">
                            <a href="#"><img class="rounded-circle" src="{{$users[$i]->profile_img}}" alt=""></a>
                        </div>
                    </td>
                    <td>{{$users[$i]->id}}</td>
                    <td><span class="name">{{$users[$i]->firstname . " " . $users[$i]->surname}}</span></td>
                    <td><span class="product">{{$users[$i]->username}}</span></td>
                    <td><span class="name">{{$users[$i]->whosubscribed}}</span></td>
                    <td>{{$users[$i]->verified}}</td>
                    <td>
                        @if($users[$i]->is_active)
                            <form action="{{route('user.ban', $users[$i]->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="border-0 bg-transparent" style="cursor:pointer;"><span class="badge badge-complete">Active</span>
                                </button>
                            </form>
                        @else
                            <form action="{{route('user.unban', $users[$i]->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="border-0 bg-transparent" style="cursor:pointer;"><span class="badge badge-pending">Pending</span></button>
                            </form>
                        @endif
                    </td>
                </tr>

            @endfor
            </tbody>
        </table>

@endsection
