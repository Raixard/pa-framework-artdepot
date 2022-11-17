@extends('layouts.global')

@section('title')
    ArtDepot
@endsection

@section('content')
    <div class="container my-6 mt-20 mx-auto px-6 sm:px-auto">
        @include('components.admin-subnav')
        @if (session('success'))
            <div class="bg-aurora3/40 px-3 py-6 w-full rounded-lg mt-5">
                <b>Yeah!</b> {{ session('success') }}
            </div>
            @endif
        <div class="flex justify-center m-5">
            <table class="border-separate border-spacing-3 w-4/5 table-auto text-xl">
                <thead class="bg-slate-400">
                <tr class="p-5">
                    <th class="p-3">No</th>
                    <th class="p-3">Username</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </t>
                </thead>
                <tbody class="bg-slate-700">
                @php
                    $i=1
                @endphp
                @foreach ($akun as $ban)
                    <tr class="text-center p-5 border-slate-700">
                        <td class="p-3">{{ $i}}</td>
                        <td class="p-3">{{ $ban->username}}</td>
                        <td class="p-3">{{ $ban->status}}</td>
                        <td class="p-3">
                        @if ($ban->status == 'ban')
                                <form action="{{ route('unbannedAkun', $ban->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-blue-400 py-1 px-3 rounded-lg font-medium whitespace-nowrap grow-0 transition-colors hover:bg-blue-300 focus:bg-blue-300"
                                        tabindex="0">
                                        <i class="bi bi-person-check mr-4"></i>Unban
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('bannedAkun', $ban->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-600 py-1 px-3 rounded-lg font-medium whitespace-nowrap grow-0 transition-colors hover:bg-red-500 focus:bg-red-500"
                                        tabindex="0">
                                        <i class="bi bi-person-x mr-4"></i>Ban
                                    </button>
                                </form>
                            @endif
                        </td>

                    </tr>
                    @php
                        $i++
                    @endphp
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection
