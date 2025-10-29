@extends('layouts.app')

@section('content')
    {{-- Livewire full-page components render their content via $slot --}}
    {{ $slot ?? '' }}
@endsection
