<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\Tutorial;
use App\Models\Video;
use Illuminate\Http\Request;
use Auth;

class CustomizeController extends Controller
{
    public function tutorial()
    {
        $data = Tutorial::with('user')->get();
        return view('admin.tutorial.index', compact('data'));
    }
    public function createTutorial()
    {
        return view('admin.tutorial.create');
    }

    public function editTutorial($id)
    {
        $data = Tutorial::where('id', $id)->with('user')->first();
        return view('admin.tutorial.edit', compact('data'));
    }

    public function storeTutorial(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
        ]);
        $post = new Tutorial;
        $post->name = $request->name;
        $post->link = $request->link;
        $post->created_by = Auth::id();
        $post->save();
        toast('Success Toast', 'success');
        return redirect('/admin/customize/tutorial');
    }

    public function updateTutorial(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
        ]);

        $post = Tutorial::find($id);
        $post->name = $request->name;
        $post->link = $request->link;
        $post->created_by = Auth::id();
        $post->save();
        return redirect('/admin/customize/tutorial');
    }

    public function deleteTutorial($id)
    {
        Tutorial::destroy($id);
        return redirect('/admin/customize/tutorial');
    }

    public function promo()
    {
        $data = Promo::with('user')->get();
        return view('admin.promo.index', compact('data'));
    }
    public function createPromo()
    {
        return view('admin.promo.create');
    }

    public function editPromo($id)
    {
        $data = Promo::where('id', $id)->with('user')->first();
        return view('admin.promo.edit', compact('data'));
    }

    public function storePromo(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
        ]);
        if($request->file){
            $fileName = time().'.'.$request->file->extension();
            $request->file->move('uploads/admin/promo/'.date('Y/m/'), $fileName);
            $post = new Promo;
            $post->name = $request->name;
            $post->link ='uploads/admin/promo/'.date('Y/m/').$fileName;
            $post->start_date = $request->start_date;
            $post->end_date = $request->end_date;
            $post->created_by = Auth::id();
            $post->save();
        }else{
            $post = new Promo;
            $post->name = $request->name;
            $post->link = null;
            $post->start_date = $request->start_date;
            $post->end_date = $request->end_date;
            $post->created_by = Auth::id();
            $post->save();
        }

        toast('Success Toast', 'success');
        return redirect('/admin/customize/promo');
    }

    public function updatePromo(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
        ]);
        if($request->file){
            $fileName = time().'.'.$request->file->extension();
            $request->file->move('uploads/admin/promo/'.date('Y/m/'), $fileName);
            $post = Promo::find($id);
            $post->name = $request->name;
            $post->link ='uploads/admin/promo/'.date('Y/m/').$fileName;
            $post->start_date = $request->start_date;
            $post->end_date = $request->end_date;
            $post->created_by = Auth::id();
            $post->save();
        }else{
            $post = Promo::find($id);
            $post->name = $request->name;
            $post->link = null;
            $post->start_date = $request->start_date;
            $post->end_date = $request->end_date;
            $post->created_by = Auth::id();
            $post->save();
        }

        return redirect('/admin/customize/promo');
    }

    public function deletePromo($id)
    {
        Promo::destroy($id);
        return redirect('/admin/customize/promo');
    }

    public function video()
    {
        $data = Video::with('user')->get();
        return view('admin.video.index', compact('data'));
    }

    public function createVideo()
    {
        return view('admin.video.create');
    }

    public function editVideo($id)
    {
        $data = Video::where('id', $id)->with('user')->first();
        return view('admin.video.edit', compact('data'));
    }

    public function storeVideo(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
        ]);
        $post = new Video;
        $post->name = $request->name;
        $post->link = $request->link;
        $post->created_by = Auth::id();
        $post->save();
        toast('Success Toast', 'success');
        return redirect('/admin/customize/video');
    }

    public function updateVideo(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
        ]);

        $post = Video::find($id);
        $post->name = $request->name;
        $post->link = $request->link;
        $post->created_by = Auth::id();
        $post->save();
        return redirect('/admin/customize/video');
    }

    public function deleteVideo($id)
    {
        Video::destroy($id);
        return redirect('/admin/customize/video');
    }
}
