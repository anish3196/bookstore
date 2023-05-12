<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class MainController extends Controller
{
    public function bookpage()
    {
       $books = Books::paginate(10);
       $genres = Books::select('genre')->groupBy('genre')->get();
       $titles = Books::select('title')->groupBy('title')->get();
       $authors = Books::select('author')->groupBy('author')->get();
       $isbns = Books::select('isbn')->groupBy('isbn')->get();
       $publishers = Books::select('publisher')->groupBy('publisher')->get();
       $search = "no";

       return view('book',compact('books','search','titles','genres','authors','isbns','publishers'));

    }

    public function bookdetail(Request $request,$id)
    {
       $bookdetail = Books::where('id','=',$id)->first();;

       return view('partials.booksdata',compact('bookdetail','id'));

    }

    public function booksearch(Request $request)
    {
        $search = "yes";
        $genres = Books::select('genre')->groupBy('genre')->get();
        $titles = Books::select('title')->groupBy('title')->get();
        $authors = Books::select('author')->groupBy('author')->get();
        $isbns = Books::select('isbn')->groupBy('isbn')->get();
        $publishers = Books::select('publisher')->groupBy('publisher')->get();
        $books = Books::where(function($query) use($request) {
                 if($request['title'] && $request['title']!='')
                 {
                     $query->where('title', '=', $request['title']);
                 }

            })
            ->where(function($query) use($request) {
                 if($request['author'] && $request['author']!='')
                 {
                     $query->where('author', '=', $request['author']);
                 }

            })
            ->where(function($query) use($request) {
                 if($request['genre'] && $request['genre']!='')
                 {
                     $query->where('genre', '=', $request['genre']);
                 }

            })
            ->where(function($query) use($request) {
                 if($request['isbn'] && $request['isbn']!='')
                 {
                     $query->where('isbn', '=', $request['isbn']);
                 }

            })
            ->where(function($query) use($request) {
                if($request['publisher'] && $request['publisher']!='')
                {
                    $query->where('publisher', '=', $request['publisher']);
                }

           })
           ->where(function($query) use($request) {
            if($request['published'] && $request['published']!='')
            {
                $query->where('published', '=', $request['published']);
            }

       })
            ->paginate(10);


        $request['published'] =  $request['published'];
        $request['publisher'] = $request['publisher'];
        $request['isbn']  = $request['isbn'];
        $request['genre'] =  $request['genre'];
        $request['author'] = $request['author'];
        $request['title']  = $request['title'];

        return view('book', compact('books','request','search','titles','genres','authors','isbns','publishers'));
    }
}
