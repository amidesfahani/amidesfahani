@extends('arter.master')

@section('content')
    @include('arter.sections.main-slider')

    @include('arter.sections.numbers')

    @include('arter.sections.services')

    {{-- @include('arter.sections.plans') --}}

    {{-- @include('arter.sections.testimonials') --}}

    @include('arter.sections.brands')

    @include('arter.layout.footer')
@endsection
