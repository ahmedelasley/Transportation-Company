@extends('layouts.master')

@section('css')
<style>
    .my-custom-scrollbar {
        position: relative;
        height: 500px;
        overflow: auto;
    }
    .table-wrapper-scroll-y {
    display: block;
    }
</style>
@endsection
@section('content')
    @livewire('questions.show-questions')
@endsection

@section('js')

@endsection
