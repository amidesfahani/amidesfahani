<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Link;
use App\Models\User;
use App\Models\Brand;
use App\Models\Skill;
use App\Models\Country;
use App\Models\History;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Category;
use App\Models\JobTitle;
use App\Models\Language;
use App\Models\Education;
use App\Models\DataNumber;
use App\Models\DataString;
use App\Models\DataText;
use App\Models\ExtraSkill;
use App\Models\Status;
use App\Models\Testimonial;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $user = User::find(1);

        Profile::create([
            'user_id' => $user->id,
            'language' => 'en',
            'title' => 'Full Stack Developer',
            'country' => 'Iran',
            'city' => 'Bandar\'e Abbas',
            'street' => 'Azadegan'
        ]);

        Profile::create([
            'user_id' => $user->id,
            'language' => 'fa',
            'title' => 'Full Stack Developer',
            'country' => 'ایران',
            'city' => 'بندرعباس',
            'street' => 'آزادگان'
        ]);

        Language::create([
            'title' => 'Farsi',
            'title_fa' => 'فارسی',
            'flag' => 'fa',
            'power' => 100,
            'displayorder' => 0
        ]);

        Language::create([
            'title' => 'English',
            'title_fa' => 'انگلیسی',
            'flag' => 'en',
            'power' => 90,
            'displayorder' => 0
        ]);

        JobTitle::create([
            'title' => 'Full Stack Developer',
            'title_fa' => 'برنامه نویس فول استک',
            'displayorder' => 0
        ]);

        JobTitle::create([
            'title' => 'Ui/UX Designer',
            'title_fa' => 'طراح صفحه وب',
            'displayorder' => 10
        ]);

        Link::create([
            'slug' => 'instagram',
            'title' => 'Instagram',
            'title_fa' => 'اینستاگرام',
            'account' => 'amidesfahani',
            'icon' => 'fa-brands fa-instagram',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>',
            'pattern' => 'https://www.instagram.com/{account}/',
            'displayorder' => 0
        ]);

        Link::create([
            'slug' => 'github',
            'title' => 'Github',
            'title_fa' => 'گیت هاب',
            'account' => 'amidesfahani',
            'icon' => 'fa-brands fa-github',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/></svg>',
            'pattern' => 'https://github.com/{account}/',
            'displayorder' => 0
        ]);

        Link::create([
            'slug' => 'linkedin',
            'title' => 'LinkedIn',
            'title_fa' => 'لینکدین',
            'account' => 'amid-esfahani-685844102',
            'icon' => 'fa-brands fa-linkedin',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/></svg>',
            'pattern' => 'https://www.linkedin.com/in/{account}/',
            'displayorder' => 0
        ]);

        Link::create([
            'slug' => 'stack-overflow',
            'title' => 'Stack Overflow',
            'title_fa' => 'استک اورفلو',
            'account' => '2848135/amid',
            'icon' => 'fa-brands fa-stack-overflow',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M290.7 311 95 269.7 86.8 309l195.7 41zm51-87L188.2 95.7l-25.5 30.8 153.5 128.3zm-31.2 39.7L129.2 179l-16.7 36.5L293.7 300zM262 32l-32 24 119.3 160.3 32-24zm20.5 328h-200v39.7h200zm39.7 80H42.7V320h-40v160h359.5V320h-40z"/></svg>',
            'pattern' => 'https://stackoverflow.com/users/{account}/',
            'displayorder' => 0
        ]);

        Link::create([
            'slug' => 'whatsapp',
            'title' => 'Whatsapp',
            'title_fa' => 'واتساپ',
            'account' => '+989171585814',
            'icon' => 'fa-brands fa-whatsapp',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>',
            'pattern' => 'https://wa.me/{account}/',
            'displayorder' => 0
        ]);

        Link::create([
            'slug' => 'telegram',
            'title' => 'Telegram',
            'title_fa' => 'تلگرام',
            'account' => 'amidesfahani',
            'icon' => 'fa-brands fa-telegram',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M248 8C111.033 8 0 119.033 0 256s111.033 248 248 248 248-111.033 248-248S384.967 8 248 8Zm114.952 168.66c-3.732 39.215-19.881 134.378-28.1 178.3-3.476 18.584-10.322 24.816-16.948 25.425-14.4 1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25 5.342-39.5 3.652-3.793 67.107-61.51 68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608 69.142-14.845 10.194-26.894 9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7 18.45-13.7 108.446-47.248 144.628-62.3c68.872-28.647 83.183-33.623 92.511-33.789 2.052-.034 6.639.474 9.61 2.885a10.452 10.452 0 0 1 3.53 6.716 43.765 43.765 0 0 1 .417 9.769Z"/></svg>',
            'pattern' => 'https://t.me/{account}/',
            'displayorder' => 0
        ]);

        Link::create([
            'slug' => 'twitter',
            'title' => 'Twitter',
            'title_fa' => 'توویتر',
            'account' => 'amidesfahani',
            'icon' => 'fa-brands fa-twitter',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg>',
            'pattern' => 'https://twitter.com/{account}/',
            'displayorder' => 0
        ]);

        Link::create([
            'slug' => 'google',
            'title' => 'Gmail',
            'title_fa' => 'جیمیل',
            'account' => 'amidesfahani@gmail.com',
            'icon' => 'fa-brands fa-google',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/></svg>',
            'pattern' => '',
            'displayorder' => 0
        ]);

        Link::create([
            'slug' => 'yahoo',
            'title' => 'Yahoo',
            'title_fa' => 'یاهو',
            'account' => 'amidesfahani@yahoo.com',
            'icon' => 'fa-brands fa-yahoo',
            'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M223.69 141.06 167 284.23l-56-143.17H14.93l105.83 249.13L82.19 480h94.17l140.91-338.94Zm105.4 135.79a58.22 58.22 0 1 0 58.22 58.22 58.22 58.22 0 0 0-58.22-58.22ZM394.65 32l-93 223.47h104.79L499.07 32Z"/></svg>',
            'pattern' => '',
            'displayorder' => 0
        ]);

        Skill::create([
            'title' => 'html',
            'title_fa' => '',
            'power' => 95,
            'displayorder' => 0
        ]);

        Skill::create([
            'title' => 'CSS',
            'title_fa' => '',
            'power' => 90,
            'displayorder' => 1
        ]);

        Skill::create([
            'title' => 'Js',
            'title_fa' => '',
            'power' => 85,
            'displayorder' => 2
        ]);

        Skill::create([
            'title' => 'PHP',
            'title_fa' => '',
            'power' => 85,
            'displayorder' => 3
        ]);

        Skill::create([
            'title' => 'Laravel',
            'title_fa' => '',
            'power' => 90,
            'displayorder' => 4
        ]);

        Skill::create([
            'title' => 'Wordpress',
            'title_fa' => '',
            'power' => 75,
            'displayorder' => 5
        ]);

        ExtraSkill::create([
            'title' => 'Bootstrap, Materialize',
            'displayorder' => 0
        ]);
        ExtraSkill::create([
            'title' => 'Stylus, Sass, Less',
            'displayorder' => 0
        ]);
        ExtraSkill::create([
            'title' => 'Gulp, Webpack, Grunt',
            'displayorder' => 0
        ]);
        ExtraSkill::create([
            'title' => 'GIT knowledge',
            'displayorder' => 0
        ]);

        Service::create([
            'title' => 'Web Development',
            'language' => 'en',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus esse commodi deserunt vitae, vero quasi! Veniam quaerat tenetur pariatur doloribus.',
            'displayorder' => 0
        ]);

        Service::create([
            'title' => 'UI/UX Design',
            'language' => 'en',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus esse commodi deserunt vitae, vero quasi! Veniam quaerat tenetur pariatur doloribus.',
            'displayorder' => 0
        ]);

        Service::create([
            'title' => 'Advertising',
            'language' => 'en',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus esse commodi deserunt vitae, vero quasi! Veniam quaerat tenetur pariatur doloribus.',
            'displayorder' => 0
        ]);

        DataNumber::create([
            'key' => 'Experience', 'value' => Carbon::createFromFormat('Y-m-d', '2013-2-17')->diff()->y
        ]);
        DataNumber::create([
            'key' => 'Projects', 'value' => 143
        ]);
        DataNumber::create([
            'key' => 'HappyCustomers', 'value' => 114
        ]);
        DataNumber::create([
            'key' => 'Awards', 'value' => 20
        ]);

        Testimonial::create([
            'title' => $faker->name(),
            'subtitle' => $faker->name(),
            'language' => 'en',
            'description' => 'Working with Artur has been a pleasure. Better yet - I alerted them of a minor issue before going to sleep. The issue was fixed the next morning. I couldn\'t ask for better support. Thank you Artur! This is easily a 5 star freelancer.',
            'stars' => rand(3,5),
            'image' => '/assets/dummy/testimonials/face-1.jpg',
            'displayorder' => rand(0,10)
        ]);
        Testimonial::create([
            'title' => $faker->name(),
            'subtitle' => $faker->name(),
            'language' => 'en',
            'description' => 'Working with Artur has been a pleasure. Better yet - I alerted them of a minor issue before going to sleep. The issue was fixed the next morning. I couldn\'t ask for better support. Thank you Artur! This is easily a 5 star freelancer.',
            'stars' => rand(3,5),
            'image' => '/assets/dummy/testimonials/face-2.jpg',
            'displayorder' => rand(0,10)
        ]);
        Testimonial::create([
            'title' => $faker->name(),
            'subtitle' => $faker->name(),
            'language' => 'en',
            'description' => 'Working with Artur has been a pleasure. Better yet - I alerted them of a minor issue before going to sleep. The issue was fixed the next morning. I couldn\'t ask for better support. Thank you Artur! This is easily a 5 star freelancer.',
            'stars' => rand(3,5),
            'image' => '/assets/dummy/testimonials/face-3.jpg',
            'displayorder' => rand(0,10)
        ]);
        Testimonial::create([
            'title' => $faker->name(),
            'subtitle' => $faker->name(),
            'language' => 'en',
            'description' => 'Working with Artur has been a pleasure. Better yet - I alerted them of a minor issue before going to sleep. The issue was fixed the next morning. I couldn\'t ask for better support. Thank you Artur! This is easily a 5 star freelancer.',
            'stars' => rand(3,5),
            'image' => '/assets/dummy/testimonials/face-4.jpg',
            'displayorder' => rand(0,10)
        ]);

        Brand::create([
            'title' => $faker->name(),
            'title_fa' => $faker->name(),
            'logo' => '/assets/dummy/brands/1.png',
            'displayorder' => rand(0,10)
        ]);
        Brand::create([
            'title' => $faker->name(),
            'title_fa' => $faker->name(),
            'logo' => '/assets/dummy/brands/2.png',
            'displayorder' => rand(0,10)
        ]);
        Brand::create([
            'title' => $faker->name(),
            'title_fa' => $faker->name(),
            'logo' => '/assets/dummy/brands/3.png',
            'displayorder' => rand(0,10)
        ]);

        $educations = [
            [
                'name' => 'University of toronto',
                'title' => 'Student',
                'from' => 'jan 2018',
                'to' => 'may 2020',
                'descrption' => 'Dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.',
                'documents' => [
                    [
                        'title' => 'Diplome',
                        'image' => 'assets/dummy/certificate.jpg',
                    ]
                ]
            ],
            [
                'name' => 'Arter design school',
                'title' => 'Student',
                'from' => 'jan 2018',
                'to' => 'may 2020',
                'descrption' => 'Consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?',
                'documents' => []
            ],
            [
                'name' => 'Web developer courses',
                'title' => 'Student',
                'from' => 'jan 2018',
                'to' => 'may 2020',
                'descrption' => 'Dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.',
                'documents' => [
                    [
                        'title' => 'Licence',
                        'image' => 'assets/dummy/certificate.jpg',
                    ]
                ]
            ],
            [
                'name' => 'Academy of Art University',
                'title' => 'Student',
                'from' => 'jan 2018',
                'to' => 'may 2020',
                'descrption' => 'Ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum.',
                'documents' => [
                    [
                        'title' => 'Certificate',
                        'image' => 'assets/dummy/certificate.jpg',
                    ]
                ]
            ],
        ];
        foreach ($educations as $education) {
            $start = now()->subYear(rand(3,8))->subMonths(rand(1,12))->subDays(rand(1,30));
            $edu = Education::create([
                'title' => $education['name'],
                'role' => $education['title'],
                'description' => $education['descrption'],
                'start_date' => $start,
                'end_date' => $start->addMonths(10,30),
            ]);
            foreach ($education['documents'] as $documents) {
                $edu->documents()->create([
                    'title' => $documents['title'],
                    'image' => $documents['image'],
                ]);
            }
        }

        $work_history = [
            [
                'name' => 'Envato',
                'title' => 'Template author',
                'descrption' => 'Placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis quiut.',
            ],
            [
                'name' => 'Themeforest',
                'title' => 'Template author',
                'descrption' => 'Adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?',
            ],
            [
                'name' => 'Envato market',
                'title' => 'Template author',
                'descrption' => 'Consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique earum voluptatem doloremque dolorem ipsam quae rerum quis. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat consequuntur perferendis enim amet quae quasi repudiandae sed quod veniam dolore possimus rem voluptatum eveniet eligendi quis fugiat aliquam sunt similique aut adipisci. ',
            ],
            [
                'name' => 'SoftService company',
                'title' => 'Template author',
                'descrption' => 'Dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum.',
            ],
        ];

        foreach ($work_history as $work) {
            $start = now()->subYear(rand(3,8))->subMonths(rand(1,12))->subDays(rand(1,30));
            $wh = History::create([
                'title' => $work['name'],
                'role' => $work['title'],
                'description' => $work['descrption'],
                'date_start' => $start,
                'date_end' => $start->addMonths(10,30),
            ]);
            if (rand(1,2) == 1)
            {
                for ($i=1;$i<=rand(1,3);$i++) {
                    $comment = Testimonial::create([
                        'title' => $faker->name(),
                        'subtitle' => $faker->name(),
                        'language' => 'en',
                        'description' => 'Working with Artur has been a pleasure. Better yet - I alerted them of a minor issue before going to sleep. The issue was fixed the next morning. I couldn\'t ask for better support. Thank you Artur! This is easily a 5 star freelancer.',
                        'stars' => rand(3,5),
                        'image' => '/assets/dummy/testimonials/face-'.rand(1,4).'.jpg',
                        'displayorder' => rand(0,10),
                    ]);
                    $wh->testimonials()->attach($comment->id);
                }
            }
        }

        $tehran = City::create([
            'country' => 'ir',
            'title' => 'Tehran',
            'title_fa' => 'تهران'
        ]);

        Category::create([
            'title' => 'Web Development',
            'title_fa' => 'توسعه وب'
        ]);
        Category::create([
            'title' => 'Laravel Development',
            'title_fa' => 'توسعه لاراول'
        ]);
        Category::create([
            'title' => 'Graphic',
            'title_fa' => 'طراحی'
        ]);

        Status::create([
            'title' => 'Under Construction',
            'title_fa' => 'در دست ساخت'
        ]);

        Status::create([
            'title' => 'Completed',
            'title_fa' => 'تکمیل شده'
        ]);

        Status::create([
            'title' => 'Deprecated',
            'title_fa' => 'منسوخ'
        ]);

        Status::create([
            'title' => 'Refactored',
            'title_fa' => 'بازسازی شده'
        ]);

        Status::create([
            'title' => 'Redesign',
            'title_fa' => 'طراحی مجدد'
        ]);

        Status::create([
            'title' => 'Unchanged',
            'title_fa' => 'بدون تغییر'
        ]);

        $start = now()->subYear(rand(3,8))->subMonths(rand(1,12))->subDays(rand(1,30));
        $project = Project::create([
            'title' => 'Project Name',
            'subtitle' => 'Full Stack Developer- CTO',
            'title_fa' => 'نام پروژه',
            'subtitle_fa' => 'Full Stack Developer- CTO',
            'about' => 'Perferendis modi tempora, minus facere! Animi ipsam explicabo beatae soluta qui repellat minus perspiciatis placeat doloribus praesentium laborum debitis error sed ex nisi, ipsum ad obcaecati assumenda ut recusandae. Vero, voluptate, magni unde accusantium vel ducimus expedita!',
            'description' => 'Perferendis modi tempora, minus facere! Animi ipsam explicabo beatae soluta qui repellat minus perspiciatis placeat doloribus praesentium laborum debitis error sed ex nisi, ipsum ad obcaecati assumenda ut recusandae. Vero, voluptate, magni unde accusantium vel ducimus expedita!',
            'about_fa' => '',
            'description_fa' => '',
            'order_date' => $start,
            'final_date' => $start->addMonths(10,30),
            'link' => 'https://www.google.com/',
            'status_id' => Status::inRandomOrder()->first()->id,
            'city_id' => $tehran->id,
            'displayorder' => rand(0,10),
        ]);

        $project->images()->create([
            'image' => '/assets/dummy/works/1.jpg', 'cover' => 1
        ]);
        $project->images()->create([
            'image' => '/assets/dummy/works/2.jpg',
        ]);
        $project->images()->create([
            'image' => '/assets/dummy/works/3.jpg',
        ]);
        $project->images()->create([
            'image' => '/assets/dummy/works/4.jpg',
        ]);

        DataString::create([
            'key' => 'txt-rotate-title',
            'value' => 'I build',
            'language' => ''
        ]);
        DataString::create([
            'key' => 'art-title',
            'value' => 'Discover my Amazing',
            'language' => ''
        ]);
        DataString::create([
            'key' => 'art-subtitle',
            'value' => 'Art Space!',
            'language' => ''
        ]);
        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'web interfaces',
            'language' => ''
        ]);
        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'ios and android applications.',
            'language' => ''
        ]);
        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'design mocups.',
            'language' => ''
        ]);
    }
}
