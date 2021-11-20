<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import()
    {
        Excel::load('acuerdos.xlsx', function ($reader) {
            foreach ($reader->get() as $book) {
                Book::create([
                    'name' => $book->title, //falta modificar cada campo de acuerdo al xlsx
                    'author' => $book->author,
                    'year' => $book->publication_year,
                ]);
            }
        });
        return Book::all();
    }
}