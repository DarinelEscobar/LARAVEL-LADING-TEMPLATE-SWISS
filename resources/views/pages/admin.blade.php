@extends('layouts.admin')
@section('content')
    @switch($section)
        @case(1)
            @livewire('admin.index')
        @break

        @case(2)
            @livewire('admin.create')
        @break

        @case(3)
            @livewire('admin.show',['user' => $user])
        @break

        @case(4)
            @livewire('admin.edit',['user' => $user])
        @break

        @case(5)
            @livewire('admin.dashboard')
        @break

        @default
    @endswitch
@endsection