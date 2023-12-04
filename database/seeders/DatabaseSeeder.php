<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\News;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\ArticleCategories;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {        
       // User::factory(5)->create();

        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('12345'),
            'role_id'=>1
        ]);
        User::create([
            'name'=>'zeld',
            'email'=>'zeld@gmail.com',
            'password'=>Hash::make('12345'),
            'role_id'=>2
        ]);
        User::create([
            'name'=>'samuel',
            'email'=>'samuel@gmail.com',
            'password'=>Hash::make('12345'),
            'role_id'=>2
        ]);
        User::create([
            'name'=>'user',
            'email'=>'user@gmail.com',
            'password'=>Hash::make('12345'),
            'role_id'=>3
        ]);
        User::create([
            'name'=>'alvin',
            'email'=>'alvin@gmail.com',
            'password'=>Hash::make('12345'),
            'role_id'=>3
        ]);

        Category::create([
            'category_name'=>'Game',
            'category_image'=>'https://i.pinimg.com/originals/5e/22/86/5e2286e02a8d3a65558ad3adf7534670.jpg'
        ]);
        Category::create([
            'category_name'=>'Politik&Hukum',
            'category_image'=>'https://i.pinimg.com/550x/97/67/26/976726d80891c77db6afa43a59ab84d0.jpg'
        ]);
        Category::create([
            'category_name'=>'Sport',
            'category_image'=>'https://img.freepik.com/premium-vector/football-soccer-logo_609550-353.jpg'
        ]);
        Category::create([
            'category_name'=>'Finance',
            'category_image'=>'https://static.vecteezy.com/system/resources/thumbnails/007/264/787/small/business-finance-logo-template-illustration-free-vector.jpg'
        ]);
        Category::create([
            'category_name'=>'Anime',
            'category_image'=>'https://logo.com/image-cdn/images/kts928pd/production/259e53d9e7c42a6a4987470a1ffa3d55639da403-731x731.png?w=1080&q=72'
        ]);
        Category::create([
            'category_name'=>'Teknologi',
            'category_image'=>'https://desainkaosmurah.com/files/image/img_user/user_1/20190123133457_2_TECHNOLOGY2.jpg'
        ]);

        Article::create([
            'title'=>'Honkai Star Rail Game RPG Dari Mihoyo',
            'slug'=>'honkai-star-rail-game-rpg-dari-mihoyo',
            'image_url'=>'https://cdn1.epicgames.com/offer/a2dcbb9e34204bda9da8415f97b3f4ea/EPIC_EN_2560x1440_2560x1440-3d3fbf5a5c6a6093bb66d5c7042ac634',
            'content'=>'Honkai: Star Rail (Hanzi: 崩坏: 星穹铁道; Pinyin: Bēnghuài: Xīngqióng Tiědào;Honkai Star Rail adalah permainan video bermain peran yang dikembangkan oleh miHoYo. Permainan ini diterbitkan oleh miHoYo di Tiongkok dan HoYoverse di seluruh dunia. Permainan ini dirilis pada 26 April 2023 untuk Windows dan perangkat seluler; perilisan untuk PlayStation 5 diumumkan pada Summer Game Fest 2023 dan direncanakan akan dirilis pada kuartal keempat 2023, sementara perilisan untuk PlayStation 4 belum diumumkan. Honkai: Star Rail merupakan permainan keempat dalam seri Honkai yang menggunakan karakter dari Honkai Impact 3rd dan elemen alur permainan dari Genshin Impact.',
            'user_id'=>3,
            'views'=>20
        ]);
        Article::create([
            'title'=>'Wanita di Medan Tewas Usai Ditemukan Kritis di Kos,Polisi:Dibunuh-Disetubuhi',
            'slug'=>'wanita-di-medan-tewas-usai-ditemukan-kritis-di-kos-polisi-dibunuh-disetubuhi',
            'image_url'=>'https://akcdn.detik.net.id/community/media/visual/2017/05/29/921f7b7d-aa85-4d1f-a222-ddc572613f54_169.jpg?w=700&q=90',
            'content'=>"Medan - Polisi telah mendapatkan laporan autopsi wanita berinisial ET (32) yang tewas usai ditemukan kritis di dalam kamar kosnya di Jalan Pelajar, Kota Medan. Hasilnya, ET dibunuh dan sebelumnya sempat disetubuhi.

            'Untuk hasil autopsi sejauh ini didapati ET merupakan korban pembunuhan,' kata PS Kasat Reskrim Polrestabes Medan Kompol Teuku Fathir Mustafa kepada detikSumut, Senin (4/12/2023).

            'Sebelum dibunuh, korban disetubuhi. Untuk lebih lanjut nanti akan disampaikan,'tambahnya.
           ",
           "user_id"=>2,
           'views'=>25
        ]);

        Article::create([
            'title' => 'Pria Ditemukan Tewas di Jakarta Timur, Polisi: Diduga Akibat Perkelahian',
            'slug' => 'pria-ditemukan-tewas-di-jakarta-timur-polisi-diduga-akibat-perkelahian',
            'image_url' => 'https://img.okezone.com/content/2016/07/13/338/1436903/polisi-temukan-pisau-untuk-membunuh-alika-di-hotel-elysta-9vnhojNzZF.jpg',
            'content' => "Jakarta - Polisi tengah menyelidiki kematian seorang pria yang ditemukan tewas di kawasan Jakarta Timur. Menurut informasi awal, dugaan sementara mengarah pada akibat perkelahian.
        
            'Kami sedang memeriksa keterangan saksi dan mengumpulkan bukti terkait insiden ini,' ujar Kapolres Jakarta Timur, Komisaris Agus Santoso.
        
            'Belum dapat dipastikan motifnya, namun kami bekerja keras untuk mengungkap kejadian ini dengan cepat,' tambahnya.",
            'user_id'=>3,
            'views'=>50
        ]);
        
        // Data 2
        Article::create([
            'title' => 'Gempa Magnitudo 5.0 Guncang Bali, Warga Panik Berhamburan ke Luar Rumah',
            'slug' => 'gempa-magnitudo-5-0-guncang-bali-warga-panik-berhamburan-ke-luar-rumah',
            'image_url' => 'https://media-assets-ggwp.s3.ap-southeast-1.amazonaws.com/2017/04/cv-earthshaker-1-696x385.jpg',
            'content' => "Bali - Guncangan gempa dengan magnitudo 5.0 mengguncang pulau Bali, menimbulkan kepanikan di kalangan warga. Beberapa wilayah melaporkan kerusakan ringan pada beberapa bangunan.
        
            'Gempa terjadi sekitar pukul 08.30 pagi hari ini. Warga langsung berhamburan ke luar rumah karena merasa getaran yang cukup kuat,' kata Kepala Badan Meteorologi dan Geofisika (BMKG) Bali, I Gusti Ngurah Putra.
        
            'Kami terus memonitor situasi dan memberikan informasi terkini kepada masyarakat,' tambahnya.",
            'user_id'=>2
        ]);
        Article::create([
            'title' => 'DOTA 2',
            'slug' => 'dota-2',
            'image_url' => 'https://www.hindustantimes.com/ht-img/img/2023/04/16/550x309/capsule_616x353_1681616184355_1681616191147_1681616191147.jpg',
            'content' => "Dota 2 is a 2013 multiplayer online battle arena (MOBA) video game by Valve. The game is a sequel to Defense of the Ancients (DotA), a community-created mod for Blizzard Entertainment's Warcraft III: Reign of Chaos. Dota 2 is played in matches between two teams of five players, with each team occupying and defending their own separate base on the map. Each of the ten players independently controls a powerful character known as a 'hero' that all have unique abilities and differing styles of play. During a match players collect experience points and items for their heroes to defeat the opposing team's heroes in player versus player combat. A team wins by being the first to destroy the other team's 'ancient', a large structure located within their base.",
            'user_id'=>3
        ]);
        Article::create([
            'title' => 'Mengenal Laravel',
            'slug' => 'mengenal-laravel',
            'image_url' => 'https://www.biznetgio.com/assets/main/images/news/Banner_Article_Mengenal_Laravel,_Framework_PHP_untuk_membuat_Aplikasi-1661927838.jpg',
            'content' => "Salah satu bahasa pemrograman yang populer untuk digunakan dalam web development adalah PHP. Hal ini juga bukan tanpa alasan, PHP merupakan bahasa pemrograman yang digunakan untuk membuat platform CMS paling populer di dunia yaitu WordPress. PHP sendiri bahasa pemrograman back-end atau digunakan untuk pengembangan pada sisi server (server-side).

            Dalam pengembangan aplikasi web, terdapat beberapa tools pembantu yang bisa digunakan untuk mempersingkat waktu pengembangan aplikasi web. Kumpulan tools ini disebut framework, framework biasanya berisi beberapa template kode serta penyederhanaan proses pengembangan aplikasi dari yang seharusnya membangun kode pemrograman dari scratch menjadi lebih sederhana dengan menggunakan fitur pada framework.
            
            Salah satu framework PHP yang sangat populer adalah Laravel. Melalui artikel ini kamu akan mengetahui apa itu framework, apa itu Laravel, fungsi, serta kelebihan dari Laravel.",
            'user_id'=>3
        ]);
        Article::create([
            'title' => 'Mengenal Node JS',
            'slug' => 'mengenal-node-js',
            'image_url' => 'https://www.biznetgio.com/assets/main/images/news/2022---Agustus---Mengenal-Node-js-01.jpeg',
            'content' => "Node.js merupakan platform yang diciptakan secara khusus untuk membantu pengembangan aplikasi berbasis web. Walau demikian, Node.js bukan bahasa pemrograman yang baru, tetapi runtime envinronment atau interpreter untuk menjalankan bahasa pemrograman JavaScript sebagai kebutuhan back-end developing.

            Sebagai informasi, interpreter adalah perangkat lunak yang memiliki fungsi untuk melakukan proses eksekusi instruksi yang sudah ditulis dalam bahasa pemrograman. Sedangkan, JavaScript merupakan bahasa pemrograman yang digunakan bersamaan dengan HTML dan CSS untuk menghasilkan halaman web yang interaktif.
            
            Dengan Node.js, kamu dapat menjalankan kode JavaScript di mana saja dan tidak terbatas pada lingkungan browser.
            
            Adapun Node.js dibangun dengan engine JavaScript V8 milik Google sehingga Node.js memiliki performa yang tinggi. Node.js juga memiliki library sendiri. Dengan begitu, pengguna tak perlu menggunakan webserver NGINX maupun Apache.
            ",
            'user_id'=>2
        ]);
        Article::create([
            'title' => 'The International 2023',
            'slug' => 'the-international-2023',
            'image_url' => 'https://liquipedia.net/commons/images/thumb/c/c3/The_International_2023_lightmode.png/900px-The_International_2023_lightmode.png',
            'content' => "The International Dota 2 Championships 2023 (also commonly called TI 2023 or TI 12) is the concluding tournament of the current season of Dota Pro Circuit and the twelfth annual edition of The International which will take place at Seattle, Washington. The invite format is similar to the one used for the preceding International, whereby a point system based on official sponsored Regional Leagues and Majors will be used to determine the teams invited to The International.

            Unlike previous years, The International for this year is split into two distinct phases: The group stage and playoffs (until top 8) are branded as The Road to The International, while the playoffs for the remaining 8 teams are branded as The International itself.
            
            Team Spirit defeated Gaimin Gladiators in the Grand Finals 3-0.",
            'user_id'=>3
        ]);
        Article::create([
            'title' => 'LOL The World 2023',
            'slug' => 'lol-the-world-2023',
            'image_url' => 'https://liquipedia.net/commons/images/thumb/8/87/LoL_World_Championship_2023_lightmode.png/900px-LoL_World_Championship_2023_lightmode.png',
            'content' => "The League of Legends World Championship 2023 (also known as LoL Worlds 2023 or just Worlds 2023) is the crowning event of League of Legends esports for the year. The tournament includes 22 teams from all regions of the game in a months-long race for the Summoner's Cup.

            For this Worlds tournament Riot introduced a Swiss Format which will be replacing the Group Stage of previous years, and a new qualifying series to determine the last spot between 4th Seed of Europe and North America.",
            'user_id'=>2
        ]);
        Article::create([
            'title' => '7 Tips Mengatur Keuangan',
            'slug' => '7-tips-mengatur-keuangan',
            'image_url' => 'https://mediakeuangan.kemenkeu.go.id/_/media/static/files/Article/finansial/2023/FotoHeroFinansialMar23.jpg?w=1200&fit=crop&fm=webp&s=1d210975e29de5a67b8c8f98c2b2ad2b',
            'content' => "Mengatur keuangan memang bukan hal yang mudah. Walaupun sudah menerima gaji atau penerimaan, namun terkadang untuk membuat uang yang kita miliki terus bertambah masih menjadi hal yang sulit dilakukan. Terlebih jika kita memperoleh pendapatan yang sama tapi pengeluaran malah semakin besar setiap bulannya.

            Kebiasaan yang kurang baik dari kita adalah cenderung menghamburkan uang di awal dan berhemat di tanggal-tanggal akhir. Jika terus menerus seperti itu, mungkin tidak akan ada kesempatan untuk kita bisa menabung. Untuk menghindari hal-hal tersebut, kita membutuhkan perencanaan dalam mengelola keuangan. Berikut tips  mengatur keuangan agar tabungan terus bertambah.",
            'user_id'=>2
        ]);

        ArticleCategories::create([
            'article_id'=>1,
            'category_id'=>1,
        ]);
        ArticleCategories::create([
            'article_id'=>1,
            'category_id'=>5,
        ]);
        ArticleCategories::create([
            'article_id'=>2,
            'category_id'=>2,
        ]);
        ArticleCategories::create([
            'article_id'=>2,
            'category_id'=>3,
        ]);
        ArticleCategories::create([
            'article_id'=>3,
            'category_id'=>3,
        ]);
        ArticleCategories::create([
            'article_id'=>4,
            'category_id'=>3,
        ]);
        ArticleCategories::create([
            'article_id'=>5,
            'category_id'=>1,
        ]);
        ArticleCategories::create([
            'article_id'=>6,
            'category_id'=>6,
        ]);
        ArticleCategories::create([
            'article_id'=>7,
            'category_id'=>6,
        ]);
        ArticleCategories::create([
            'article_id'=>8,
            'category_id'=>1,
        ]);
        ArticleCategories::create([
            'article_id'=>8,
            'category_id'=>3,
        ]);
        ArticleCategories::create([
            'article_id'=>9,
            'category_id'=>1,
        ]);
        ArticleCategories::create([
            'article_id'=>9,
            'category_id'=>3,
        ]);
        ArticleCategories::create([
            'article_id'=>10,
            'category_id'=>3,
        ]);

        Comment::factory(10)->create();
    }
}
