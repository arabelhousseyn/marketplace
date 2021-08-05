@extends('master.master')
@section('title','main')
    @section('content')
        <div id="app">
            <main-vue auth="{{ Auth::user() }}" />
        </div>
@endsection