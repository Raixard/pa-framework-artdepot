@extends('layouts.global')

@section('title')
    ArtDepot
@endsection

@section('content')
    <div class="container my-6 mt-20 mx-auto px-6 sm:px-auto">
        @include('components.admin-subnav')
        <div class="flex justify-center">
            <table>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Report</th>
                </tr>
                @php
                    $i=1
                @endphp
                @foreach ($report as $rpt)
                    <tr>
                        <td>{{ $i}}</td>
                        <td>{{ $rpt->user->username}}</td>
                        <td>{{ $rpt->reportcar->category}}</td>
                        <td>{{ $rpt->report_text}}</td>
                    </tr>
                    @php
                        $i++
                    @endphp
                @endforeach

            </table>
    </div>
@endsection
