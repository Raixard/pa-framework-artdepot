@extends('layouts.global')

@section('title')
    ArtDepot
@endsection

@section('content')
    <div class="container my-6 mt-20 mx-auto px-6 sm:px-auto">
        @include('components.admin-subnav')
        <div class="flex justify-center">
            <table class="border-separate border-spacing-3 w-4/5 table-auto text-left">
                <thead class="bg-slate-400">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Username Pelapor</th> 
                    <th class="p-3">Jenis Laporan</th> 
                    <th class="p-3">Isi Laporan</th>
                </tr>
                </thead>
                <tbody class="bg-slate-700">
                @php
                    $i=1
                @endphp
                @foreach ($report as $rpt)
                    <tr>
                        <td class="p-3">{{ $i}}</td>
                        <td class="p-3">{{ $rpt->user->username}}</td>
                        <td class="p-3">{{ $rpt->reportcat->category}}</td>
                        <td class="p-3">{{ $rpt->report_text}}</td>
                    </tr>
                    @php
                        $i++
                    @endphp
                @endforeach
            </tbody>
            </table>
    </div>
@endsection
