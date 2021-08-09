@extends('layouts.app')

@section('content')

@if (Auth::check())
<app></app>
@else
<script>
  window.location = "/login";
</script>
@endif
@endsection