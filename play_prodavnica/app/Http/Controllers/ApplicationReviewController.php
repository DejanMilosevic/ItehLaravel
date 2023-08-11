<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewCollection;
use App\Models\Review;
use Illuminate\Http\Request;

class ApplicationReviewController extends Controller
{
    public function index($application_id){
        $reviews = Review::get()->where('application_id', $application_id);
        if(is_null($reviews)){
            return response()->json('Aplikacija nije pronadjena.');
        }
        return new ReviewCollection($reviews);
    }
}
