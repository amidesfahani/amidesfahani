<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Tag;
use App\Models\City;
use App\Models\Link;
use App\Models\User;
use App\Models\Skill;
use App\Models\Status;
use App\Models\History;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Category;
use App\Models\Client;
use App\Models\DataImage;
use App\Models\JobTitle;
use App\Models\Language;
use App\Models\Education;
use App\Models\DataNumber;
use App\Models\DataString;
use App\Models\ExtraSkill;
use App\Models\Imageable;
use App\Models\Testimonial;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AmidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);

        $user->avatar = 'avatars/6ef6936ea652eefd037f10c9082be8c0e834781d.webp';
        $user->save();

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

        Language::create([
            'title' => 'Google',
            'title_fa' => 'گوگل',
            'flag' => 'gg',
            'power' => 100,
            'displayorder' => 0
        ]);

        JobTitle::create([
            'title' => 'Full Stack Developer',
            'title_fa' => 'برنامه نویس فول استک',
            'displayorder' => 0
        ]);

        JobTitle::create([
            'title' => 'Laravel Expert',
            'title_fa' => 'کارشناس لاراول',
            'displayorder' => 10
        ]);

        JobTitle::create([
            'title' => 'Ui/UX Designer',
            'title_fa' => 'طراحی رابط کاربری',
            'displayorder' => 10
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

        Link::create([
            'slug' => 'dubai',
            'title' => 'Dubai',
            'title_fa' => 'دبی',
            'account' => '00971-505905124',
            'icon' => '',
            'svg' => '',
            'pattern' => '',
            'displayorder' => 0
        ]);

        Link::create([
            'slug' => 'mobile',
            'title' => 'Mobile',
            'title_fa' => 'موبایل',
            'account' => '+989171585814',
            'icon' => '',
            'svg' => '',
            'pattern' => '',
            'displayorder' => 0
        ]);

        Skill::create([
            'title' => 'HTML',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/bDnLU8i9GxyxJbQYRinl1gzCGnYyc8xmB8GHn89g.svg',
            'displayorder' => 0,
            'grouporder' => 1
        ]);

        Skill::create([
            'title' => 'CSS',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/HHCPdgHvqXxKlDHsSlUjouO1dGR0cl1LaH9xA2rx.svg',
            'displayorder' => 1,
            'grouporder' => 1
        ]);
        
        Skill::create([
            'title' => 'JS ES6',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/tvHv9T4V2SD38UiUnhCMAHrBOIEkc578NsqSOrvL.svg',
            'displayorder' => 2,
            'grouporder' => 1
        ]);

        Skill::create([
            'title' => 'PHP',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/hNeSen7ZM7zZAbps8OmH0L6wO2kz6iKFE06qraQC.svg',
            'displayorder' => 3,
            'grouporder' => 1
        ]);

        Skill::create([
            'title' => 'Node.js',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/iSWwbOObdXS4X4q8E029JqKIILc2WTBKRx7xwiVu.svg',
            'displayorder' => 0,
            'grouporder' => 2
        ]);

        Skill::create([
            'title' => 'Nuxt.js',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/bC9NrxLlAOAU1a3ZJTM2IZDnHTuaJnJBBnEgd4CA.svg',
            'displayorder' => 1,
            'grouporder' => 2
        ]);

        Skill::create([
            'title' => 'Vue',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/BaRU8XyDShGWY1uwY27Q9d5vt9GI1qapYwBmeJXf.svg',
            'displayorder' => 2,
            'grouporder' => 2
        ]);

        Skill::create([
            'title' => 'React',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/Nw0HekmNIqP9IE9uugK3k0gkDYNXrA4dNkIClKPt.svg',
            'displayorder' => 3,
            'grouporder' => 2
        ]);

        Skill::create([
            'title' => 'jQuery',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/wY6CDSoEdmDkzG8nYCAmCUrLwYPGgwyoj5Di5ia9.svg',
            'displayorder' => 4,
            'grouporder' => 2
        ]);

        Skill::create([
            'title' => 'Laravel',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/Ii8PEJuK2EiwDHNWySQKnrUgJ86dM9y8DEuDmuOp.svg',
            'displayorder' => 0,
            'grouporder' => 3
        ]);

        Skill::create([
            'title' => 'Laravel Nova',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/jO5bdQcoj05Ug7TFePKH5ybtHPWsXeH6fLiix526.svg',
            'displayorder' => 1,
            'grouporder' => 3
        ]);

        Skill::create([
            'title' => 'Wordpress',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/Bj7gOuyNjUEUZxpmEFnpLOATGM9U4b6at4o0prd2.svg',
            'displayorder' => 2,
            'grouporder' => 3
        ]);

        Skill::create([
            'title' => 'MySQL',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/ueNlPDRaKMEzDlPmOqPHWJCKKfVV3VJL9XYc9kRf.svg',
            'displayorder' => 0,
            'grouporder' => 4
        ]);

        Skill::create([
            'title' => 'Redis',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/uOIbRttrQVt5neIXyaF8YlUGM6uQycjVj83p1yhP.svg',
            'displayorder' => 1,
            'grouporder' => 4
        ]);

        Skill::create([
            'title' => 'Sass',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/D2fmJMNOZFSedm4IrUOW7DGXYgvAt9yVULazLsLl.svg',
            'displayorder' => 0,
            'grouporder' => 5
        ]);

        Skill::create([
            'title' => 'Tailwind',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/klBkzn1VfhxUvUBlrs7BguMbOPaGpqc0SCUyEOBw.svg',
            'displayorder' => 1,
            'grouporder' => 5
        ]);

        Skill::create([
            'title' => 'Bootstrap',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/QaslA67jEsXNNmQxQwfcfagWsF1ZpEfmQeNwJHhH.svg',
            'displayorder' => 2,
            'grouporder' => 5
        ]);

        Skill::create([
            'title' => 'Git',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/NzeWvLNWI2sTRtkPWVwvdiQQnhVRPXhU3AAqnjfQ.svg',
            'displayorder' => 0,
            'grouporder' => 6
        ]);

        Skill::create([
            'title' => 'Docker',
            'title_fa' => '',
            'power' => 100,
            'image' => 'skills/EeqTlmN4Ta6aWE3kdrORNNkxkeJf2BHqrWF3XzrC.svg',
            'displayorder' => 1,
            'grouporder' => 6
        ]);

        ExtraSkill::create([
            'title' => 'Object Oriented Programming',
            'displayorder' => 0
        ]);
        ExtraSkill::create([
            'title' => 'MVC architecture',
            'displayorder' => 0
        ]);
        ExtraSkill::create([
            'title' => 'Write Clean Code',
            'displayorder' => 0
        ]);
        ExtraSkill::create([
            'title' => 'Design Efficient Systems',
            'displayorder' => 0
        ]);
        ExtraSkill::create([
            'title' => 'Google, SEO, Optimization',
            'displayorder' => 0
        ]);
        ExtraSkill::create([
            'title' => 'GIT knowledge',
            'displayorder' => 0
        ]);
        ExtraSkill::create([
            'title' => 'Social Media Advisor',
            'displayorder' => 0
        ]);

        Service::create([
            'title' => 'Web Development',
            'language' => 'en',
            'description' => 'Web development services help create all types of web-based software and ensure great experience for web users. I professionally design, redesign and continuously support customer-facing and enterprise web apps to achieve high conversion and adoption rates.',
            'displayorder' => 0
        ]);
        Service::create([
            'title' => 'Laravel Development',
            'language' => 'en',
            'description' => 'Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.',
            'displayorder' => 0
        ]);
        Service::create([
            'title' => '.NET Application Development',
            'language' => 'en',
            'description' => '.NET software development services cover engineering and evolution of web, mobile, and desktop applications with the use of .NET platform.',
            'displayorder' => 0
        ]);
        Service::create([
            'title' => 'PHP Development and Consulting',
            'language' => 'en',
            'description' => 'I help you select the technology mix for a planned PHP project or provide expert recommendations on how to solve the tech challenges of an ongoing project.',
            'displayorder' => 0
        ]);
        Service::create([
            'title' => 'SEO Service',
            'language' => 'en',
            'description' => 'SEO services are search engine optimization services intended to increase visibility and ultimately organic search traffic to websites.',
            'displayorder' => 0
        ]);
        Service::create([
            'title' => 'Social Media Management',
            'language' => 'en',
            'description' => 'Social media management is the process of analyzing social media audiences and developing a strategy that’s tailored to them, creating and distributing content for social media profiles, monitoring online conversations, collaborating with influencers, providing community service, and monitoring, measuring, and reporting on social media performance and ROI.',
            'displayorder' => 0
        ]);

        Service::create([
            'title' => 'طراحی اختصاصی سایت',
            'language' => 'fa',
            'description' => 'طراحی وب سایت اختصاصی به این معناست که از سیستم خاصی استفاده نشود و برنامه نویسی از صفر صورت گیرد. این کار باعث میشود شما محدودیتی نداشته باشید و بتوانید به صورت 100 درصدی ایده خود را تحت وبسایت پیاده سازی نمایید.',
            'displayorder' => 0
        ]);
        Service::create([
            'title' => 'طراحی سایت با وردپرس',
            'language' => 'fa',
            'description' => 'با طراحی وبسایت وردپرسی شما می توانید در زمان و هزینه خود صرفه جویی کنید. اگر یک وب سایت با امکانات رایج سایت شرکتی یا فروشگاه اینترنتی نیاز دارید بهترین گزینه برای شما طراحی سایت وردپرس خواهد بود. وردپرس ساختار سئو بسیار خوبی دارد و به شما در رسیدن به اهداف خود کمک خواهد کرد.',
            'displayorder' => 0
        ]);
        Service::create([
            'title' => 'پشتیبانی و مدیریت',
            'language' => 'fa',
            'description' => 'یکی از بزرگترین مشکلایت و چالش های کارفرمایان ، ارائه خدمات پشتیبانی پس از اتمام طراحی سایت میباشد. در این راستا به صورت منظم و حرفه ای در دو بستر آنلاین و آفلاین آماده خدمت رسانی به شما عزیزان می باشیم.',
            'displayorder' => 0
        ]);
        Service::create([
            'title' => 'خدمات بهینه سازی و SEO',
            'language' => 'fa',
            'description' => 'سئو سایت موضوعی بسیار پیچیده و مهم است و فاکتورهای زیادی از جمله بهینه سازی ساختار سایت (از طریق برنامه نویسی و کدنویسی)، نحوه چینش محتوا و موضوعات اصلی، هدایت صحیح بازدید کننده به صفحات مختلف، بهینه سازی تصاویر، بهبود ساختار لینک‌ها و… را شامل می‌شود.',
            'displayorder' => 0
        ]);
        Service::create([
            'title' => 'مدیریت شبکه های اجتماعی',
            'language' => 'fa',
            'description' => 'مدیریت رسانه های اجتماعی فراتر از ارسال پست و به روز رسانی صفحات اجتماعی شرکت شما است. این کار شامل درگیر شدن با مخاطبان شما و جستجوی فرصت های جدید برای افزایش فروش و همکاری است.',
            'displayorder' => 0
        ]);
        Service::create([
            'title' => 'توسعه با لاراول',
            'language' => 'fa',
            'description' => 'برای شما با استفاده از فریم ورک محبوب لاراول وب سایت های فوق حرفه ای پیاده سازی میکنیم. انواع فروشگاه های اینترنتی، وب اپ های بزرگ، اتوماسیون و دیگر پروژه های بزرگ و پیچیده مبتنی بر وب',
            'displayorder' => 0
        ]);

        Education::create([
            'title' => "Islamic Azad University",
            'field' => "Software Technology Engineering",
            'description' => "The Software Technology Engineering Bachelor's Degree programme provides you with the skills and knowledge needed to develop and manage software systems.",
            'title_fa' => 'دانشگاه آزاد اسلامی',
            'field_fa' => "مهندسی نرم افزار",
            'description_fa' => "مهندسی تکنولوژی نرم افزار دانشگاه آزاد",
            'start_date' => Jalalian::fromFormat("Y-m-d", "1385-11-01")->toCarbon()
        ]);

        Education::create([
            'title' => "Tehran Institute of Technology",
            'field' => "Microsoft Certified Solutions Developer",
            'description' => "MCAD, MCSD, MCT, is one of the few MCTs approved to present the Microsoft .NET Developer Training Tour.",
            'title_fa' => 'مجتمع فنی تهران',
            'field_fa' => "دوره MCSD مایکروسافت",
            'description_fa' => "دوره برنامه نویسی زبان های .net مایکروسافت",
            'start_date' => Jalalian::fromFormat("Y-m-d", "1386-05-01")->toCarbon()
        ]);

        $edu = Education::create([
            'title' => "Code with Mosh Complete Python Mastery",
            'field' => "Complete Python Mastery",
            'description' => "This course assumes you know nothing about Python or any other programming languages. Go from complete beginner to expert, with plenty of hands-on exercises along the way.",
            'title_fa' => 'دوره های آموزشی Code with Mosh',
            'field_fa' => "تسلط کامل بر پایتون",
            'description_fa' => "دوره کامل آموزشی پایتون از مبتدی تا پیشرفته به زبان اصلی",
            'start_date' => Carbon::createFromFormat("Y-m-d", "2020-06-25")
        ]);
        $edu->documents()->create([
            'image' => 'images/f2589eed20b5dfbf9c87721d90c836cb05e2e100.webp',
            'title' => 'Certificate',
            'title_fa' => 'گواهی',
        ]);

        $edu = Education::create([
            'title' => "Code with Mosh The Ultimate React Native",
            'field' => "The Ultimate React Native Series",
            'description' => "React Native is the most popular framework for building truly native mobile apps with JavaScript. Use a single code to build apps for iOS and Android.",
            'title_fa' => 'دوره های آموزشی Code with Mosh',
            'field_fa' => "",
            'description_fa' => "آموزش مبتدی تا پیشرفته React Native به همراه انجام پروژه اپلیکیشن فروش آنلاین",
            'start_date' => Carbon::createFromFormat("Y-m-d", "2020-06-25")
        ]);
        $edu->documents()->create([
            'image' => 'images/48f54cdb2958081df272329507e794fad75c21de.webp',
            'title' => 'Certificate',
            'title_fa' => 'گواهی',
        ]);

        History::create([
            'title' => "Now Those Days Are Gone",
            'role' => "Freelance Full Stack Developer",
            'description' => "Shaparakgallery.com (v1) joonoobia.ir kgco.ir tphco.ir",
            'title_fa' => 'روزهای گذشته',
            'role_fa' => "برنامه نویسی و یادگیری",
            'description_fa' => "پروژه های متعددی رو در این سال ها انجام دادم هم بر بستر ویندوز و هم وب که بخشی از اونا رو اینجا ذکر کردم",
            'start_date' => Jalalian::fromFormat("Y-m-d", "1385-10-01")->toCarbon(),
        ]);

        History::create([
            'title' => "Ahaad Gostar Tabriz",
            'role' => "Full Stack Developer",
            'description' => "An advertising company in Tabriz, which was the beginning of my professional work in the field of web programming. The first project was a grocery store website implemented in PHP.",
            'title_fa' => 'شرکت آحاد گستر تبریز',
            'role_fa' => "برنامه نویس و طراح وب",
            'description_fa' => "دوران دانشجویی در این شرکت مشغول به کار بودم که پروژه های مختلفی رو همکاری داشتم. نرم افارهای ویندوز و وب سایت های پویا.",
            'start_date' => Jalalian::fromFormat("Y-m-d", "1386-07-01")->toCarbon(),
            'end_date' => Jalalian::fromFormat("Y-m-d", "1388-09-10")->toCarbon(),
        ]);

        History::create([
            'title' => "Silver Design",
            'role' => "Full Stack Developer",
            'description' => "Silver advertising and design office in Bandar Abbas is one of the most up-to-date design teams in Bandar Abbas, where I worked on many projects.",
            'title_fa' => 'مرکز تخصصی طراحی نقره ای',
            'role_fa' => "",
            'description_fa' => "در مرکز طراحی نقره ای به صورت فریلنسر کار میکردم. وب سایت های زیادی از جمله وب سایت مجموعه رو پیاده سازی کردم.",
            'website' => 'https://silverdesign.ir',
            'start_date' => Jalalian::fromFormat("Y-m-d", "1388-11-20")->toCarbon(),
            'end_date' => Jalalian::fromFormat("Y-m-d", "1390-05-30")->toCarbon(),
        ]);

        History::create([
            'title' => "Artimes Sannat Hormozgan",
            'role' => "Full Stack Developer - Support",
            'website' => 'https://artimesco.ir',
            'title_fa' => 'شرکت آرتیمس صنعت هرمزگان',
            'role_fa' => "",
            'description_fa' => "طراحی و پیاده سازی، نگهداری و پشتیبانی اتوماسیون آنلاین شرکت.",
            'description' => "Implementation of international online automation system to provide company services and track work operations by employers.",
            'start_date' => Jalalian::fromFormat("Y-m-d", "1391-07-01")->toCarbon(),
            'end_date' => Jalalian::fromFormat("Y-m-d", "1391-12-01")->toCarbon(),
        ]);

        History::create([
            'title' => "Amoot Arta Qeshm",
            'role' => "Developer - Support",
            'description' => "Using modern web technology to implement tourism, tour and visa and plane ticket websites for the first time in Iran. No airline provided API output, and I had a lot of hard work to do. After a lot of effort and offering various solutions for Amout Arta Qeshm Company, a subsidiary of Hormozgan Metalworking Company, the website of the company's aviation office was launched and managed.",
            'title_fa' => 'آموت آرتا قشم',
            'role_fa' => "",
            'description_fa' => "طراحی، پیاده سازی و پشتیبانی سیستم شبکه داخلی، وب سایت و فعالیت های آنلاین",
            'start_date' => Jalalian::fromFormat("Y-m-d", "1390-06-01")->toCarbon(),
            'end_date' => Jalalian::fromFormat("Y-m-d", "1391-06-01")->toCarbon(),
        ]);

        History::create([
            'title' => "iBelit",
            'role' => "Founder - Full Stack Developer",
            'description' => "iBelit, one of the firsts and top Online ticket reservation system in Iran. also I developed and windows and mobile application for tickets barcode checking. first mobile barcode scanner in iran. multiple ways to reserve a ticket: online, telegram bot, windows application.",
            'title_fa' => 'آی‌بلیت',
            'role_fa' => "موسس - توسعه دهنده",
            'description_fa' => "آی بلیت سامانه فروش بلیت رویدادهای فرهنگی هنری و ورزشی می باشد که از سال 1391 مشغول به فعالیت می باشد.",
            'start_date' => Jalalian::fromFormat("Y-m-d", "1400-01-01")->toCarbon(),
            'present' => true,
        ]);

        History::create([
            'title' => "Farachehr",
            'role' => "Full Stack Developer - CTO",
            'description' => "ShaparakGallery, one of the firsts and top cosmetic and perfume retail e-commerce stores in Iran",
            'title_fa' => 'فراچهر',
            'role_fa' => "",
            'description_fa' => "وب سایت فروش محصولات آرایشی، بهداشتی و عطریات با نام تجاری شاپرک گالری یکی از بزرگترین وب سایت های آرایشی در ایران می باشد.",
            'start_date' => Jalalian::fromFormat("Y-m-d", "1400-01-01")->toCarbon(),
            'present' => true,
        ]);
        History::create([
            'title' => "Mizbanha",
            'role' => "Founder",
            'description' => "Hosting and domain registration services",
            'title_fa' => 'میزبان‌ها',
            'role_fa' => "بنیان گذار",
            'description_fa' => "خدمات میزبانی و ثبت دامنه",
            'start_date' => Jalalian::fromFormat("Y-m-d", "1400-01-01")->toCarbon(),
            'present' => true,
        ]);

        $teh = City::create([
            'country' => 'ir',
            'title' => 'Tehran',
            'title_fa' => 'تهران'
        ]);
        $bnd = City::create([
            'country' => 'ir',
            'title' => 'Bandar\'e Abbas',
            'title_fa' => 'بندرعباس'
        ]);
        $tbz = City::create([
            'country' => 'ir',
            'title' => 'Tabriz',
            'title_fa' => 'تبریز'
        ]);
        $dubai = City::create([
            'country' => 'ua',
            'title' => 'Dubai',
            'title_fa' => 'دبی'
        ]);

        $under = Status::create([
            'title' => 'Under Construction',
            'title_fa' => 'در دست ساخت'
        ]);
        $completed = Status::create([
            'title' => 'Completed',
            'title_fa' => 'تکمیل شده'
        ]);
        $closed = Status::create([
            'title' => 'Closed',
            'title_fa' => 'بسته شده'
        ]);
        $deprecated = Status::create([
            'title' => 'Deprecated',
            'title_fa' => 'منسوخ'
        ]);
        $refactored = Status::create([
            'title' => 'Refactored',
            'title_fa' => 'بازسازی شده'
        ]);
        $redesign = Status::create([
            'title' => 'Redesign',
            'title_fa' => 'طراحی مجدد'
        ]);
        $unchanged = Status::create([
            'title' => 'Unchanged',
            'title_fa' => 'بدون تغییر'
        ]);

        $php_developer = Category::create([
            'title' => 'PHP Developer',
            'title_fa' => 'توسعه PHP',
            'slug' => 'php-developer'
        ]);
        $web_developer = Category::create([
            'title' => 'Web Developer',
            'title_fa' => 'طراحی سایت',
            'slug' => 'web-developer'
        ]);
        $full_stack_developer = Category::create([
            'title' => 'Full Stack Developer',
            'title_fa' => 'برنامه نویس فول استک',
            'slug' => 'full-stack-developer'
        ]);
        $ui_design = Category::create([
            'title' => 'Ui Design',
            'title_fa' => 'طراحی رابط کاربری',
            'slug' => 'ui-design'
        ]);
        $laravel_developer = Category::create([
            'title' => 'Laravel',
            'title_fa' => 'لاراول',
            'slug' => 'laravel'
        ]);
        $wordpress_developer = Category::create([
            'title' => 'Wordpress',
            'title_fa' => 'وردپرس',
            'slug' => 'wordpress'
        ]);

        $php = Tag::create([
            'title' => 'PHP'
        ]);
        $mysql = Tag::create([
            'title' => 'MySql'
        ]);
        $core = Tag::create([
            'title' => 'Core Engine'
        ]);
        $ui = Tag::create([
            'title' => 'UI'
        ]);
        $ux = Tag::create([
            'title' => 'UX'
        ]);
        $uiux = Tag::create([
            'title' => 'UI/UX'
        ]);
        $deployment = Tag::create([
            'title' => 'Deployment'
        ]);
        $support = Tag::create([
            'title' => 'Support'
        ]);
        $laravel = Tag::create([
            'title' => 'Laravel'
        ]);
        $jquery = Tag::create([
            'title' => 'jQuery'
        ]);
        $boostrap = Tag::create([
            'title' => 'Boostrap'
        ]);
        $vue = Tag::create([
            'title' => 'Vue js'
        ]);
        $tailwind = Tag::create([
            'title' => 'Tailwind CSS'
        ]);
        $nova = Tag::create([
            'title' => 'Laravel Nova'
        ]);
        $wordpress = Tag::create([
            'title' => 'Wordpress'
        ]);
        $elementor = Tag::create([
            'title' => 'Elementor'
        ]);

        $oldies = Project::create([
            'title' => 'Deprecated Projects',
            'title_fa' => 'پروژه های منسوخ',
            'subtitle' => '',
            'subtitle_fa' => '',
            'image' => '',
            'about' => '',
            'about_fa' => '',
            'description' => '
Cafe Del [cafedel.com] (Del Cafe)
Setareh Cafe [cafesetareh.com] (Setareh Cafe)
Shahr Group [shahrgroup.com] (Shahr Design & Engineering Group)
Honar\'e Aval [honaraval.com] (Online Music Instrument Shop)
Local Composer [pouyaazar.com] (Personal Portfolio Website)
Hova-al-Hagh [hovalhagh.ir] (Islamic Online School)
NOB co. [nobco.org]
Sliver Design [silverdesign.ir] (Sliver Design Website)
TPH Co. [tphco.com] (Tejarat Pishegan Hormozgan Company)
Artimes Co. [artimesco.ir] (Artimes Sanat Hormozgan Company)
OrbWallpaper [orbwallpaper.com] (Free Desktop Wallpapers)
MJMoonwalk [mjmoonwalk.com] (Michael Jackson Tribute Website)
Monster Design [monsterdesign.ir] (My First Portfolio Webiste)
Ghabrestoon [ghabrestoon.com] (vBulletin Persian Forums with Dedicated Chatbox)
vBulettin Plugin Developer
Server Security
...

To see these projects, refer to the official website of the web archive
https://web.archive.org/
',
            'description_fa' => '
Cafe Del [cafedel.com] (کافه دل)
Setareh Cafe [cafesetareh.com] (کافه ستاره)
Shahr Group [shahrgroup.com] (گروه طراحی و مهندسی شهر)
Honar\'e Aval [honaraval.com] (وب سایت فروش آنلاین سازهای موسیقی)
Local Composer [pouyaazar.com] (وب سایت شخصی)
Hova-al-Hagh [hovalhagh.ir] (مدرسه اسلامی و سیستم ثبت نام و کارنامه آنلاین)
NOB co. [nobco.org] (وب سایت شرکتی)
Sliver Design [silverdesign.ir] (گروه طراحی نقره ای)
TPH Co. [tphco.com] (وب سایت شرکت تجارت پیشگان)
Artimes Co. [artimesco.ir] (وب سایت و اتوماسیون آنلاین شرکت آرتیمس صنعت هرمزگان)
OrbWallpaper [orbwallpaper.com]
MJMoonwalk [mjmoonwalk.com]
Monster Design [monsterdesign.ir] اولین وب سایت نمونه کارهای خودم
Ghabrestoon [ghabrestoon.com] انجمن گفتگو با چت باکس حرفه ای و اختصاصی
ساخت و توسعه پلاگین برای vBulettin
امنیت سرور و شبکه
...

برای دیدن این  پروژه ها به وب سایت رسمی آرشیو وب وراجعه کنید
https://web.archive.org/
',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2007-01-01"),
            // 'final_date' => '',
            'link' => '',
            'archive' => '',
            'status_id' => $deprecated->id,
            'client_id' => 0,
            'city_id' => $bnd->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $image = new Imageable([
            'title' => 'Silver Design',
            'image' => 'images/3f4becb1b3ca3e469e327cd7af92dde175ccd45a.webp',
            'cover' => 1
        ]);
        $oldies->images()->save($image);

        $image = new Imageable([
            'title' => 'Monster Design',
            'image' => 'images/5c74c8d2c6b37572a3230fbce01c8688c2d548e9.webp',
            'cover' => 0
        ]);
        $oldies->images()->save($image);

        $image = new Imageable([
            'title' => 'TPHCO',
            'image' => 'images/a2995d7195806418ae1f7c6e8ad3d1b71803885f.webp',
            'cover' => 0
        ]);
        $oldies->images()->save($image);

        $agt = Client::create([
            'title' => 'AGT',
            'title_fa' => 'آحاد گشتر تبریز'
        ]);

        $soularco = Project::create([
            'title' => 'Soular',
            'title_fa' => 'سولار',
            'subtitle' => 'Soular Food Industries',
            'subtitle_fa' => 'صنایع غذایی سولار',
            'image' => '',
            'about' => 'Website introducing products in two languages implemented with PHP and MySql
Unparalleled in terms of design and programming system in its time',
            'about_fa' => 'وب سایت معرفی محصولات به دو زبان پیاده سازی شده با PHP  و MySql
            بی نظیر از لحاظ طراحی و سیستم برنامه نویسی در زمان خود',
            'description' => 'Sobhe Gheshlagh Food Industries with Commercial Name (soular) Established at November of 2002. Production and Packing of Food Stuff.
            The Solar site was my first commercial project implemented in PHP and the MySql database.
Planned, developed, deployed and maintained
English and Persian languages
Ability to search the website
Image gallery and slider
Products and segmentation
User management and user registration
Question and answer system
Ability to add new language from the admin area
Image optimization
Email Newsletter
Polls and ads
Dedicated management panel
Do not use ready-made systems such as WordPress or Joomla',
            'description_fa' => 'سایت سولار اولین پروژه تجاری من بود که به زبان PHP و پایگاه داده MySql پیاده سازی شد.
برنامه ریزی، توسعه، پیاده سازی و پشتیبانی
زبان انگلیسی و فارسی
قابلیت جستجو در وب سایت
گالری تصاویر و اسلایدر
محصولات و بخش بندی
مدیریت کاربران و ثبت نام کاربری
سیستم پرسش و پاسخ
قابلیت اضافه کردن زبان جدید از بخش مدیریت
بهینه سازی تصاویر
خبرنامه ایمیل
نظر سنجی و تبلیغات
پنل مدیریت اختصاصی
عدم استفاده از سیستم های آماده مانند وردپرس یا جوملا',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2006-11-01"),
            'final_date' => Carbon::createFromFormat("Y-m-d", "2007-01-01"),
            'link' => 'soularco.com',
            'archive' => 'https://web.archive.org/web/20090409234519/http://www.soularco.com/',
            'status_id' => $deprecated->id,
            'client_id' => $agt->id,
            'city_id' => $tbz->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $soularco->categories()->attach([
            $full_stack_developer->id,
            $php_developer->id,
            $web_developer->id
        ]);

        $soularco->tags()->attach([
            $core->id,
            $uiux->id,
            $deployment->id,
            $support->id,
            $php->id,
            $mysql->id
        ]);

        $image = new Imageable([
            'title' => 'Soular',
            'image' => 'images/ad0013835c3c4e07b32d4fb2875070ba80a6b6d2.webp',
            'cover' => 1
        ]);
        $soularco->images()->save($image);

        $kgco = Client::create([
            'title' => 'Kalantari Gold',
            'title_fa' => 'طلا و جواهرات کلانتری'
        ]);

        $kalantarigold = Project::create([
            'title' => 'Kalantari Gold',
            'title_fa' => 'کلانتری گولد',
            'subtitle' => 'Kalantari Gold & Jewelry',
            'subtitle_fa' => 'مجموعه طلا و جواهرات کلانتری',
            'image' => '',
            'about' => '',
            'about_fa' => '',
            'description' => '
Jewelry website
The system provides instant exchange rates with the ability to update automatically and manually
SMS system rates for subscribers
Advanced change chart for all rates
Online sales system for all types of gold, coins and jewelry
',
            'description_fa' => '
وب سایت طلا و جواهر
سیستم ارائه لحظه ای نرخ ارز با قابلیت به روز رسانی خودکار و دستی
سیستم پیامک نرخ ها برای مشترکین
نمودار تغییرات پیشرفته برای تمام نرخ ها
سیستم فروش آنلاین انواع طلا و سکه و جواهرات
',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2015-02-01"),
            'final_date' => Carbon::createFromFormat("Y-m-d", "2015-05-16"),
            'link' => 'kalantarigold.com',
            'archive' => 'https://web.archive.org/web/20160729212014/http://www.kalantarigold.com/',
            'status_id' => $deprecated->id,
            'client_id' => $kgco->id,
            'city_id' => $bnd->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $kalantarigold->categories()->attach([
            $full_stack_developer->id,
            $php_developer->id,
            $web_developer->id
        ]);

        $kalantarigold->tags()->attach([
            $core->id,
            $uiux->id,
            $deployment->id,
            $support->id,
            $php->id,
            $mysql->id
        ]);

        $image = new Imageable([
            'title' => 'Kalantari Gold',
            'image' => 'images/c426c659800bcce918f3a7e911335de12b78c837.webp',
            'cover' => 1
        ]);
        $kalantarigold->images()->save($image);

        $ravan = Client::create([
            'title' => 'Ravan Rayaneh',
            'title_fa' => 'روان رایانه'
        ]);

        $RavanRayaneh = Project::create([
            'title' => 'RavanRayaneh',
            'title_fa' => 'روان رایانه',
            'subtitle' => 'Office Supplies & Printer',
            'subtitle_fa' => 'لوازم اداری و چاپگر',
            'image' => '',
            'about' => '',
            'about_fa' => '',
            'description' => '
Ravan Rayaneh was the first online store of printers and peripherals in Bandar Abbas and one of the top websites active in the field of online sales of printer parts in Iran.
I launched the warehousing and accounting system online. And after a while, I added a partner sales panel with the ability to pay online and in installments and by determining the amount of profit to the project.
Design, implementation and full project support
Set up an online storage system
Set up an online accounting system
Sales panel for partners
Purchase panel for partners with installment capability
',
            'description_fa' => '
روان رایانه اولین فروشگاه اینترنتی پرینتر و تجهیزات جانبی در شهر بندرعباس و جز برترین وب سایت های فعال در زمینه فروش آنلاین قطعات پرینتر در ایران بود.
سیستم انبارداری و حسابداری رو به صورت آنلاین راه اندازی کردم. و بعد از مدتی پنل فروش همکار با قابلیت پرداخت آنلاین و اقساظ و با تعیین مقدار سود رو به پروژه اضافه کردم.

طراحی، پیاده سازی و پشتیبانی کامل پروژه
راه اندازی سیستم انبارداری آنلاین
راه اندازی سیستم حسابداری آنلاین
پنل فروش برای همکاران
پنل خرید برای همکاران با قابلیت قسط بندی
',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2013-10-1"),
            'final_date' => Carbon::createFromFormat("Y-m-d", "2014-1-1"),
            'link' => '',
            'archive' => 'https://web.archive.org/web/20160729212014/http://www.kalantarigold.com/',
            'status_id' => $deprecated->id,
            'client_id' => $ravan->id,
            'city_id' => $bnd->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $RavanRayaneh->categories()->attach([
            $full_stack_developer->id,
            $php_developer->id,
            $web_developer->id
        ]);

        $RavanRayaneh->tags()->attach([
            $core->id,
            $uiux->id,
            $deployment->id,
            $support->id,
            $php->id,
            $mysql->id
        ]);

        $image = new Imageable([
            'title' => 'RavanRayaneh',
            'image' => 'images/0db0bdbce06c2cf345cacfc4b69a46ad6d2a76d1.webp',
            'cover' => 1
        ]);
        $RavanRayaneh->images()->save($image);
        $image = new Imageable([
            'title' => 'RavanRayaneh',
            'image' => 'images/bf65f76712ff6d72b31689c91910cc64dcd86893.webp',
            'cover' => 0
        ]);
        $RavanRayaneh->images()->save($image);
        $image = new Imageable([
            'title' => 'RavanRayaneh',
            'image' => 'images/bead4bb704ddb15fcdffc2891ecfe68d6279f167.webp',
            'cover' => 0
        ]);
        $RavanRayaneh->images()->save($image);

        $dorna = Client::create([
            'title' => 'Dorna Navaye Mihan',
            'title_fa' => 'درنا نوای میهن'
        ]);

        $joonoobia = Project::create([
            'title' => 'Joonoobia',
            'title_fa' => 'جنوبیا',
            'subtitle' => 'Ideh Pardazan Setayesh',
            'subtitle_fa' => 'ایده پردازان ستایش',
            'image' => '',
            'about' => 'A reference website for cultural, artistic and ceremonial events in Bandar Abbas',
            'about_fa' => 'یک وب سایت مرجع برای رویدادهای فرهنگی، هنری و مراسم و تشریفات در بندرعباس',
            'description' => 'The project was implemented almost in late 2013. The admin and general sections of the website were programmed in PHP.
            The online reservation and purchase system for tickets to art events such as concerts and theaters for the first time in Iran with the ability to select a seat was the main part of this website.
            After a while, a comprehensive information system for jobs related to weddings and ceremonies was added to this website.',
            'description_fa' => 'این پروژه تقریبا در اواخر سال ۲۰۱۳ پیاده سازی شد. بخش مدیریت و بخش عمومی وب سایت به زبان PHP برنامه نویسی شد.
            سیستم رزرو و خرید آنلاین بلیت رویدادهای هنری مانند کنسرت و تئاتر برای اولین با بار در ایران با قابلیت انتخاب صندلی بخش اصلی این وب سایت رو تشکیل میداد.
            بعد از مدتی سیستم اطلاعات جامع مشاغل مرتبط با مجالس عروسی و تشریفات به این وب سایت اضافه شد.',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2013-11-03"),
            'final_date' => Carbon::createFromFormat("Y-m-d", "2014-05-25"),
            'link' => 'joonoobia.ir',
            'archive' => 'https://web.archive.org/web/20140625183530/http://www.joonoobia.ir/',
            'status_id' => $deprecated->id,
            'client_id' => $dorna->id,
            'city_id' => $bnd->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $joonoobia->categories()->attach([
            $full_stack_developer->id,
            $php_developer->id,
            $web_developer->id
        ]);

        $joonoobia->tags()->attach([
            $core->id,
            $uiux->id,
            $deployment->id,
            $support->id,
            $php->id,
            $mysql->id
        ]);

        $image = new Imageable([
            'title' => 'Joonoobia',
            'image' => 'images/efad144bd089fba9ed5948b6c717469ffd6bf792.webp',
            'cover' => 1
        ]);
        $joonoobia->images()->save($image);
        $image = new Imageable([
            'title' => 'Joonoobia',
            'image' => 'images/322ee43fec5c9e50951310e6c16033218d0e40a6.webp',
            'cover' => 0
        ]);
        $joonoobia->images()->save($image);
        $image = new Imageable([
            'title' => 'Joonoobia',
            'image' => 'images/1faff3a6b27292715391252a623c4f8486013e43.webp',
            'cover' => 0
        ]);
        $joonoobia->images()->save($image);

        $mizbanha = Client::create([
            'title' => 'Mizbanha',
            'title_fa' => 'میزبان‌ها'
        ]);

        $ibelit = Project::create([
            'title' => 'iBelit',
            'title_fa' => 'آی‌بلیت',
            'subtitle' => 'version 1',
            'subtitle_fa' => 'نسخه 1',
            'image' => '',
            'about' => 'Website for selling concert and theater tickets online',
            'about_fa' => 'وب سایت فروش آنلاین بلیت کنسرت و تئاتر',
            'description' => 'With the upgrade of the engine, the previous i-ticket sales site was launched.
Management, general use and sales center were programmed in PHP. The database of this project is MySql.
In order to control the tickets in the performance hall, in the first phase, Windows software was written in .net language. This software had a much smaller volume among competitors\' software and did not need to install any separate libraries and software. It was based on XML and API.
A comprehensive program that in addition to ticket control, has the ability to search advanced and sell and print tickets.
In the next phase, the mobile ticket control web app in Vue language was added to this project.
IBile was the founder of the new e-ticket sales using the latest technology in Iran.',
            'description_fa' => 'با ارتقای موتور سایت فروش بلیت قبلی آی بلیت راه اندازی شد.
بخش مدیریت، کاربری عمومی و بخش مراکز فروش به زبان PHP برنامه نویسی شد. پایگاه داده این پروژه MySql است.
برای کنترل بلیت ها در سالن اجرا در فاز نخست نرم افزار ویندوز به زبان .net نوشته شد. این نرم افزار در بین نرم افزارهای رقبا از حجم بسیار کمتری برخوردار بود و نیاز به نصب هیچ کتابخانه و نرم افزار مجزایی نداشت. بر پایه XML و API عمل میکرد.
یک برنامه جامع که علاوه بر کنترل بلیت، قابلیت جستجوی پیشرفته و فروش و چاپ بلیت رو هم دارد.
در فاز بعدی وب اپ کنترل بلیت برای موبایل به زبان Vue به این پروژه اضافه شد.
آی بلیت پایه گذار نوین فروش بلیت الکترونیکی با بکارگیری تکنولوژی روز دنیا در ایران بود.',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2013-11-28"),
            'final_date' => Carbon::createFromFormat("Y-m-d", "2014-02-18"),
            'link' => 'ibelit.com',
            'archive' => '',
            'status_id' => $unchanged->id,
            'client_id' => $mizbanha->id,
            'city_id' => $bnd->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $ibelit->categories()->attach([
            $full_stack_developer->id,
            $php_developer->id,
            $web_developer->id
        ]);

        $ibelit->tags()->attach([
            $core->id,
            $uiux->id,
            $deployment->id,
            $support->id,
            $php->id,
            $mysql->id,
            $jquery->id,
            $boostrap->id
        ]);

        $image = new Imageable([
            'title' => 'iBelit',
            'image' => 'images/69f54b5b69e0ec800de012e222ac3b70114f29d8.webp',
            'cover' => 1
        ]);
        $ibelit->images()->save($image);

        $image = new Imageable([
            'title' => 'iBelit',
            'image' => 'images/fd482ce78d88cee503d7fd311e8db5fede6bae6f.webp',
            'cover' => 0
        ]);
        $ibelit->images()->save($image);

        $farachehr = Client::create([
            'title' => 'Farachehr',
            'title_fa' => 'فراچهر'
        ]);

        $shaparakgallery = Project::create([
            'title' => 'Shaparak Gallery',
            'title_fa' => 'شاپرک گالری',
            'subtitle' => 'Shaparak Cosmetic Store',
            'subtitle_fa' => 'آرایشی بهداشتی شاپرک',
            'image' => '',
            'about' => 'ShaparakGallery, one of the firsts and top cosmetic and perfume retail e-commerce stores in Iran',
            'about_fa' => 'وب سایت فروش محصولات آرایشی و بهداشتی و عطریات',
            'description' => 'Shaparak underwent many changes after a few years. The new Shapark entered the arena of competition among other cosmetic websites with a newer look and engine.
            Website SEO worked best to get the website to the first pages of Google in a fraction of the time.
            The website was re-programmed with the Laravel framework. The database was optimized and updated with the latest methods and technologies of web programming.
            In the Shaperk user section, I used the Vue and Tailwind frameworks.
            Design, implementation, support and management
            Online warehousing system
            Online accounting system
            Equipped with a virtual assistant found perfume and powder cream
            And other facilities ...',
            'description_fa' => '
            شاپرک بعد از چند سال دستخوش تغییرات زیادی شد. شاپرک جدید با ظاهر و موتوری جدیدتر پا به عرصه رقابت در بین دیگر وب سایت های آرایشی و بهداشتی گذاشت.
            سئو وب سایت به بهترین نحو کار شد تا در کسری از زمان وب سایت به صفحات نخست گوگل منتقل بشه.
            وب سایت مجدد با فریم ورک لاراول برنامه نویسی شد. پایگاه داده بهینه سازی شده و به روز و از جدیدترین روش ها و تکنولوژی ها برنامه نویسی وب استفاده شد.
            در بخش کاربری شاپرک از فریم ورک Vue و Tailwind استفاده کردم.
            طراحی، پیاده سازی، پشتیبانی و مدیریت
            سیستم انبار داری آنلاین
            سیستم حسابداری آنلاین
            مجهز به دستیار مجازی عطریاب و کرم پودر یافت
            و امکانات دیگه...',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2020-10-01"),
            'final_date' => Carbon::createFromFormat("Y-m-d", "2021-03-21"),
            'link' => 'ibelit.com',
            'archive' => '',
            'status_id' => $redesign->id,
            'client_id' => $farachehr->id,
            'city_id' => $bnd->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $shaparakgallery->categories()->attach([
            $full_stack_developer->id,
            $php_developer->id,
            $web_developer->id,
            $laravel_developer->id
        ]);

        $shaparakgallery->tags()->attach([
            $core->id,
            $uiux->id,
            $deployment->id,
            $support->id,
            $php->id,
            $mysql->id,
            $laravel->id,
            $nova->id,
            $vue->id,
            $tailwind->id
        ]);

        $image = new Imageable([
            'title' => 'Shaparak Gallery',
            'image' => 'images/c78ef310571360cabb4ee969e2f68e5b830def20.webp',
            'cover' => 0
        ]);
        $shaparakgallery->images()->save($image);
        $image = new Imageable([
            'title' => 'Shaparak Gallery',
            'image' => 'images/ba9a6308e99e5fa3a0a3ade32246d6a6e5e8af8b.webp',
            'cover' => 0
        ]);
        $shaparakgallery->images()->save($image);
        $image = new Imageable([
            'title' => 'Shaparak Gallery',
            'image' => 'images/7061c9c2a78871ab072ff4a39ef2fb15108919e8.webp',
            'cover' => 0
        ]);
        $shaparakgallery->images()->save($image);
        $image = new Imageable([
            'title' => 'Shaparak Gallery',
            'image' => 'images/7f4ae3715c1a7e120a14089a6529a1d24d0b947d.webp',
            'cover' => 1
        ]);
        $shaparakgallery->images()->save($image);
        $image = new Imageable([
            'title' => 'Shaparak Gallery',
            'image' => 'images/a6345ad8d5bc2d90c8005124185d50f715d0e460.webp',
            'cover' => 0
        ]);
        $shaparakgallery->images()->save($image);
        $image = new Imageable([
            'title' => 'Shaparak Gallery',
            'image' => 'images/1bd3129c2bf58a5e8a435a5e2e7f3265b4370d3d.webp',
            'cover' => 0
        ]);
        $shaparakgallery->images()->save($image);
        $image = new Imageable([
            'title' => 'Shaparak Gallery',
            'image' => 'images/713a47e884f6671602921f657a85333fa1c47ef4.webp',
            'cover' => 0
        ]);
        $shaparakgallery->images()->save($image);

        $localClients = Client::create([
            'title' => 'Local Clients',
            'title_fa' => 'مشتری های بومی'
        ]);

        $uniqcatering = Project::create([
            'title' => 'Uniq Catering',
            'title_fa' => 'کترینگ یونیک',
            'subtitle' => 'Order Online Catering Services',
            'subtitle_fa' => 'سفارش آنلاین خدمات کترینگ',
            'image' => '',
            'about' => 'Order catering services online with management panel. The user section of the project was written as SPA in JavaScript and VueJs.
            MySql database was used and Laravel Lumen framework was used as the backend for this project.',
            'about_fa' => 'سفارش آنلاین خدمات کترینگ به همراه پنل مدیریتی. بخش کاربری پروژه به صورت SPA و به زبان JavaScript و VueJs نوشته شد.
            پایگاه داده MySql استفاده شد و فریم ورک لاراول Lumen به عنوان بک اند این پروژه کار شد.',
            'description' => 'Order catering services online Web App with management panel. The user section of the project was written as SPA in JavaScript and VueJs.
            MySql database was used and Laravel Lumen framework was used as the backend for this project.',
            'description_fa' => 'وب اپ سفارش آنلاین خدمات کترینگ به همراه پنل مدیریتی. بخش کاربری پروژه به صورت SPA و به زبان JavaScript و VueJs نوشته شد.
            پایگاه داده MySql استفاده شد و فریم ورک لاراول Lumen به عنوان بک اند این پروژه کار شد.',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2019-10-01"),
            'final_date' => Carbon::createFromFormat("Y-m-d", "2019-11-01"),
            'link' => 'uniqcatering.ir',
            'archive' => '',
            'status_id' => $closed->id,
            'client_id' => $localClients->id,
            'city_id' => $bnd->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $uniqcatering->categories()->attach([
            $full_stack_developer->id,
            $php_developer->id,
            $web_developer->id,
            $laravel_developer->id
        ]);

        $uniqcatering->tags()->attach([
            $core->id,
            $uiux->id,
            $deployment->id,
            $php->id,
            $mysql->id,
            $laravel->id,
            $nova->id,
            $vue->id,
            $tailwind->id
        ]);

        $masiharabi = Project::create([
            'title' => 'MasihArabi.com',
            'title_fa' => 'مسیح عربی',
            'subtitle' => 'Nail implantation and beauty services',
            'subtitle_fa' => 'مجموعه کاشت و خدمات زیبایی ناخن',
            'image' => '',
            'about' => '',
            'about_fa' => '',
            'description' => '',
            'description_fa' => '',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2021-07-21"),
            'final_date' => Carbon::createFromFormat("Y-m-d", "2021-10-01"),
            'link' => 'masiharabi.com',
            'archive' => '',
            'status_id' => $completed->id,
            'client_id' => $localClients->id,
            'city_id' => $bnd->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $masiharabi->categories()->attach([
            $full_stack_developer->id,
            $php_developer->id,
            $web_developer->id,
            $laravel_developer->id
        ]);

        $masiharabi->tags()->attach([
            $core->id,
            $uiux->id,
            $deployment->id,
            $support->id,
            $php->id,
            $mysql->id,
            $laravel->id,
            $nova->id,
            $vue->id,
            $tailwind->id
        ]);

        $image = new Imageable([
            'title' => 'MasihArabi',
            'image' => 'images/6a788fddd347ada94a916f2e78b2676ac68e9100.webp',
            'cover' => 1
        ]);
        $masiharabi->images()->save($image);
        $image = new Imageable([
            'title' => 'MasihArabi',
            'image' => 'images/fe1cff8847c32b4a6560c3b094f433b4f8978320.webp',
            'cover' => 0
        ]);
        $masiharabi->images()->save($image);
        $image = new Imageable([
            'title' => 'MasihArabi',
            'image' => 'images/24842fc4420096bd92cdec122ccec46856f8d948.webp',
            'cover' => 0
        ]);
        $masiharabi->images()->save($image);

        $asayltrading = Client::create([
            'title' => 'Asayl Trading LLC',
            'title_fa' => ''
        ]);

        $alasayltrading = Project::create([
            'title' => 'Al Asayl Trading',
            'title_fa' => '',
            'subtitle' => 'Asayl Trading LLC',
            'subtitle_fa' => '',
            'image' => '',
            'about' => '',
            'about_fa' => '',
            'description' => '',
            'description_fa' => '',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2021-08-01"),
            'final_date' => Carbon::createFromFormat("Y-m-d", "2021-10-01"),
            'link' => 'alasayltrading.ae',
            'archive' => '',
            'status_id' => $completed->id,
            'client_id' => $asayltrading->id,
            'city_id' => $dubai->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $alasayltrading->categories()->attach([
            $php_developer->id,
            $web_developer->id,
            $wordpress_developer->id
        ]);

        $alasayltrading->tags()->attach([
            $core->id,
            $uiux->id,
            $deployment->id,
            $support->id,
            $php->id,
            $mysql->id,
            $wordpress->id,
            $elementor->id,
        ]);

        $image = new Imageable([
            'title' => 'Asayl Trading',
            'image' => 'images/3a747cbc768e0af8cd312e2c7fb5e1f1eddcd017.webp',
            'cover' => 1
        ]);
        $alasayltrading->images()->save($image);

        $callcafe = Project::create([
            'title' => 'CallCafe.me',
            'title_fa' => '',
            'subtitle' => 'Call Cafe',
            'subtitle_fa' => 'کال کافه',
            'image' => '',
            'about' => '',
            'about_fa' => '',
            'description' => '',
            'description_fa' => '',
            'order_date' => Carbon::createFromFormat("Y-m-d", "2022-05-1"),
            'link' => 'callcafe.me',
            'archive' => '',
            'status_id' => $under->id,
            'client_id' => $localClients->id,
            'city_id' => $bnd->id,
            'displayorder' => 0,
            'active' => 1,
        ]);

        $callcafe->categories()->attach([
            $php_developer->id,
            $web_developer->id,
            $laravel_developer->id
        ]);

        $callcafe->tags()->attach([
            $core->id,
            $uiux->id,
            $deployment->id,
            $support->id,
            $php->id,
            $mysql->id,
            $wordpress->id,
            $elementor->id,
        ]);

        $saleh = Testimonial::create([
            'language' => 'en',
            'title' => 'Saleh Azizi',
            'subtitle' => 'RavanRayaneh CEO',
            'description' => 'I worked with Tehran and Isfahan for almost two years to build an online store, but I did not get what I wanted in terms of quality and efficiency until I met Mr. Esfahani. In a short time, he delivered me a completely professional website.',
            'stars' => 5,
            'image' => 'testimonials/4b97bfcbc207304dfdd72b6aad019215d074c456.webp',
        ]);
        $saleh_fa = Testimonial::create([
            'language' => 'fa',
            'title' => 'صالح عزیزی',
            'subtitle' => 'مدیر عامل روان رایانه',
            'description' => 'نزدیک به دو سال برای ساخت فروشگاه اینترنتی با تهران و اصفهان کار کردم اما اون چیزی که میخواستم به لحاظ کیفیت و کارایی بدست نیاوردم تا اینکه با آقای اصفهانی آشنا شدم. در کمترین زمان وب سایت کاملا حرفه ای به من تحویل دادند.',
            'stars' => 5,
            'image' => 'testimonials/6bdfb77fd542f546da0028772921264645a02909.webp',
        ]);

        $saman = Testimonial::create([
            'language' => 'en',
            'title' => 'Saman Khani (RIP)',
            'subtitle' => 'RavanRayaneh Manager',
            'description' => 'From the start of the project, through to completion, Amid supported us and exceeded our expectations in every way. Not only was our experience personal and friendly, . He\'s reliable, professional and easy to work with. I can’t recommend him highly enough and we look forward to continuing our working relationship together.',
            'stars' => 5,
            'image' => 'testimonials/9a6d750669b62fda64237bfb616cac9532d4fc7c.webp',
        ]);
        $saman_fa = Testimonial::create([
            'language' => 'fa',
            'title' => 'زنده یاد سامان خانی',
            'subtitle' => 'مدیر داخلی روان رایانه',
            'description' => 'عمید از شروع پروژه تا اتمام پروژه از ما حمایت کرد و از هر نظر فراتر از انتظارات ما بود. نه تنها تجربه ما شخصی و دوستانه بود، . او قابل اعتماد، حرفه ای و کار کردن با او آسان است. من نمی توانم او را به اندازه کافی توصیه کنم و ما مشتاقانه منتظر ادامه همکاری با یکدیگر هستیم.',
            'stars' => 5,
            'image' => 'testimonials/a39d0dee16829e41f7966cdf758cc59372ca6e56.webp',
        ]);

        $Mostafa = Testimonial::create([
            'language' => 'en',
            'title' => 'Mostafa Motamedi',
            'subtitle' => 'Silver Design',
            'description' => 'If you want a completely professional website, without a doubt, I can only introduce Mr. Esfahani. They offer beyond what you have in mind.',
            'stars' => 5,
            'image' => 'testimonials/017926fd3d6cf702ee1f999ae7a874962ffe918f.webp',
        ]);
        $Mostafa_fa = Testimonial::create([
            'language' => 'fa',
            'title' => 'مصطفی معتمدی',
            'subtitle' => 'مرکز طراحی نقره‌ای',
            'description' => 'اگر یک وب سایت کاملا حرفه ای میخواین بدون شک فقط میتونم آقای اصفهانی را معرفی کنم. فراتر از چیزی که در ذهن دارید ارائه میدن.',
            'stars' => 5,
            'image' => 'testimonials/c06b3f29b3b4e2b540fa50db1fecda7338e7d3c0.webp',
        ]);

        $faraz = Testimonial::create([
            'language' => 'en',
            'title' => 'Faraz Saljoughi',
            'subtitle' => 'Artimes Sanaat Hormozgan CEO',
            'description' => 'Always available to help, incredibly proficient, hits deadlines without fail, hard working and trustworthy. In my experience, no project is too much trouble, and with Amid you really get a rare entity – someone that can simplify what can be a very complex industry at times. I can recommend his services without hesitation.',
            'stars' => 5,
            'image' => 'testimonials/3439b2a09f2b327504313ef6cc59105ac31bed3c.webp',
        ]);
        $faraz_fa = Testimonial::create([
            'language' => 'fa',
            'title' => 'فراز سلجوقی',
            'subtitle' => 'مدیر عامل شرکت آرتیمس صنعت هرمزگان',
            'description' => 'فوق العاده حرفه ای و همیشه در دسترس، ضرب الاجل ها بدون شکست، سخت کوش و قابل اعتماد. پیچیده ترین مسائل مربوط به حوضه کاری را به ساده ترین تبدیل میکرد. بدون هیچ تردیدی خدماتش رو توضیه میکنم',
            'stars' => 5,
            'image' => 'testimonials/fcbb4568a7edd90a0472312cef62a58703cb3f4d.webp',
        ]);

        $nedaei = Testimonial::create([
            'language' => 'en',
            'title' => 'Nedaei',
            'subtitle' => 'Artimes Sanaat Hormozgan CTO',
            'description' => 'Without doubt one of the most talented programmers out there. I always go back to Amid when I\'m out of my depth and he\'s never failed to deliver what I ask for. Smart, trustworthy and professional. You won\'t be disappointed.',
            'stars' => 5,
            'image' => 'testimonials/2808ac10ac5f2125be91584dd2a6b6490b4102ad.webp',
        ]);
        $nedaei_fa = Testimonial::create([
            'language' => 'fa',
            'title' => 'ندایی',
            'subtitle' => 'مدیر فناوری ارتباطات',
            'description' => 'بدون شک یکی از با استعدادترین برنامه نویسان موجود است. باهوش، قابل اعتماد و حرفه ای. شما ناامید نخواهید شد.',
            'stars' => 5,
            'image' => 'testimonials/b9aced5c4f1cf549d627d62d760ef81690c525b3.webp',
        ]);

        $kalantari = Testimonial::create([
            'language' => 'en',
            'title' => 'Kalantari',
            'subtitle' => 'Director of Kalantari Jewelry',
            'description' => 'Discipline, accuracy, follow-up, speed and professional ethics are the words that can describe Mr. Isfahani and his team in performing their duties. And I recommend them to my friends and other colleagues. And I hope that all my dear compatriots in any profession who work hard will work in this way and with high motivation and efficiency, so that we, Iranians, can rise to the top.',
            'stars' => 5,
            'image' => 'testimonials/795930e9e891d46c7df055bcada9505af6331a4a.webp',
        ]);
        $kalantari_fa = Testimonial::create([
            'language' => 'fa',
            'title' => 'کلانتری',
            'subtitle' => 'مدیر جواهری کلانتری',
            'description' => 'نظم ، دقت ،پیگیری ، سرعت و اخلاق حرفه ای ، کلماتی هستند که میتوانند آقای مهندس اصفهانی و تیم ایشان را در انجام امور محوله توصیف نمایند. و اینجانب ایشان را به دوستان و دیگر همکاران خود توصیه مینمایم . و امیدوارم همه هموطنان عزیزم در هر حرفه ای که زحمت میکشند بدین شکل و با انگیزه و بازده بالا کار کنند ، تا ایرانی سر فراز داشته باشیم.',
            'stars' => 5,
            'image' => 'testimonials/f55695664179e2ae740ca6a43423d7ea839f9bd3.webp',
        ]);

        $khorami = Testimonial::create([
            'language' => 'en',
            'title' => 'Farid Khorrami',
            'subtitle' => 'Ideh Pardazan CEO',
            'description' => 'Well, honestly, along with high technical ability, professional ethics, honesty, constant response, and honesty and integrity, it is unparalleled, that it is always safe to assume that your information is in the right hands, I recommend you work with it.',
            'stars' => 5,
            'image' => 'testimonials/63a61ea311481aab990f887be6cd7beba8738960.webp',
        ]);
        $khorami_fa = Testimonial::create([
            'language' => 'fa',
            'title' => 'فرید خرمی',
            'subtitle' => 'مدیر عامل شرکت ایده پردازان',
            'description' => 'خب راستش در کنار توان بالای فنی، اخلاق حرفه ای ،صداقت، پاسخگویی همیشگی و امانتداری و درستکاریش بی نظیره، اینکه همیشه خیالت راحته که اطلاعاتت دست آدم درستیه توصیه میکنم باهاش کار بکنید',
            'stars' => 5,
            'image' => 'testimonials/a5f3c72ac1c417f91e9d5bbc7601c60323034124.webp',
        ]);

        $kharazmi = Testimonial::create([
            'language' => 'en',
            'title' => 'Farid Kharazmi',
            'subtitle' => 'Tejarat Pishegan CEO',
            'description' => 'I must admit that I should never have seen such strong support to guide the user with great patience and in the easiest and most beautiful way possible. Just like a class, I can use the Justice Engineer and learn new things. Wishing you and your esteemed team increasing success',
            'stars' => 5,
            'image' => 'testimonials/1de5ef03f151335c603dd936cbbdb0fbe61eec1f.webp',
        ]);
        $kharazmi_fa = Testimonial::create([
            'language' => 'fa',
            'title' => 'فرید خوارزمی',
            'subtitle' => 'مدیر عامل شرکت تجارت پیشگان',
            'description' => 'اعتراف کنم که باید تا کنون به این شکل پشتیبانی قوی ندیده بود که با صبر و حوصله زیاد و به آسانترین و زیباترین شکل ممکن کاربر را راهنمایی کند. درست مثل یک کلاس می توانم از مهندس عدالت استفاده کنم و چیزهای جدید را یاد بگیرم. با آرزوی موفقیت روزافزون شما و تیم محترمتان',
            'stars' => 5,
            'image' => 'testimonials/78155cc907378aa5b48f33be340a6096f8dbfa0b.webp',
        ]);

        $hajebi = Testimonial::create([
            'language' => 'en',
            'title' => 'Shahriyar Hajebi',
            'subtitle' => 'Shaparak Gallery Manager',
            'description' => 'Mr. Isfahani is very active and regular, during my 5 years of friendship with him, I introduced many people to design the website and all of them were very satisfied in every way. Quality in service, honesty in work, speed in doing work and most importantly support and service after work are very, very exemplary. I wish them good health and increasing success in their work',
            'stars' => 5,
            'image' => 'testimonials/9d1a9a0b57e2b8d4591c0f91f7acd1095c9f0c50.webp',
        ]);
        $hajebi_fa = Testimonial::create([
            'language' => 'fa',
            'title' => 'شهریار حاجبی',
            'subtitle' => 'مدیریت گالری شاپرک',
            'description' => 'جناب مهندس اصفهانی بسیار فعال و منظم هستند، من در طول 5 سال دوستی با ایشان افراد بسیاری رو برای طراحی وب سایت معرفی کردم و همه آنها از هر لحاظ رضایت بسیاری داشتند. کیفیت در خدمات ، صداقت در کار ، سرعت در انجام کار و از همه مهتر پشتیبانی و خدمات پس از انجام کار آنها بسیار بسیار مثال زدنی است. برای ایشان آرزوی سلامتی و توفیق روز افزون در کارها را خواستارم',
            'stars' => 5,
            'image' => 'testimonials/b2d47d9ced85a290b56860d9de35ffd019c5345b.webp',
        ]);

        $kalantarigold->testimonials()->attach([
            $kalantari->id, $kalantari_fa->id
        ]);
        $joonoobia->testimonials()->attach([
            $khorami->id, $khorami_fa->id
        ]);
        $RavanRayaneh->testimonials()->attach([
            $saleh->id, $saleh_fa->id, $saman->id, $saman_fa->id
        ]);
        $shaparakgallery->testimonials()->attach([
            $hajebi->id, $hajebi_fa->id
        ]);

        Brand::create([
            'title' => 'Ravan Rayaneh',
            'title_fa' => 'روان رایانه',
            'logo' => 'brands/7b4453d4b30a71842de789b4854eff79b4b0ceac.webp'
        ]);

        Brand::create([
            'title' => 'Artimes Co',
            'title_fa' => 'آرتیمس',
            'logo' => 'brands/2ff333f372a4bdf5ab7aa26e2fd0fba820178920.webp'
        ]);

        Brand::create([
            'title' => 'Shaparak Gallery',
            'title_fa' => 'شاپرک گالری',
            'logo' => 'brands/46a055a7fc6262b51a5eea94ed5a17777ea12eb3.webp'
        ]);

        Brand::create([
            'title' => 'iBelit',
            'title_fa' => 'آی‌بلیت',
            'logo' => 'brands/8bd4dc09a13f8297f1f88608c18edfcb93d5e7a2.webp'
        ]);

        Brand::create([
            'title' => 'Dorna Navaye Mihan',
            'title_fa' => 'درنا نوای میهن',
            'logo' => 'brands/cca8deb55b4668010b0dad5d398e71c7605ee33e.webp'
        ]);

        Brand::create([
            'title' => 'Ide Pardazan Setayesh',
            'title_fa' => 'ایده پردازان ستایش',
            'logo' => 'brands/7d0ff68be35013f1c8dbba94325d36735394bd29.webp'
        ]);

        Brand::create([
            'title' => 'Mizbanha',
            'title_fa' => 'میزبان‌ها',
            'logo' => 'brands/c46dfe5a71cf07bdb3eb48a5c7c7f557d56d0e7d.webp'
        ]);

        Brand::create([
            'title' => 'iBelit',
            'title_fa' => 'آی‌بلیت',
            'logo' => 'brands/7b4453d4b30a71842de789b4854eff79b4b0ceac.webp'
        ]);

        DataNumber::create([
            'key' => 'Experience', 'value' => Carbon::createFromFormat('Y-m-d', '2006-02-17')->diff()->y
        ]);
        DataNumber::create([
            'key' => 'Projects', 'value' => 50
        ]);
        DataNumber::create([
            'key' => 'HappyCustomers', 'value' => 30
        ]);

        DataString::create([
            'key' => 'art-title',
            'value' => 'Discover my Amazing',
            'language' => 'en'
        ]);
        DataString::create([
            'key' => 'art-subtitle',
            'value' => 'Code Space!',
            'language' => 'en'
        ]);

        DataString::create([
            'key' => 'txt-rotate-title',
            'value' => 'I build',
            'language' => 'en'
        ]);
        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'web applications',
            'language' => 'en'
        ]);
        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'ios and android applications.',
            'language' => 'en'
        ]);
        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'web interfaces.',
            'language' => 'en'
        ]);
        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'windows applications.',
            'language' => 'en'
        ]);

        DataString::create([
            'key' => 'txt-contact-banner-title',
            'value' => 'Ready to order your project?',
            'language' => 'en'
        ]);
        DataString::create([
            'key' => 'txt-contact-banner-body',
            'value' => 'Let\'s work together!',
            'language' => 'en'
        ]);


        // fa
        DataString::create([
            'key' => 'art-title',
            'value' => 'طراحی و برنامه نویسی',
            'language' => 'fa'
        ]);
        DataString::create([
            'key' => 'art-subtitle',
            'value' => 'تا مدیریت پروژه!',
            'language' => 'fa'
        ]);

        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'طراحی صفحات وب',
            'language' => 'fa'
        ]);
        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'برنامه نویسی وب',
            'language' => 'fa'
        ]);
        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'نرم افزار ویندوز',
            'language' => 'fa'
        ]);
        DataString::create([
            'key' => 'txt-rotate',
            'value' => 'برنامه موبایل اندروید و آیفون',
            'language' => 'fa'
        ]);

        DataString::create([
            'key' => 'txt-contact-banner-title',
            'value' => 'برای سفارش پروژه خود آماده اید؟',
            'language' => 'fa'
        ]);
        DataString::create([
            'key' => 'txt-contact-banner-body',
            'value' => 'پس کار رو شروع کنیم!',
            'language' => 'fa'
        ]);


        DataImage::create([
            'key' => 'section-bg',
            'value' => 'data-images/b4654a13fce8833d5bf4c444c83c6ab520b5ee14.webp',
            'language' => ''
        ]);
        DataImage::create([
            'key' => 'banner-bg',
            'value' => 'data-images/dfc1f656cd11f3310d00dc39bf2c9970b8d224e4.webp',
            'language' => ''
        ]);
    }
}
