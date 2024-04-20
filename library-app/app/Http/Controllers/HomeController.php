<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {

        $books = Book::take(6)->get();

        return view('home/index', compact('books'));
    }

    public function borrowBook($id) {

        $data = Book::find($id);
        $b_id = $id;
        $quantity = $data->quantity;

        if($quantity >= 1) {

            // user can apply for book.
            
            // if any user is logged in:
            if(Auth::id()) {

                $user_id = Auth::user()->id;

                $borrowed_book = new Borrow();
                $borrowed_book->book_id = $b_id;
                $borrowed_book->user_id = $user_id;
                // $borrowed_book->status = 'Applied';
                $borrowed_book->save();

                return redirect()->back()->with('message', 'Request sent to borrow this book.');
            }

            else {

                return redirect('/login');
            }
        }

        else {

            return redirect()->back()->with('message', 'Not enough book available.');
        }
    }

    public function history() {

        if(Auth::id()) {

            $user_id = Auth::user()->id;

            $data = Borrow::where('user_id', '=', $user_id)->get();

            return view('home/history', compact('data'));
        }
    }

    public function cancelRequest($id) {

        $data = Borrow::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function explorePage() {

        $books = Book::all();

        return view('home/explore', compact('books'));
    }


    public function bookDetails($id) {

        $book = Book::find($id);

        return view('home/bookDetails', ['book' => $book]);
    }

    public function search(Request $request) {

        $search = $request->search;

        $books = Book::where('title', 'LIKE', '%'.$search.'%')->get();

        return view('home/search', compact('books'));
    }

}
