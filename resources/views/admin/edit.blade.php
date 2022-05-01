@extends('layouts.admin')
@section('title','Admin')

@section('content')
    <div class="container-fluid">
        <div class="card m-4">
            <div class="card-body">
                <h5 class="card-title">Düzenle</h5>
                <form action="{{route('update',$data->id)}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="form-group my-4">
                        <label for="name">Konu Adı</label>
                        <input type="text" class="form-control" placeholder="Konu İsmini Giriniz" name="topic" min="5"
                               required value="{{$data->topic}}">
                    </div>
                    <div class="form-group my-4">
                        <label for="exampleFormControlTextarea1">Yazı</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" cols="40" rows="10" name="text"
                                  min="10" required name="text">{{$data->text}}</textarea>
                    </div>
                    <div class="my-4">
                        <label class="my-1" for="cat">Kategori</label>
                        <select class="form-select" id="cat" name="cat">
                            @foreach($cat as $list)
                                <option @if($list->id == $data->category_id) selected @endif value="{{$list->id}}">{{$list->category}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group my-4">
                        <label for="writer">Yazar İsmi</label>
                        <input type="text" class="form-control" placeholder="Yazar İsmini Giriniz" name="writer" min="5"
                               required value="{{$data->writer}}">
                    </div>
                    <div class="my-4">
                        <label for="formFile" class="form-label">Resim Seçin</label>
                        <input class="form-control" name="image" type="file" id="formFile" accept="image/*">
                        <br>
                        <img class="border border-1 border-black p-2 m-1" width="100" height="100"
                             src="{{ asset('/storage/' . Str::afterLast($data->image, 'public/')) }}">
                    </div>
                    <button class="btn btn-block btn-primary" type="submit">Konuyu Güncelle</button>
                </form>
            </div>
        </div>
    </div>
@endsection
