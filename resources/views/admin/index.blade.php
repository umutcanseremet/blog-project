@extends('layouts.admin')
@section('title','Admin')

@section('content')
    <div class="container-fluid m-4">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Kategori</th>
                <th scope="col">Başlık</th>
                <th scope="col">Yazar</th>
                <th scope="col">Tarih</th>
                <th scope="col">İşlemler</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $list)
                <tr>
                    <th>{{$list['id']}}</th>
                    <th>{{$list['category']}}</th>
                    <th>{{$list['title']}}</th>
                    <th>{{$list['writer']}}</th>
                    <th>{{$list['date']}}</th>
                    <th class="d-flex">
                        <a href="{{route('edit',$list['id'])}}">
                            <button class="btn btn-success">Düzenle</button>
                        </a>
                        <form class="px-3" method="post" action="{{route('delete',$list['id'])}}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Sil</button>
                        </form>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
