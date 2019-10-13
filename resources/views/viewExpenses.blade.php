@extends('layouts.master')


@section('content')


    <view-expense :allexpenses="{{json_encode($expenses)}}" :splitname="{{json_encode($splitname)}}" :splithash="{{json_encode($hash)}}" :contributors="{{json_encode($allcontributors)}}">

    </view-expense>
@endsection

