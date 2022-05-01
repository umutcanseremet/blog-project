@extends('layouts.app')

@section('content')
    @foreach($topic as $list)
@section('title',$list['title'])
<article class="flex flex-col shadow my-4">
    <a  class="hover:opacity-75">
        <img width="300" height="100" src="{{$list['image']}}">
    </a>
    <div class="bg-white flex flex-col justify-start p-6">
        <a  class="text-blue-700 text-sm font-bold uppercase pb-4">Technology</a>
        <a  class="text-3xl font-bold hover:text-gray-700 pb-4">{{$list['title']}}</a>
        <p  class="text-sm pb-8">
            By <a  class="font-semibold hover:text-gray-800">{{$list['writer']}}</a>, Published
            on {{$list['date']}}
        </p>
        <p>{{$list['content']}}</p>
    </div>
    <div class="p-5" id="disqus_thread"></div>
</article>
@endforeach
@endsection

@section('pagination')
    <div class="w-full flex pt-6">
        @if($pre)
            <a href="{{ route('show',[$pre->id,$pre->slug]) }}"
               class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i>
                    Previous</p>
                <p class="pt-2">{{$pre->topic}}</p>
            </a>
        @endif
        @if($aft)
            <a href="{{ route('show',[$aft->id,$aft->slug]) }}"
               class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i
                        class="fas fa-arrow-right pl-1"></i></p>
                <p class="pt-2">{{$aft->topic}}</p>
            </a>
        @endif
    </div>
@endsection

@section('about')
    <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
        <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
            <img src="https://source.unsplash.com/collection/1346951/150x150?sig=1"
                 class="rounded-full shadow h-32 w-32">
        </div>
        <div class="flex-1 flex flex-col justify-center md:justify-start">
            <p class="font-semibold text-2xl">Umut Can Şeremet</p>
            <p class="pt-2">Aşağı da ki sosyal medya linklerimden bana ulaşabilirsiniz.</p>
            <div class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">
                <a target="_blank" class="pl-4" href="{{$set['instagram']}}">
                    <i class="fab fa-instagram"></i>
                </a>
                <a target="_blank" class="pl-4" href="{{$set['linkedin']}}">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
<script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function () { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://localhost-dfayoy4kpt.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
