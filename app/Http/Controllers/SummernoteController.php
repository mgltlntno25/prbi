<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Summernote;

use Illuminate\Support\Facades\App;

class SummernoteController extends Controller
{


    /**



     *



     * @return \Illuminate\Http\Response



     */



    public function getSummernoteeditor()
    {
        return view('richtext');
    }

    public function postSummernoteeditor(Request $request)
    {

        $this->validate($request, [
            'detail' => 'required',
            'feature' => 'required',
        ]);



        $title = $request->input('title');
        $description = $request->input('description');
        $dom = new \DomDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            if (substr($img->getattribute(‘src’), 0, 4) != ’http’) {
                $data = $img->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = "/upload/" . time() . $k . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $detail = $dom->saveHTML();
        $summernote = new Summernote;
        $summernote->$title = $request->$title;
        $summernote->$description = $request->$description;
        $summernote->save();
    }

    public function updateSummernote(Request $request, $id)
    {

        $summernote = \App\Announcement::find($id);

        $dom = new \DomDocument();
        $dom->loadHtml($request->description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name = "/upload/" . time() . $k . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $detail = $dom->saveHTML();
        $summernote->title = $request->title;
        $summernote->description = $request->description;
        $summernote->save();

        return redirect()->back()->with('message', 'Banner successfully added.');
    }
}
