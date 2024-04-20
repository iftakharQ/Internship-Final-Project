<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {

        if (Auth::id()) {

            $user_type = Auth()->user()->usertype;
            if ($user_type == 'admin') {

                $data = Borrow::all();

                $userCount = User::where('usertype', 'user')->count();
                $bookCount = Book::all()->count();
                $borrowedBooks = Borrow::where('status', 'approved')->count();
                $pendingRequests = Borrow::where('status', 'Not approved')->count();

                return view('admin/index', compact('data', 'userCount', 'bookCount', 'borrowedBooks', 'pendingRequests'));
            } else {

                $books = Book::take(6)->get();

                return view('home/index', compact('books'));
            }
        } else {

            return redirect()->back();
        }
    }

    public function categoryPage()
    {

        $data = Category::all();

        return view('admin/category', compact('data'));
    }

    public function addCategory(Request $request)
    {

        $category = new Category();
        $category->cat_title = $request->input('cat_title');
        $category->save();
        return redirect()->back()->with('message', 'Category added successfully!');
    }

    public function deleteCategory($id)
    {

        $category = Category::find($id);
        $category->delete();
        return redirect()->back();
    }

    public function addBookPage()
    {

        $data = Category::all();

        return view('admin/addBook', compact('data'));
    }
    public function addBooks(Request $request)
    {

        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->quantity = $request->input('quantity');

        $book->book_image = $request->file('book_img')->getClientOriginalName();
        $request->file('book_img')->move('uploads/', $book->book_image);

        $book->category_id = $request->input('cat_id');
        $book->save();
        return redirect()->back()->with('message', 'Book added successfully!');
    }

    public function showBooks()
    {

        $data = Book::all();

        return view('admin/showBooks', compact('data'));
    }

    public function deleteBook($id)
    {

        $book = Book::find($id);
        $book->delete();
        return redirect()->back();
    }

    public function editBook($id)
    {

        $data = Book::find($id);
        $category = Category::all();

        return view('admin/updateBook', [
            'book' => $data,
            'categories' => $category
        ]);
    }
    public function updateBook(Request $request)
    {

        $book = Book::find($request->input('id'));
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->quantity = $request->input('quantity');

        $book->book_image = $request->file('book_img')->getClientOriginalName();
        $request->file('book_img')->move('uploads/', $book->book_image);

        $book->category_id = $request->input('cat_id');
        $book->save();
        return redirect()->back()->with('message', 'Book updated successfully!');
    }

    // Status update:
    public function approveBook($id)
    {

        $data = Borrow::find($id);

        $status = $data->status;

        if($status == 'approved') {

            return redirect()->back()->with('message', 'Book is already approved.');
        }

        else {

            $data->status = 'approved';
            $data->save();

            $book_id = $data->book_id;
            $book = Book::find($book_id);
            $book_qty = $book->quantity - 1;
            $book->quantity = $book_qty;
            $book->save();

            return redirect()->back()->with('message', 'Book has been approved.');
        }
    }

    public function returnBook($id)
    {

        $data = Borrow::find($id);

        $status = $data->status;

        if($status == 'returned') {

            return redirect()->back()->with('message', 'Book is already returned.');
        }

        else {

            $data->status = 'returned';
            $data->save();

            $book_id = $data->book_id;
            $book = Book::find($book_id);
            $book_qty = $book->quantity + 1;
            $book->quantity = $book_qty;
            $book->save();

            return redirect()->back()->with('message', 'Book has been returned.');
        }
    }

    public function notApproveBook($id) {

        $data = Borrow::find($id);
        $data->status = 'Not approved';
        $data->save();
        
        return redirect()->back()->with('message', 'Book is not approved.');
    }
}
