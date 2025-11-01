<?php

namespace Database\Seeders;

use App\Models\Pages\Home\HomeHero;
use App\Models\Pages\Home\HomeHistory;
use App\Models\Pages\Home\HomeMessage;
use App\Models\Pages\Home\HomeMission;
use App\Models\Pages\Home\HomeKnow;
use App\Models\Pages\About\AboutAbout;
use App\Models\Pages\About\AboutMessage;
use App\Models\Pages\About\AboutMission;
use App\Models\Pages\About\AboutTouch;
use App\Models\Pages\Academic\AcademicApproach;
use App\Models\Pages\Academic\AcademicChoose;
use App\Models\Pages\Admission\AdmissionPolicy;
use App\Models\Pages\Admission\AdmissionDocument;
use App\Models\Pages\CalendarEvent;
use App\Models\Pages\Campus;
use App\Models\Pages\Classroom;
use App\Models\Pages\News;
use App\Models\Pages\Gallery;
use App\Models\System\Users\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FrontendPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->error('No users found. Please create a user first.');
            return;
        }

        $this->seedHomeHero($user);
        $this->seedHomeHistory($user);
        $this->seedHomeMessage($user);
        $this->seedHomeMission($user);
        $this->seedHomeKnow($user);
        
        $this->seedAboutAbout($user);
        $this->seedAboutMessage($user);
        $this->seedAboutMission($user);
        $this->seedAboutTouch($user);
        
        $this->seedAcademicApproach($user);
        $this->seedAcademicChoose($user);
        
        $this->seedAdmissionPolicy($user);
        $this->seedAdmissionDocuments($user);
        
        $this->seedCalendarEvents($user);
        $this->seedCampuses($user);
        $this->seedClassrooms($user);
        $this->seedNews($user);
        $this->seedGallery($user);

        $this->command->info('Frontend pages seeded successfully!');
    }

    // HOME PAGE SEEDERS
    private function seedHomeHero($user)
    {
        $defaultBranch = \App\Models\Pages\Branch::first();

        HomeHero::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch?->id,
            'title' => [
                'en' => 'Kurd Genius Schools',
                'ckb' => 'قوتابخانەی کوردجینیس',
            ],
            'subtitle' => [
                'en' => 'Quality Education, Bright Future',
                'ckb' => 'پەروەردەی باش، داهاتووی گەشاوە',
            ],
            'metadata' => [
                'expert_tutors' => '100',
                'students' => '2000',
                'years_experience' => '12',
                'campuses' => '3',
            ],
            'is_active' => true,
        ]);

        $this->command->info('Home hero seeded.');
    }

    private function seedHomeHistory($user)
    {
        $defaultBranch = \App\Models\Pages\Branch::first();

        HomeHistory::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch?->id,
            'description' => [
                'en' => 'Founded in 2013 by Maya Company, Kurd Genius School has grown to become one of the leading educational institutions in the Kurdistan Region. Over the years, we have maintained our commitment to excellence, producing graduates who excel in universities and contribute meaningfully to society.',
                'ckb' => 'قوتابخانەی کوردجینیس لە ساڵی ٢٠١٣دا لەلایەن کۆمپانیای مایاوە دامەزراوە و بووەتە یەکێک لە پێشەنگترین دامەزراوە پەروەردەییەکانی هەرێمی کوردستان. لە ماوەی ساڵانی ڕابردوودا، پابەندبووینمان بە باشی پاراستووە و دەرچووانێکمان بەرهەمهێناوە کە لە زانکۆکاندا سەرکەوتوون و بەشێوەیەکی بەنرخ بەشداری کۆمەڵگا دەکەن.',
            ],
            'is_active' => true,
        ]);

        $this->command->info('Home history seeded.');
    }

    private function seedHomeMessage($user)
    {
        $defaultBranch = \App\Models\Pages\Branch::first();

        HomeMessage::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch?->id,
            'description' => [
                'en' => 'We are committed to providing high-quality education that nurtures intellectual curiosity, critical thinking, and personal growth. Our dedicated team of educators works tirelessly to ensure that every student receives the support and guidance they need to succeed.',
                'ckb' => 'ئێمە پابەندین بە دابینکردنی پەروەردەیەکی باش کە کنجکاوی زیرەکانە، بیرکردنەوەی ڕەخنەگرانە و گەشەی کەسی پەروەردە دەکات. تیمی بەخشراوی پەروەردەکارانمان بێ ماندووبوون کار دەکات بۆ دڵنیابوون لەوەی کە هەر خوێندکارێک پشتیوانی و ڕێنمایی پێویستی وەردەگرێت بۆ سەرکەوتن.',
            ],
            'is_active' => true,
        ]);

        $this->command->info('Home message seeded.');
    }

    private function seedHomeMission($user)
    {
        $defaultBranch = \App\Models\Pages\Branch::first();

        HomeMission::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch?->id,
            'description' => [
                'en' => 'To deliver excellence in education through innovative teaching methods, a supportive learning environment, and a curriculum that balances academic achievement with character development. We strive to prepare students not just for exams, but for life.',
                'ckb' => 'گەیاندنی باشی لە پەروەردەدا لە ڕێگەی شێوازە نوێیەکانی وانەوتنەوە، ژینگەیەکی پشتیوانی فێربوون و مەنهەجێک کە هاوسەنگی لە نێوان دەستکەوتی ئەکادیمی و گەشەپێدانی کەسایەتیدا دروست دەکات. ئێمە هەوڵ دەدەین خوێندکاران نەک تەنها بۆ تاقیکردنەوەکان، بەڵکو بۆ ژیان ئامادە بکەین.',
            ],
            'is_active' => true,
        ]);

        $this->command->info('Home mission seeded.');
    }

    private function seedHomeKnow($user)
    {
        $defaultBranch = \App\Models\Pages\Branch::first();

        HomeKnow::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch?->id,
            'metadata' => [
                'youtube' => 'https://www.youtube.com/@kurdgenius',
                'facebook' => 'https://www.facebook.com/kurdgenius',
                'instagram' => 'https://www.instagram.com/kurdgenius',
                'twitter' => 'https://twitter.com/kurdgenius',
            ],
            'is_active' => true,
        ]);

        $this->command->info('Home social links seeded.');
    }

    // ABOUT PAGE SEEDERS
    private function seedAboutAbout($user)
    {
        $defaultBranch = \App\Models\Pages\Branch::first();

        // about_abouts table currently stores description only (plus user/branch/is_active)
        AboutAbout::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch?->id,
            'description' => [
                'en' => 'Kurd Genius School was established in 2013 by Maya Company, a proud member of the Qaiwan Group of Companies, and is led by Mrs. Sozan Abubakr Mawlud. Since its foundation, the school has consistently ranked among the top performing educational institutions in the Kurdistan Region.',
                'ckb' => 'قوتابخانەی کوردجینیس لە ساڵی ٢٠١٣دا لەلایەن کۆمپانیای مایاوە دامەزراوە، ئەندامێکی شانازی دەرەوەی کۆمپانیاکانی قەیوانە، و لەلایەن خاتوو سۆزان ئەبووبەکر مەولوودەوە بەڕێوە دەبرێت.',
                'ar' => 'تأسست مدرسة كورد جينيوس في عام 2013 من قبل شركة مايا، وهي عضو فخور في مجموعة قيوان للشركات، وتديرها السيدة سوزان أبوبكر مولود.',
            ],
            'is_active' => true,
        ]);

        $this->command->info('About about seeded.');
    }

    private function seedAboutMessage($user)
    {
        $defaultBranch = \App\Models\Pages\Branch::first();

        // about_messages table stores description, author, order, is_active
        AboutMessage::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch?->id,
            'description' => [
                'en' => 'We are committed to providing high-quality education that nurtures intellectual curiosity, critical thinking, and personal growth. Our message is to empower students to become confident, compassionate, and responsible global citizens.',
                'ckb' => 'ئێمە پابەندین بە دابینکردنی پەروەردەیەکی باش کە کنجکاوی زیرەکانە، بیرکردنەوەی ڕەخنەگرانە و گەشەی کەسی پەروەردە دەکات.',
                'ar' => 'نحن ملتزمون بتوفير تعليم عالي الجودة يغذي الفضول الفكري والتفكير النقدي والنمو الشخصي.',
            ],
            'author' => [
                'en' => 'Mrs. Sozan Abubakr Mawlud',
                'ckb' => 'خاتوو سۆزان ئەبووبەکر مەولوود',
                'ar' => 'السيدة سوزان أبوبكر مولود',
            ],
            'is_active' => true,
        ]);

        $this->command->info('About message seeded.');
    }

    private function seedAboutMission($user)
    {
        $defaultBranch = \App\Models\Pages\Branch::first();

        // about_missions table stores description and is_active
        AboutMission::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch?->id,
            'description' => [
                'en' => 'To deliver excellence in education through innovative teaching methods, a supportive learning environment, and a curriculum that balances academic achievement with character development.',
                'ckb' => 'گەیاندنی باشی لە پەروەردەدا لە ڕێگەی شێوازە نوێیەکانی وانەوتنەوە و ژینگەیەکی پشتیوانی فێربوون.',
                'ar' => 'تقديم التميز في التعليم من خلال أساليب تدريس مبتكرة وبيئة تعليمية داعمة.',
            ],
            'is_active' => true,
        ]);

        $this->command->info('About mission seeded.');
    }

    private function seedAboutTouch($user)
    {
        $defaultBranch = \App\Models\Pages\Branch::first();

        AboutTouch::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch?->id,
            'contact_email' => 'kurdgeniusschool@gmail.com',
            'contact_phone' => '+964 770 342 0606',
            'contact_address' => [
                'en' => 'Main Street, Educational District, Erbil, Kurdistan Region',
                'ckb' => 'شەقامی سەرەکی، دەڤەری پەروەردە، هەولێر، هەرێمی کوردستان',
                'ar' => 'الشارع الرئيسي، المنطقة التعليمية، أربيل، إقليم كوردستان',
            ],
            'is_active' => true,
        ]);

        $this->command->info('About touch seeded.');
    }

    // ACADEMIC PAGE SEEDERS
    private function seedAcademicApproach($user)
    {
        AcademicApproach::create([
            'user_id' => $user->id,
            'description' => [
                'en' => 'We believe in fostering a learning environment where students are active participants in their education. Our approach combines traditional wisdom with modern pedagogical methods.',
                'ckb' => 'ئێمە باوەڕمان بە پەروەردەکردنی ژینگەیەکی فێربوونە کە خوێندکاران بەشداربووی چالاکن لە پەروەردەکەیاندا.',
            ],
            'features' => [
                'en' => [
                    ['title' => 'Personalized Learning Plans'],
                    ['title' => 'Interactive Classrooms'],
                    ['title' => 'Project-Based Learning'],
                    ['title' => 'Critical Thinking Development'],
                ],
                'ckb' => [
                    ['title' => 'پلانی فێربوونی تایبەتمەند'],
                    ['title' => 'پۆلە کارلێکەرەکان'],
                    ['title' => 'فێربوونی بنەما لەسەر پرۆژە'],
                    ['title' => 'گەشەپێدانی بیرکردنەوەی ڕەخنەگرانە'],
                ],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Academic approach seeded.');
    }

    private function seedAcademicChoose($user)
    {
        AcademicChoose::create([
            'user_id' => $user->id,
            'description' => [
                'en' => 'We believe every student is unique. That\'s why our low student-to-teacher ratio allows for personalized attention and tailored learning paths — ensuring academic success and emotional growth.',
                'ckb' => 'ئێمە باوەڕمان وایە هەر خوێندکارێک تایبەتە. بۆیە ڕێژەی کەمی خوێندکار بۆ مامۆستا ڕێگە بە سەرنج و ڕێگای فێربوونی تایبەتمەند دەدات.',
            ],
            'reasons' => [
                'en' => [
                    ['title' => 'Top-ranked educational institution', 'description' => 'Leading excellence in education'],
                    ['title' => 'Experienced and qualified teachers', 'description' => 'Expert educators dedicated to student success'],
                    ['title' => 'State-of-the-art facilities', 'description' => 'Modern learning environment and resources'],
                ],
                'ckb' => [
                    ['title' => 'دامەزراوەی پەروەردەی پلەی یەکەم', 'description' => 'پێشەنگی باشی لە پەروەردەدا'],
                    ['title' => 'مامۆستایانی شارەزا و شایستە', 'description' => 'مامۆستایانی پسپۆڕ تەرخانکراو بۆ سەرکەوتنی خوێندکار'],
                    ['title' => 'کەرەستەی سەردەم', 'description' => 'ژینگەی فێربوونی مۆدێرن و سەرچاوەکان'],
                ],
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        $this->command->info('Academic choose seeded.');
    }

    // ADMISSION PAGE SEEDERS
    private function seedAdmissionPolicy($user)
    {
        // Get the first branch (default branch)
        $defaultBranch = \App\Models\Pages\Branch::first();
        
        if (!$defaultBranch) {
            $this->command->warn('No branch found. Skipping admission policy seeding.');
            return;
        }

        AdmissionPolicy::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch->id,
            'description' => [
                'en' => 'Kurd Genius School maintains a fair and transparent admission process. We welcome students from diverse backgrounds who demonstrate a genuine interest in learning and personal growth.',
                'ckb' => 'قوتابخانەی کوردجینیس پرۆسەیەکی دادپەروەرانە و ڕوونی وەرگرتنی هەیە. ئێمە پێشوازی لە خوێندکاران دەکەین لە پاشخانە جیاوازەکانەوە.',
            ],
            'requirements' => [
                'en' => 'Students must meet age requirements, submit required documents, pass entrance assessment, and attend an interview with parents.',
                'ckb' => 'خوێندکاران دەبێت پێداویستیەکانی تەمەن پڕبکەنەوە، بەڵگەنامە پێویستەکان پێشکەش بکەن، هەڵسەنگاندنی چوونەژوورەوە تێبپەڕێنن، و لەگەڵ دایک و باوک چاوپێکەوتنێک ئەنجام بدەن.',
            ],
            'steps' => [
                'en' => [
                    // First 4 cards - Admission Process Steps
                    ['level' => 'First', 'title' => 'Entrance assessment & interview'],
                    ['level' => 'Second', 'title' => 'Review of academic records and conduct'],
                    ['level' => 'Third', 'title' => 'Preference for early applicants and siblings'],
                    ['level' => 'Fourth', 'title' => 'Final approval by the admissions committee'],
                    // Last 3 cards - Application Methods
                    ['level' => 'Read', 'title' => 'School reception'],
                    ['level' => 'Download', 'title' => 'Download from our official website'],
                    ['level' => 'Message', 'title' => 'Email request: kurdgeniusschool@gmail.com'],
                ],
                'ckb' => [
                    // First 4 cards - Admission Process Steps
                    ['level' => 'یەکەم', 'title' => 'هەڵسەنگاندن و چاوپێکەوتنی چوونەژوورەوە'],
                    ['level' => 'دووەم', 'title' => 'پێداچوونەوەی تۆمارەکانی ئەکادیمی و ڕەفتار'],
                    ['level' => 'سێیەم', 'title' => 'ئەولەویەت بۆ داواکارانی زوو و خوشک و براکان'],
                    ['level' => 'چوارەم', 'title' => 'پەسەندکردنی کۆتایی لەلایەن لیژنەی وەرگرتنەوە'],
                    // Last 3 cards - Application Methods
                    ['level' => 'خوێندنەوە', 'title' => 'وەرگرتنی قوتابخانە'],
                    ['level' => 'داگرتن', 'title' => 'داگرتن لە ماڵپەڕی فەرمیمان'],
                    ['level' => 'نامە', 'title' => 'داواکاری ئیمەیڵ: kurdgeniusschool@gmail.com'],
                ],
            ],
            'is_active' => true,
        ]);

        $this->command->info('Admission policy seeded.');
    }

    private function seedAdmissionDocuments($user)
    {
        // Get the first branch (default branch)
        $defaultBranch = \App\Models\Pages\Branch::first();
        
        if (!$defaultBranch) {
            $this->command->warn('No branch found. Skipping admission documents seeding.');
            return;
        }

        AdmissionDocument::create([
            'user_id' => $user->id,
            'branch_id' => $defaultBranch->id,
            'documents' => [
                'en' => [
                    ['title' => 'Copy of passport or national ID', 'icon' => '/img/admission/passport.svg'],
                    ['title' => '6 recent passport-sized photos', 'icon' => '/img/admission/editing.svg'],
                    ['title' => 'Academic transcripts or report cards', 'icon' => '/img/admission/report.svg'],
                    ['title' => 'Medical & vaccination records', 'icon' => '/img/admission/medicine.svg'],
                ],
                'ckb' => [
                    ['title' => 'کۆپی پاسپۆرت یان ناسنامەی نیشتمانی', 'icon' => '/img/admission/passport.svg'],
                    ['title' => '٦ وێنەی پاسپۆرتی نوێ', 'icon' => '/img/admission/editing.svg'],
                    ['title' => 'پەڕگەکانی ئەکادیمی یان کارتی ڕاپۆرت', 'icon' => '/img/admission/report.svg'],
                    ['title' => 'تۆمارەکانی پزیشکی و کوتان', 'icon' => '/img/admission/medicine.svg'],
                ],
            ],
            'is_active' => true,
        ]);

        $this->command->info('Admission documents seeded.');
    }

    // EXISTING SEEDERS (Calendar, Campus, Classroom, News)
    private function seedCalendarEvents($user)
    {
        $events = [
            [
                'title' => 'First Day of School',
                'description' => 'Academic year begins for all grades',
                'event_type' => 'academic',
                'start_date' => Carbon::create(2025, 9, 1),
                'color' => '#5977FE',
            ],
            [
                'title' => 'Newroz Holiday',
                'description' => 'Kurdish New Year celebration',
                'event_type' => 'official',
                'start_date' => Carbon::create(2026, 3, 21),
                'color' => '#FFC107',
            ],
            [
                'title' => 'Mid-Term Exams',
                'description' => 'First semester midterm examinations',
                'event_type' => 'exam',
                'start_date' => Carbon::create(2025, 11, 15),
                'end_date' => Carbon::create(2025, 11, 22),
                'color' => '#FF5722',
            ],
        ];

        foreach ($events as $event) {
            CalendarEvent::create(array_merge($event, ['user_id' => $user->id]));
        }

        $this->command->info('Calendar events seeded.');
    }

    private function seedCampuses($user)
    {
        // Get the first branch (default branch)
        $defaultBranch = \App\Models\Pages\Branch::first();
        
        if (!$defaultBranch) {
            $this->command->warn('No branch found. Skipping campuses seeding.');
            return;
        }

        $campuses = [
            [
                'title' => [
                    'en' => 'Kurd Genius Educational Communities',
                    'ckb' => 'کۆمەڵگای پەروەردەیی کورد جینیۆس',
                    'ar' => 'المجتمعات التعليمية لكرد جينيوس',
                ],
                'content' => [
                    'en' => 'The main Kurd Genius campus is located in a vibrant educational district, offering students access to modern classrooms, advanced science laboratories, sports facilities, and cultural centers.',
                    'ckb' => 'کەمپی سەرەکی کورد جینیۆس لە ناوچەیەکی پەروەردەیی گەشاوە جێگیرە، دەرفەتی بەکارهێنانی پۆلی مۆدێرن، تاقیگەی زانستی پێشکەوتوو، ئامێری وەرزشی و ناوەندە کولتووریەکان بۆ قوتابیان دابین دەکات.',
                    'ar' => 'يقع الحرم الرئيسي لكرد جينيوس في منطقة تعليمية نابضة بالحياة، ويوفر للطلاب الوصول إلى الفصول الدراسية الحديثة والمختبرات العلمية المتقدمة والمرافق الرياضية والمراكز الثقافية.',
                ],
                'views' => 0,
                'order' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($campuses as $campus) {
            Campus::create(array_merge($campus, [
                'user_id' => $user->id,
                'branch_id' => $defaultBranch->id
            ]));
        }

        $this->command->info('Campuses seeded.');
    }

    private function seedClassrooms($user)
    {
        // Get the first branch (default branch)
        $defaultBranch = \App\Models\Pages\Branch::first();
        
        if (!$defaultBranch) {
            $this->command->warn('No branch found. Skipping classrooms seeding.');
            return;
        }

        $classrooms = [
            [
                'title' => [
                    'en' => 'Science Laboratory',
                    'ckb' => 'تاقیگەی زانست',
                ],
                'content' => [
                    'en' => '<p>Our state-of-the-art science laboratory is equipped with modern technology and equipment, providing students with hands-on experience in conducting experiments and research.</p><p>The laboratory includes microscopes, lab benches, safety equipment, and digital displays to support various scientific disciplines including physics, chemistry, and biology.</p>',
                    'ckb' => '<p>تاقیگە زانستیەکانمان بە تەکنەلۆژیای مۆدێرن و ئامێرەکانی پێشکەوتوو چەکدار کراوە، کە ئەزموونی مەشقی بۆ قوتابیان دابین دەکات لە ئەنجامدانی تاقیکردنەوە و توێژینەوەدا.</p><p>تاقیگەکە میکرۆسکۆپ، میزی تاقیگە، ئامێری پاراستن و پیشاندەری دیجیتاڵی تێدایە بۆ پشتگیریکردنی بوارە زانستییە جیاوازەکان وەک فیزیک، کیمیا و بایەلۆژی.</p>',
                ],
                'views' => 0,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Library & Resource Center',
                    'ckb' => 'کتێبخانە و سەنتەری سەرچاوەکان',
                ],
                'content' => [
                    'en' => '<p>Our comprehensive library offers over 10,000 books, digital resources, and dedicated study spaces for students. The library is designed to foster a love of reading and provide resources for academic research.</p><p>Features include quiet study rooms, computer access, and a wide selection of reference materials across all subjects.</p>',
                    'ckb' => '<p>کتێبخانە گشتگیرەکەمان زیاتر لە ١٠،٠٠٠ کتێب، سەرچاوەی دیجیتاڵ و شوێنی تایبەتی خوێندن بۆ قوتابیان دابین دەکات. کتێبخانەکە دیزاین کراوە بۆ پەروەردەکردنی خۆشەویستی خوێندنەوە و دابینکردنی سەرچاوەکان بۆ توێژینەوەی ئەکادیمی.</p><p>تایبەتمەندییەکان ژووری بێدەنگی خوێندن، دەستڕاگەیشتن بە کۆمپیوتەر و هەڵبژاردنێکی فراوانی مادەی سەرچاوە لە هەموو بابەتەکاندا دەگرێتەوە.</p>',
                ],
                'views' => 0,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => [
                    'en' => 'Computer Laboratory',
                    'ckb' => 'تاقیگەی کۆمپیوتەر',
                ],
                'content' => [
                    'en' => '<p>Our modern computer laboratory is equipped with 40 high-performance computers, projectors, and coding software for programming classes.</p><p>Students have access to industry-standard development tools and software, preparing them for careers in technology and computer science.</p>',
                    'ckb' => '<p>تاقیگەی کۆمپیوتەری مۆدێرنەکەمان چەکدار کراوە بە ٤٠ کۆمپیوتەری بەرزکارایی، پرۆژێکتەر و نەرمەڕەقی کۆدنووسی بۆ وانەکانی بەرنامەسازی.</p><p>قوتابیان دەستڕاگەیشتنیان هەیە بە ئامرازەکانی پەرەپێدان و نەرمەڕەقی ستانداردی پیشەسازی، کە ئامادەیان دەکات بۆ کارەکان لە تەکنەلۆژیا و زانستی کۆمپیوتەردا.</p>',
                ],
                'views' => 0,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($classrooms as $classroomData) {
            Classroom::create(array_merge($classroomData, [
                'user_id' => $user->id,
                'branch_id' => $defaultBranch->id
            ]));
        }

        $this->command->info('Classrooms seeded.');
    }

    private function seedNews($user)
    {
        // Get the first branch (default branch)
        $defaultBranch = \App\Models\Pages\Branch::first();
        
        if (!$defaultBranch) {
            $this->command->warn('No branch found. Skipping news seeding.');
            return;
        }

        // First, seed categories
        $categories = [
            [
                'name' => ['en' => 'Achievement', 'ckb' => 'دەستکەوت', 'ar' => 'إنجاز'],
                'slug' => 'achievement',
                'description' => ['en' => 'Student and school achievements', 'ckb' => 'دەستکەوتەکانی قوتابیان و قوتابخانە', 'ar' => 'إنجازات الطلاب والمدرسة'],
                'order' => 1,
            ],
            [
                'name' => ['en' => 'Facilities', 'ckb' => 'ئامێرەکان', 'ar' => 'المرافق'],
                'slug' => 'facilities',
                'description' => ['en' => 'School facilities and infrastructure', 'ckb' => 'ئامێرەکان و ژێرخانی قوتابخانە', 'ar' => 'مرافق وبنية تحتية للمدرسة'],
                'order' => 2,
            ],
            [
                'name' => ['en' => 'Events', 'ckb' => 'بۆنەکان', 'ar' => 'الفعاليات'],
                'slug' => 'events',
                'description' => ['en' => 'School events and activities', 'ckb' => 'بۆنە و چالاکییەکانی قوتابخانە', 'ar' => 'فعاليات وأنشطة المدرسة'],
                'order' => 3,
            ],
        ];

        $categoryModels = [];
        foreach ($categories as $category) {
            $categoryModels[$category['slug']] = \App\Models\Pages\Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        // Second, seed hashtags
        $hashtags = [
            [
                'name' => ['en' => 'Excellence', 'ckb' => 'باشی', 'ar' => 'التميز'],
                'slug' => 'excellence',
            ],
            [
                'name' => ['en' => 'Science', 'ckb' => 'زانست', 'ar' => 'العلوم'],
                'slug' => 'science',
            ],
            [
                'name' => ['en' => 'Achievement', 'ckb' => 'دەستکەوت', 'ar' => 'الإنجاز'],
                'slug' => 'achievement',
            ],
            [
                'name' => ['en' => 'STEM', 'ckb' => 'STEM', 'ar' => 'STEM'],
                'slug' => 'stem',
            ],
            [
                'name' => ['en' => 'Innovation', 'ckb' => 'داهێنان', 'ar' => 'الابتكار'],
                'slug' => 'innovation',
            ],
            [
                'name' => ['en' => 'Education', 'ckb' => 'پەروەردە', 'ar' => 'التعليم'],
                'slug' => 'education',
            ],
            [
                'name' => ['en' => 'Culture', 'ckb' => 'کولتوور', 'ar' => 'الثقافة'],
                'slug' => 'culture',
            ],
            [
                'name' => ['en' => 'Diversity', 'ckb' => 'جۆراوجۆری', 'ar' => 'التنوع'],
                'slug' => 'diversity',
            ],
            [
                'name' => ['en' => 'Community', 'ckb' => 'کۆمەڵگا', 'ar' => 'المجتمع'],
                'slug' => 'community',
            ],
        ];

        $hashtagModels = [];
        foreach ($hashtags as $hashtag) {
            $hashtagModels[$hashtag['slug']] = \App\Models\Pages\Hashtag::updateOrCreate(
                ['slug' => $hashtag['slug']],
                $hashtag
            );
        }

        // Now seed news with relationships
        $news = [
            [
                'title' => [
                    'en' => 'Kurd Genius Students Excel in National Competition',
                    'ckb' => 'قوتابیانی کورد جینیۆس لە ڕکابەرییەکی نیشتمانی دا سەرکەوتوو دەبن',
                    'ar' => 'طلاب كرد جينيوس يتفوقون في المسابقة الوطنية',
                ],
                'content' => [
                    'en' => 'We are proud to announce that our students have achieved outstanding results in the National Science and Mathematics Competition. This remarkable achievement demonstrates the dedication of our students and the quality of education at Kurd Genius.',
                    'ckb' => 'شانازی بەوە دەکەین کە ڕابگەیەنین قوتابیانەکانمان ئەنجامی نایاب لە ڕکابەریی نیشتمانی زانست و بیرکاری دا بەدەست هێناوە. ئەم دەستکەوتە سەرنجڕاکێشە بەڵگەیە لەسەر بەخشندەیی قوتابیانەکانمان و کوالیتی پەروەردە لە کورد جینیۆس.',
                    'ar' => 'يسعدنا أن نعلن أن طلابنا حققوا نتائج متميزة في مسابقة العلوم والرياضيات الوطنية. يوضح هذا الإنجاز الرائع تفاني طلابنا وجودة التعليم في كرد جينيوس.',
                ],
                'category' => 'achievement',
                'hashtags' => ['excellence', 'science', 'achievement'],
                'order' => 1,
            ],
            [
                'title' => [
                    'en' => 'New STEM Laboratory Opens at Kurd Genius',
                    'ckb' => 'تاقیگەی نوێی STEM لە کورد جینیۆس دا دەکرێتەوە',
                    'ar' => 'افتتاح مختبر STEM الجديد في كرد جينيوس',
                ],
                'content' => [
                    'en' => 'Our new STEM laboratory is equipped with the latest technology and equipment to inspire the next generation of scientists and innovators. The facility includes advanced robotics, 3D printing, and programming stations.',
                    'ckb' => 'تاقیگە نوێیەکەمان بۆ STEM چەکدار کراوە بە دوایین تەکنەلۆژیا و ئامێر بۆ ئیلهام بەخشین بە نەوەی داهاتووی زانایان و داهێنەران. ئامێرەکە ڕۆبۆتی پێشکەوتوو، چاپکردنی سێ ڕەهەندی و وێستگەکانی بەرنامەسازی لەخۆدەگرێت.',
                    'ar' => 'مختبرنا الجديد لـ STEM مجهز بأحدث التقنيات والمعدات لإلهام الجيل القادم من العلماء والمبتكرين. يتضمن المرفق الروبوتات المتقدمة والطباعة ثلاثية الأبعاد ومحطات البرمجة.',
                ],
                'category' => 'facilities',
                'hashtags' => ['stem', 'innovation', 'education'],
                'order' => 2,
            ],
            [
                'title' => [
                    'en' => 'Cultural Festival Celebrates Diversity at Kurd Genius',
                    'ckb' => 'فێستیڤاڵی کولتووری جۆراوجۆری لە کورد جینیۆس دا ئاهەنگ دەگرێت',
                    'ar' => 'المهرجان الثقافي يحتفل بالتنوع في كرد جينيوس',
                ],
                'content' => [
                    'en' => 'The Kurd Genius Cultural Festival showcased the rich diversity of our student community through performances, art exhibitions, and traditional food. Students, parents, and staff came together to celebrate the various cultures represented at our school.',
                    'ckb' => 'فێستیڤاڵی کولتووری کورد جینیۆس جۆراوجۆری دەوڵەمەندی کۆمەڵگای قوتابیانمانی نیشان دا لە ڕێگەی نمایش، پێشانگای هونەری و خواردنی نەریتی. قوتابیان، دایک و باوک و ستاف پێکەوە کۆبوونەوە بۆ ئاهەنگ گرتنی کولتوورە جیاوازەکانی نوێنەراوە لە قوتابخانەکەمان.',
                    'ar' => 'عرض مهرجان كرد جينيوس الثقافي التنوع الغني لمجتمع طلابنا من خلال العروض والمعارض الفنية والطعام التقليدي. اجتمع الطلاب وأولياء الأمور والموظفون للاحتفال بالثقافات المختلفة الممثلة في مدرستنا.',
                ],
                'category' => 'events',
                'hashtags' => ['culture', 'diversity', 'community'],
                'order' => 3,
            ],
        ];

        foreach ($news as $item) {
            $category = $item['category'];
            $hashtags = $item['hashtags'];
            unset($item['category'], $item['hashtags']);

            // Get category ID
            $categoryId = isset($categoryModels[$category]) ? $categoryModels[$category]->id : null;

            $newsArticle = News::updateOrCreate(
                array_merge($item, [
                    'user_id' => $user->id, 
                    'branch_id' => $defaultBranch->id,
                    'category_id' => $categoryId
                ])
            );

            // Attach hashtags (many-to-many)
            $hashtagIds = [];
            foreach ($hashtags as $hashtagSlug) {
                if (isset($hashtagModels[$hashtagSlug])) {
                    $hashtagIds[] = $hashtagModels[$hashtagSlug]->id;
                    $hashtagModels[$hashtagSlug]->incrementUsage();
                }
            }
            $newsArticle->hashtags()->sync($hashtagIds);
        }

        $this->command->info('News articles seeded.');
    }

    private function seedGallery($user)
    {
        $defaultBranch = \App\Models\Pages\Branch::first();

        if (! $defaultBranch) {
            $this->command->warn('No branch found. Skipping gallery seeding.');
            return;
        }

        // Prefer an existing category if available
        $category = \App\Models\Pages\Category::first();

        $galleries = [
            [
                'title' => ['en' => 'Campus Tour', 'ckb' => 'گەشتی کامپەس', 'ar' => 'جولة في الحرم'],
                'description' => ['en' => 'Photos from our main campus and facilities.', 'ckb' => 'وێنەkan لە کامپەس و ئامێرەکان.', 'ar' => 'صور من الحرم والمرافق.'],
                'category_id' => $category?->id,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'STEM Lab Highlights', 'ckb' => 'هەڵسەنگاندنەکانی تاقیگەی STEM', 'ar' => 'معالم مختبر STEM'],
                'description' => ['en' => 'Snapshots of our STEM activities and student projects.', 'ckb' => 'وێنەکانی چالاکی STEM و پرۆژەی خوێندکاران.', 'ar' => 'لقطات من أنشطة STEM ومشاريع الطلاب.'],
                'category_id' => $category?->id,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Cultural Events', 'ckb' => 'ڕووداوە کەلتوورییەکان', 'ar' => 'الفعاليات الثقافية'],
                'description' => ['en' => 'Gallery from our cultural festival and student performances.', 'ckb' => 'گالەریی فێستیڤاڵە کەلتوورییەکان و پێشکەشکردنی خوێندکاران.', 'ar' => 'معرض من مهرجاننا الثقافي وعروض الطلاب.'],
                'category_id' => $category?->id,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $g) {
            Gallery::create(array_merge($g, [
                'user_id' => $user->id,
                'branch_id' => $defaultBranch->id,
            ]));
        }

        $this->command->info('Gallery items seeded.');
    }
}
