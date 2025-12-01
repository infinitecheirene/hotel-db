<?php

namespace App\Http\Controllers;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonials::all();
        return response()->json($testimonials);
    }
}
