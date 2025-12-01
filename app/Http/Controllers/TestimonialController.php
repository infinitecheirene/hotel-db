<?php

namespace App\Http\Controllers;
use App\Models\Testimonials;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonials::all();
        return response()->json($testimonials);
    }
}
