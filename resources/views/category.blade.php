@extends('layouts.app')

@section('content')
    @foreach($topics as $list)
@section('title',$list['category'])
<article class="flex flex-col shadow my-4">
    <a href="#" class="hover:opacity-75">
        <img width="100" height="100" src="{{$list['image']}}">
    </a>
    <div class="bg-white flex flex-col justify-start p-6">
        <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$list['category']}}</a>
        <a href="{{$list['link']}}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$list['title']}}</a>
        <p href="#" class="text-sm pb-3">
            By <a href="#" class="font-semibold hover:text-gray-800">{{$list['writer']}}</a>, Published
            on {{$list['date']}}
        </p>
        <a href="#" class="pb-6">{{$list['content']}}</a>
        <a href="{{$list['link']}}" class="uppercase text-gray-800 hover:text-black">Devamı İçin Tıklayın<i
                class="fas fa-arrow-right"></i></a>
    </div>
</article>
@endforeach
{!! $pagination !!}
@endsection
