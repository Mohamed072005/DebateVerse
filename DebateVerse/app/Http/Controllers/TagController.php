<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->tag_name = '#' . $request->tag_name;
        $request->validate([
            'tag_name' => ['required', 'unique:tags,tag_name']
        ]);

        $tag = $request->tag_name;

        Tag::create([
            'tag_name' => $tag
        ]);

        return redirect()->route('tags')->with('addSuccess', 'Your Tag Created Successfully');
    }

    public function toTags()
    {
        $tags = Tag::all();
        return view('admin.tag', compact('tags'));
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags')->with('addSuccess', 'Your Tag Deleted Successfully');
    }

    public function update(Tag $tag, Request $request)
    {
        $request->validate([
            'tag_name' => ['required', 'unique:tags']
        ]);

        $tagName = '#' . $request->tag_name;

        $tag->update([
            'tag_name' => $tagName
        ]);

        return redirect()->route('tags')->with('addSuccess', 'Your Tag Updated Successfully');
    }
}
