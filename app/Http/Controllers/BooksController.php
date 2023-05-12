<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BooksController extends Controller
{
     public function create(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:60',
            'author' => 'required|max:60',
            'genre' => 'required|max:60',
            'slug' => 'required|max:60',
            'description' => 'required|max:60',
            'isbn' => 'required|numeric',
            'published' => 'required',
            'publisher' =>'required',
        ]);
        return Books::create(
            [
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'slug'  => $request->slug,
                'description' => $request->description,
                'isbn' => $request->isbn,
                'image' => $request->image,
                'published' => $request->published,
                'publisher' => $request->publisher
            ]
            );

    }

    // edit function
    public function edit(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:60',
            'author' => 'required|max:60',
            'genre' => 'required|max:60',
            'slug' => 'required|max:60',
            'description' => 'required|max:60',
            'isbn' => 'required|numeric',
            'published' => 'required',
            'publisher' =>'required',
            'id'=>'required'
        ]);
         return Books::where('id',$request->id)->update(
            [
                'title' => $request->title,
                'author' => $request->author,
                'genre' => $request->genre,
                'slug'  => $request->slug,
                'description' => $request->description,
                'isbn' => $request->isbn,
                'image' => $request->image,
                'published' => $request->published,
                'publisher' => $request->publisher
            ]
            );
    }

    //books data

    public function get_books(){
        return Books::orderBy('id','DESC')->get();
    }

    //dele book

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id'=>'required'
        ]);
         return Books::where('id',$request->id)->delete();
    }

    public function upload(Request $request)
    {
        $this->validate($request,[
           'file' => 'required|mimes:jpeg,jpg,png'
        ]);
     $picname = time().'.'.$request->file->extension();
     $request->file->move(public_path('uploads'),$picname);
     return $picname;
    }

    public function deleteimage(Request $request)
    {
        if(array_key_exists("imagId", $request->all())){
            Books::where('id',$request->imagId)->update([
                'image' => ''
            ]);
            $fileName = $request->imageName;
            $filePath = public_path() . '/uploads/' . $fileName;

            if (file_exists($filePath)) {
                @unlink($filePath);
            }
            return 'done';
        }else{
            $fileName = $request->imageName;
            $this->deleteFileFromServer($fileName);
            return 'done';
        }

    }
    public function deleteFileFromServer($fileName)
    {

        $filePath = public_path() . '/uploads/' . $fileName;

        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        return;
    }

    public function bookpage()
    {
       $books = Books::paginate(3);
       $booksgenre = Books::select('genre')->groupBy('genre')->get();

       return view('book',compact('books','booksgenre'));

    }

    public function bookdetail(Request $request,$id)
    {
       $bookdetail = Books::where('id',$id)->first();

       return view('bookdetail',compact('bookdetail'));

    }
}
