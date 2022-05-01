@extends('layouts.app')
@section('title','Homepage')

@section('content')
    @foreach($topics as $list)
        <article class="flex flex-col shadow my-4">
            <a  class="hover:opacity-75">
                <img width="100" height="100" src="{{$list['image']}}">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$list['category']}}</a>
                <a href="{{route('show', [$list['id'], $list['slug']])}}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$list['title']}}</a>
                <p href="#" class="text-sm pb-3">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{$list['writer']}}</a>, Published
                    on {{$list['date']}}
                </p>
                <a href="#" class="pb-6">{{$list['content']}}</a>
                <a href="{{route('show', [$list['id'], $list['slug']])}}" class="uppercase text-gray-800 hover:text-black">Devamını Oku<i
                        class="fas fa-arrow-right"></i></a>
            </div>
        </article>
    @endforeach
    {!! $pagination !!}
@endsection
