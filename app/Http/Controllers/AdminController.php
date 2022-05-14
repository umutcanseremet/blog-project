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
        $set = Settings::first();
        foreach ($topics as $list) {
            $data[] = array(
                'id' => $list->id,
                'title' => $list->topic,
                'slug' => $list->slug,
                'category' => Categories::findOrFail($list->category_id)->category,
                'content' => Str::words($list->text, 30, '...'),
                'date' => $list->created_at->toFormattedDateString(),
                'writer' => $list->writer,
                'image' => asset($list->image),
            );
        }

        return view('index', ['topics' => $data, 'pagination' => $topics->links(), 'cat' => $cat, 'set' => $set]);
    }

    public function show($id,$umut)
    {
        //dd($umut);
        $cat = Categories::all();
        $set = Settings::all();

        $list = topic::findOrFail($id);
        $set = $set[0];
        $topic[] = array(
            'title' => $list->topic,
            'content' => $list->text,
            'date' => $list->created_at->toFormattedDateString(),
            'writer' => $list->writer,
            'image' => asset($list->image),
        );

        $pre = topic::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $aft = topic::where('id', '>', $id)->orderBy('id', 'asc')->first();

        return view('show',compact(['topic','pre','aft','cat','set']));
        //return view('show', ['topic' => $data, 'pre' => $pre, 'aft' => $aft, 'cat' => $cat,'set'=>$set]);
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
        }

        abort(404);
    }

    public function admin()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
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
        }

        return back()->withErrors('Girdiğiniz Bilgiler Hatalı');

    }


    public function create()
    {
        if (Auth::check()) {
            $cat = Categories::all();
            return view('admin/add_new_topic',compact('cat'));
        }
            return redirect()->route('login')->withErrors('Öncelikle Giriş Yapmanız Lazım');
    }

    public function store(Request $req)
    {

        $topics = new topic();
        $topics->topic = $req->topic;
        $topics->text = $req->text;
        $topics->writer = $req->writer;
        $topics->category_id = $req->cat;
        $topics->slug = Str::slug($req->topic, '-');

        $imageName = time().'.'.$req->image->extension();
        $topics->image = $req->image->move('images', $imageName);

        if ($topics->save()) {

            return back()->with('success', 'Yazı Başarıyla Eklendi 🙂');

        }

            return back()->withErrors('fail', 'Kayıt Olmadı');

    }



    public function destroy(topic $id)
    {
        $id->delete();
//        topic::find($id)->delete();
        return back()->with('success', 'Yazı Başarıyla Silindi 🙂');
    }

    public function edit(topic $data)
    {
        $cat = Categories::all();
            return view('admin.edit', compact(['data','cat']));
    }

    public function update(Request $request, $id)
    {

        $post = topic::findOrFail($id);
        $post->topic = $request->topic;
        $post->text = $request->text;
        $post->writer = $request->writer;
        $post->category_id = $request->cat;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $post->image = $request->image->move('images', $imageName);
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
