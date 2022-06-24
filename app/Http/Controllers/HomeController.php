<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Brand;
use App\Models\Education;
use App\Models\History;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        
        $services = Service::where('language', $locale)->orderBy('displayorder')->get();
        $testimonials = Testimonial::where('language', $locale)->orderBy('displayorder')->get();
        $brands = Brand::whereNotNull('logo')->orderBy('displayorder')->get();
        $educations = Education::with('documents')->orderBy('displayorder')->get();
        $work_history = History::with('testimonials')->orderBy('displayorder')->get();

        $plans = null;

        return view('arter.pages.home', [
            'services' => $services,
            'plans' => $plans,
            'testimonials' => $testimonials,
            'brands' => $brands,
            'educations' => $educations,
            'work_history' => $work_history
        ]);
    }

    public function portfolios()
    {
        $portfolios = Project::with(['images', 'cover', 'categories', 'tags', 'status', 'city'])->where('active', 1)->orderBy('displayorder')->get();

        return view('arter.pages.portfolios', [
            'portfolios' => $portfolios
        ]);
    }

    public function portfolio(Request $request)
    {
        $portfolio = Project::with([
            'images',
            'cover',
            'categories',
            'tags',
            'status',
            'city',
            'testimonials' => function ($query) {
                return $query->where('language', app()->getLocale());
            },
            'client'
        ])->where('active', 1)->where('id', $request->portfolio)->first();

        // get previous project
        $prevProject = Project::with([
            'images',
            'cover',
            'categories',
            'tags',
            'status',
            'city',
            'testimonials',
            'client'
        ])->where('active', 1)->where('id', '<', $portfolio->id)->orderBy('id')->first();

        // get next project
        $nextProject = Project::with([
            'images',
            'cover',
            'categories',
            'tags',
            'status',
            'city',
            'testimonials',
            'client'
        ])->where('active', 1)->where('id', '>', $portfolio->id)->orderBy('id', 'desc')->first();

        return view('arter.pages.portfolio', [
            'portfolio' => $portfolio,
            'prevProject' => $prevProject,
            'nextProject' => $nextProject
        ]);
    }

    public function history()
    {
        $educations = Education::with(['documents'])->where('active', 1)->orderBy('displayorder')->get();
        $histories = History::with(['testimonials'])->where('active', 1)->orderBy('displayorder')->get();

        return view('arter.pages.history', [
            'educations' => $educations,
            'histories' => $histories
        ]);
    }

    public function contact()
    {
        return view('arter.pages.contact', []);
    }

    public function storeContact(Request $request)
    {
        $maildata = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
        Mail::to('amid.esfahani@yahoo.com')->send(new ContactMail($maildata));

        return [
            'success' => true
        ];
    }
}
