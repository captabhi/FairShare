@extends('layouts.master')

@section('content')


    <splitdetails :splitdetailsjson="{{json_encode($splitDetails)}}">

    </splitdetails>


@endsection
