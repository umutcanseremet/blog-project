<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\topic;
use App\Models\Categories;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $topics = topic::paginate(3);
        $cat = Categories::all();
        $set = Settings::all();
        foreach ($topics as $list) {
            $data[] = array(
                'id' => $list->id,
                'title' => $list->topic,
                'slug' => $list->slug,
                'category' => Categories::findOrFail($list->category_id)->category,
                'content' => Str::words($list->text, 30, '...'),
                'date' => $list->created_at->toFormattedDateString(),
                'writer' => $list->writer,
                'image' => asset('/storage/' . Str::afterLast($list->image, 'public/')),
            );
        }

        return view('index', ['topics' => $data, 'pagination' => $topics->links(), 'cat' => $cat, 'set' => $set[0]]);
    }

    public function show($id)
    {
        $cat = Categories::all();
        $set = Settings::all();

        $list = topic::findOrFail($id);

        $data[] = array(
            'title' => $list->topic,
            'content' => $list->text,
            'date' => $list->created_at->toFormattedDateString(),
            'writer' => $list->writer,
            'image' => asset('/storage/' . Str::afterLast($list->image, 'public/')),
        );

        $pre = topic::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $aft = topic::where('id', '>', $id)->orderBy('id', 'asc')->first();

        return view('show', ['topic' => $data, 'pre' => $pre, 'aft' => $aft, 'cat' => $cat,'set'=>$set[0]]);
    }
    public function category($id, $slug)
    {
        $topics = topic::where('category_id', $id)->paginate(3);
        $cat = Categories::all();
        $set = Settings::all();

        foreach ($topics as $list) {
            $data[] = array(
                'id' => $list->id,
                'title' => $list->topic,
                'slug' => $list->slug,
                'category' => Categories::findOrFail($list->category_id)->category,
                'content' => Str::words($list->text, 30, '...'),
                'date' => $list->created_at->toFormattedDateString(),
                'writer' => $list->writer,
                'image' => asset('/storage/' . Str::afterLast($list->image, 'public/')),
                'link' => route('show', [$list->id, $list->slug]),
            );
        }
        if (@$data) {
            return view('category', ['topics' => $data, 'pagination' => $topics->links(), 'cat' => $cat, 'set' => $set[0]]);
        } else {
            echo "Bu sayfa da şuan için içerik yok";
        }
    }

    public function admin()
    {
        if (Auth::check()) {
            $topics = topic::all();
            foreach ($topics as $list) {
                $data[] = array(
                    'id' => $list->id,
                    'title' => $list->topic,
                    'category' => Categories::findOrFail($list->category_id)->category,
                    'date' => $list->created_at->toFormattedDateString(),
                    'writer' => $list->writer,
                    'image' => asset('/storage/' . Str::afterLast($list->image, 'public/')),
                );
            }
            return view('admin.index', ['topics' => $data]);
        } else {
            return redirect()->route('login');
        }
    }

    public function login()
    {
        return view('admin.login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors('Girdiğiniz Bilgiler Hatalı');
        }
    }


    public function create()
    {
        if (Auth::check()) {
            $cat = Categories::all();
            return view('admin/add_new_topic',compact('cat'));
        } else {
            return redirect()->route('login')->withErrors('Öncelikle Giriş Yapmanız Lazım');
        }
    }

    public function store(Request $req)
    {

        $topics = new topic();
        $topics->topic = $req->topic;
        $topics->text = $req->text;
        $topics->writer = $req->writer;
        $topics->category_id = $req->cat;
        $topics->slug = Str::slug($req->topic, '-');
        $path = $req->file('image')->store('public/images');
        $topics->image = $path;

        if ($topics->save()) {
            return back()->with('success', 'Yazı Başarıyla Eklendi 🙂');
        } else {
            return back()->withErrors('fail', 'Kayıt Olmadı');
        }
    }

    public function fun_page()
    {
        $topics = topic::where('topic', '=', 'Eğlence')->get();;
        return view('topics.fun', ['topics' => $topics]);
    }

    public function information_page()
    {
        $topics = topic::where('topic', '=', 'Bilgi')->get();;
        return view('topics.fun', ['topics' => $topics]);
    }

    public function articles_page()
    {
        if (Auth::check()) {
            $topics = topic::get();
            return view('articles', ['topics' => $topics]);
        } else {
            return redirect()->route('login')->withErrors('Öncelikle Giriş Yapmanız Lazım');
        }
    }

    public function destroy($id)
    {
        topic::find($id)->delete();
        return back()->with('success', 'Yazı Başarıyla Silindi 🙂');
    }

    public function edit($id)
    {
        return view('admin.edit', ['data' => topic::findOrFail($id), 'cat' => Categories::all()]);
    }

    public function update(Request $request, $id)
    {

        $post = topic::findOrFail($id);
        $post->topic = $request->topic;
        $post->text = $request->text;
        $post->writer = $request->writer;
        $post->category_id = $request->cat;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $post->image = $path;
        }
        $post->save();

        return back()->with('success', 'Güncellendi 🙂');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('index');
    }
}
