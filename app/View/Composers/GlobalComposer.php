<?php
 
namespace App\View\Composers;
 
use App\Models\Link;
use App\Models\User;
use App\Models\Skill;
use App\Models\DataText;
use App\Models\JobTitle;
use App\Models\Language;
use App\Models\DataImage;
use App\Models\DataNumber;
use App\Models\DataString;
use App\Models\ExtraSkill;
use Illuminate\View\View;
 
class GlobalComposer
{
    public function __construct()
    {
    }
 
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
		$user = User::where('id', 1)->with(['profile', 'profiles'])->first();
        $languages = Language::orderBy('displayorder')->get();
        $titles = JobTitle::orderBy('displayorder')->get();
        $links = Link::orderBy('displayorder')->get();
        $skills = Skill::orderBy('displayorder')->get();
        $extra_skills = ExtraSkill::orderBy('displayorder')->get();

		$numbers = DataNumber::all();
        $strings = DataString::all();
        $texts = DataText::all();
        $images = DataImage::all();

        $_skills = [];
        foreach ($skills as $skill) {
            $_skills[$skill->grouporder][] = $skill;
        }

		$view->with('user', $user)
			->with('languages', $languages)
			->with('titles', $titles)
			->with('links', $links)
			->with('skills', $_skills)
			->with('extra_skills', $extra_skills)
			->with('numbers', $numbers)
			->with('strings', $strings)
			->with('texts', $texts)
			->with('images', $images);
    }
}