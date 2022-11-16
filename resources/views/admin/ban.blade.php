@extends('layouts.global')

@section('title')
    ArtDepot
@endsection

@section('content')
    <div class="container my-6 mt-20 mx-auto px-6 sm:px-auto">
        @include('components.admin-subnav')
        <div class="flex justify-center">
            <table class="border-separate w-4/5 border-2 border-slate-500">
                <tr class="border-2 border-slate-700">
                    <th>No</th>
                    <th>User</th>
                    <th>Status</th>
                </tr>
                @php
                    $i=1
                @endphp
                @foreach ($akun as $ban)
                    <tr class="text-center">
                        <td>{{ $i}}</td>
                        <td>{{ $ban->username}}</td>
                        <td>{{ $ban->status}}</td>
                    </tr>
                    @php
                        $i++
                    @endphp
                @endforeach

            </table>
        </div>
    </div>
@endsection
