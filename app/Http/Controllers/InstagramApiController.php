<?php

namespace App\Http\Controllers;

use App\Bot;
use App\Jobs\SyncBots;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class InstagramApiController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['verified', 'optimizeImages'])->except(['index']);
    }

    public function index(Request $request, $username)
    {
        $username = str_replace("@", "", $username);
        $api = new \Instagram\Api();
        $api->setUserName($username);
        $obj = $api->getFeed();
        $data = $obj;
        // $data = [
        //     'id' => '5708341881',
        //     'userName' => 'villefranchesurmer',
        //     'fullName' => 'Villefranche Sur Mer',
        //     'biography' => '🏖🤸‍♀️🌴The best of Villefranche Sur Mer - #cotedazur #riviera #beach #sun #mediterranean #sea',
        //     'followers' => 2008,
        //     'following' => 461,
        //     'profilePicture' => 'https://scontent-frt3-1.cdninstagram.com/vp/c18dd447fad7d696599f961e27030cd4/5DFB93F6/t51.2885-19/s320x320/49793922_1206106822876323_1428161275430436864_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //     'externalUrl' => 'https://ExploreVillefranche.com/',
        //     'private' => false,
        //     'verified' => false,
        //     'mediaCount' => 90,
        //     'medias' => [
        //         0 => array(
        //             'id' => '2082831038528326046',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/bba85412ce6bd17f49ac932d46ec8de3/5DF9EED7/t51.2885-15/sh0.08/e35/s640x640/65265645_148974996283756_2962646931574334258_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/Bzns8tSo4me/',
        //             'date' => array(
        //                 'date' => '2019-07-07 15:20:30.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/7582099635a841864d996de7f099c56c/5E01BF32/t51.2885-15/e35/65265645_148974996283756_2962646931574334258_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => '#villefranche #villefranchesurmer #southoffrance #night #beach #sea #bay #boats #yacht',
        //             'comments' => 5,
        //             'likes' => 245,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/e7de94e836166b975087e9e21955ae1f/5DF6E470/t51.2885-15/e35/s150x150/65265645_148974996283756_2962646931574334258_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/e3ac03d411ddc0967866ce95c66ac3f1/5E067F3A/t51.2885-15/e35/s240x240/65265645_148974996283756_2962646931574334258_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/917d4f75d20d090addc78670941924a4/5DFA6F80/t51.2885-15/e35/s320x320/65265645_148974996283756_2962646931574334258_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/1580cf71db979577a3379c17cd9a904f/5DFA5DDA/t51.2885-15/e35/s480x480/65265645_148974996283756_2962646931574334258_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/bba85412ce6bd17f49ac932d46ec8de3/5DF9EED7/t51.2885-15/sh0.08/e35/s640x640/65265645_148974996283756_2962646931574334258_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '1576109692440018',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche Sur Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //         1 => array(
        //             'id' => '2069006107399155244',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/637137a65074b7decd094d3811634971/5DFF442C/t51.2885-15/sh0.08/e35/s640x640/64881645_193891438216617_5009777188380580583_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/By2lhe1o-4s/',
        //             'date' => array(
        //                 'date' => '2019-06-18 13:32:49.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/d5d54caf0074cef2fb12fc66fc38d4d6/5DF9099B/t51.2885-15/e35/s1080x1080/64881645_193891438216617_5009777188380580583_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => '😍 #sea #Villefranche #bay #swim #beach',
        //             'comments' => 2,
        //             'likes' => 227,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/3ec0c5004787debae71cd72a25e4823c/5E0D3E8B/t51.2885-15/e35/s150x150/64881645_193891438216617_5009777188380580583_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/f6db7d8e74c7d69225a364743354099b/5DF07FC1/t51.2885-15/e35/s240x240/64881645_193891438216617_5009777188380580583_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/fe3f2fdff9daa78d92511e923ae8f97e/5E0AA47B/t51.2885-15/e35/s320x320/64881645_193891438216617_5009777188380580583_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/8f1a8638f002119fe97bfc8b8d43200c/5DFAF421/t51.2885-15/e35/s480x480/64881645_193891438216617_5009777188380580583_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/637137a65074b7decd094d3811634971/5DFF442C/t51.2885-15/sh0.08/e35/s640x640/64881645_193891438216617_5009777188380580583_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '1576109692440018',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche Sur Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //         2 => array(
        //             'id' => '1994367848872932945',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/8d3049d3b0e85c26978280c9efa2d019/5E114F57/t51.2885-15/sh0.08/e35/s640x640/52100195_169161787404802_7779899721308915733_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/Butav3vh_ZR/',
        //             'date' => array(
        //                 'date' => '2019-03-07 13:59:56.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/1e4b74193c8e36c54d876b1bef815953/5DF3C6B2/t51.2885-15/e35/52100195_169161787404802_7779899721308915733_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => 'Oh my do we #love this city #cotedazur #explorevillefranche #southoffrance #villefranchesurmer #france',
        //             'comments' => 9,
        //             'likes' => 309,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/8657fcc1e966cab14551b647dbb504be/5DFB15F0/t51.2885-15/e35/s150x150/52100195_169161787404802_7779899721308915733_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/b05f88443c4e3401450a7327cdd4fb41/5DF5C5BA/t51.2885-15/e35/s240x240/52100195_169161787404802_7779899721308915733_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/6f40b4e491750d61c9953ab98427b5de/5DF6E000/t51.2885-15/e35/s320x320/52100195_169161787404802_7779899721308915733_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/0c910755d25b2fff07c3c41fb2bffc36/5DF1FD5A/t51.2885-15/e35/s480x480/52100195_169161787404802_7779899721308915733_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/8d3049d3b0e85c26978280c9efa2d019/5E114F57/t51.2885-15/sh0.08/e35/s640x640/52100195_169161787404802_7779899721308915733_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '228453086',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche-sur-Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //         3 => array(
        //             'id' => '1988003607504620185',
        //             'typeName' => 'GraphVideo',
        //             'height' => 750,
        //             'width' => 750,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/d1227552d89497d3eab20c20ebbb7a9e/5D75C285/t51.2885-15/e15/s640x640/51356821_408308153306424_302912010338951014_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/BuWzr-FggqZ/',
        //             'date' => array(
        //                 'date' => '2019-02-26 19:17:30.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/a9b9bd72cb21d542eaa3774005a267d1/5D760393/t51.2885-15/e15/51356821_408308153306424_302912010338951014_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => 'Firefighting planes refill in the #bay of #Villefranche #sea!',
        //             'comments' => 5,
        //             'likes' => 276,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/dd2021cbaa8138065d6c967672f75477/5D75F0E5/t51.2885-15/e15/s150x150/51356821_408308153306424_302912010338951014_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/159bfc645c1625e999a7f52c5f01d97e/5D760E50/t51.2885-15/e15/s240x240/51356821_408308153306424_302912010338951014_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/e9069120c33907a4015f197ac22168d9/5D75A0A8/t51.2885-15/e15/s320x320/51356821_408308153306424_302912010338951014_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/21964863705355b2fb645e29398ff2f0/5D763DB4/t51.2885-15/e15/s480x480/51356821_408308153306424_302912010338951014_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/d1227552d89497d3eab20c20ebbb7a9e/5D75C285/t51.2885-15/e15/s640x640/51356821_408308153306424_302912010338951014_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '228453086',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche-sur-Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => true,
        //             'videoViewCount' => 964,
        //         ),
        //         4 => array(
        //             'id' => '1976305362208481201',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/49d34b74e1dd3688193e8f1de167f1b2/5DF6C7C6/t51.2885-15/sh0.08/e35/s640x640/50170719_620727391682110_3564246435837459633_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/BttP0GKIt-x/',
        //             'date' => array(
        //                 'date' => '2019-02-10 15:52:59.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/b2c88050149d67d89fa79739c542bf13/5DFC9123/t51.2885-15/e35/50170719_620727391682110_3564246435837459633_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => '#valentines in #villefranchesurmer in just a couple of days! #southoffrance #france #beach #sun',
        //             'comments' => 1,
        //             'likes' => 188,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/8a526c1f908fb221283523a5e4243b62/5E105061/t51.2885-15/e35/s150x150/50170719_620727391682110_3564246435837459633_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/cc5e5ddd940e64deb52861223fce78f2/5E117B2B/t51.2885-15/e35/s240x240/50170719_620727391682110_3564246435837459633_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/16e5ffbb86fda99176870cecf57608ca/5E0A1091/t51.2885-15/e35/s320x320/50170719_620727391682110_3564246435837459633_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/5bb90ae6354acf5d42fb01887a5fa83c/5DFE04CB/t51.2885-15/e35/s480x480/50170719_620727391682110_3564246435837459633_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/49d34b74e1dd3688193e8f1de167f1b2/5DF6C7C6/t51.2885-15/sh0.08/e35/s640x640/50170719_620727391682110_3564246435837459633_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '228453086',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche-sur-Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //         5 => array(
        //             'id' => '1974197985122697241',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/ea4a3196ba7bc6e57fe8ff8e3f47160d/5DF8325E/t51.2885-15/sh0.08/e35/s640x640/51694847_144013933277188_4455921673373146611_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/BtlwpuTh8AZ/',
        //             'date' => array(
        //                 'date' => '2019-02-07 18:06:00.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/749fa57f0835c895d9ef9819e790338c/5E03E3BB/t51.2885-15/e35/51694847_144013933277188_4455921673373146611_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => 'Did you see the #qr codes in #villefranchesurmer? Scan them with your phone to learn more about whatever you’re looking at in #villefranche! #explorevillefranche #southoffrance #cotedazur #france',
        //             'comments' => 1,
        //             'likes' => 49,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/21574fa4aed818245e1da52fa2b62f8e/5E0DE5F9/t51.2885-15/e35/s150x150/51694847_144013933277188_4455921673373146611_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/3a1c5afcffe54760eb05602b4003b5be/5DEF9FB3/t51.2885-15/e35/s240x240/51694847_144013933277188_4455921673373146611_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/0a558acf48f075192ab657cdb496203f/5E0BAB09/t51.2885-15/e35/s320x320/51694847_144013933277188_4455921673373146611_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/a88f2b5b52b8c062f0cf07737e92b92a/5E096353/t51.2885-15/e35/s480x480/51694847_144013933277188_4455921673373146611_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/ea4a3196ba7bc6e57fe8ff8e3f47160d/5DF8325E/t51.2885-15/sh0.08/e35/s640x640/51694847_144013933277188_4455921673373146611_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '228453086',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche-sur-Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //         6 => array(
        //             'id' => '1974072770677840446',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/9611ee050728ed21838f2e0df7bf6a63/5E00F4C6/t51.2885-15/sh0.08/e35/s640x640/50115159_603486700074358_2585936912461884697_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/BtlULnRBho-/',
        //             'date' => array(
        //                 'date' => '2019-02-07 13:57:14.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/5314b4e04aeeccfda6f34053835d2087/5DFA2B23/t51.2885-15/e35/50115159_603486700074358_2585936912461884697_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => '#villefranchesurmer #myvillefranchesurmer #southoffrance #ilovenice #beach #sun #boats #yachts visit our blog!',
        //             'comments' => 5,
        //             'likes' => 229,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/11a8b86f10b778c889124812d3ffc094/5E0FCE61/t51.2885-15/e35/s150x150/50115159_603486700074358_2585936912461884697_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/545ba7837f3ddf704859c5ba30e9aec6/5E10982B/t51.2885-15/e35/s240x240/50115159_603486700074358_2585936912461884697_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/a7ccd97f8b3afb37107f54afb1a5c4c5/5E081491/t51.2885-15/e35/s320x320/50115159_603486700074358_2585936912461884697_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/d731061a2bfff8bd3881dcff7e603ad4/5DFDABCB/t51.2885-15/e35/s480x480/50115159_603486700074358_2585936912461884697_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/9611ee050728ed21838f2e0df7bf6a63/5E00F4C6/t51.2885-15/sh0.08/e35/s640x640/50115159_603486700074358_2585936912461884697_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '228453086',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche-sur-Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //         7 => array(
        //             'id' => '1973400638520289436',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/8cc5f4b196c362e77c1fa4060e30c7b1/5DF7F053/t51.2885-15/sh0.08/e35/s640x640/51321815_327912938067593_5552149519711892627_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/Bti7Wzah-ic/',
        //             'date' => array(
        //                 'date' => '2019-02-06 15:41:49.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/fa06940fc03ff278fa4738747bfa9f20/5E0993B6/t51.2885-15/e35/51321815_327912938067593_5552149519711892627_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => '#valentines day in #villefranchesurmer? Why not! Enjoy the bay, sunset, and discounted drinks! Check out the event on our blog and Facebook!',
        //             'comments' => 2,
        //             'likes' => 97,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/6e954ddd0289b8d3fd115677a2844d36/5E0CE5F4/t51.2885-15/e35/s150x150/51321815_327912938067593_5552149519711892627_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/ec6d3b8e3b4b58db243251b8fed9665e/5DFC6ABE/t51.2885-15/e35/s240x240/51321815_327912938067593_5552149519711892627_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/d11b983534db98bc256073c55d37616e/5E052204/t51.2885-15/e35/s320x320/51321815_327912938067593_5552149519711892627_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/280d104ac2bcf6b12e62d3c404aa042d/5E0DDC5E/t51.2885-15/e35/s480x480/51321815_327912938067593_5552149519711892627_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/8cc5f4b196c362e77c1fa4060e30c7b1/5DF7F053/t51.2885-15/sh0.08/e35/s640x640/51321815_327912938067593_5552149519711892627_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '228453086',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche-sur-Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //         8 => array(
        //             'id' => '1972664859745403137',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/8ca354832530b0806d6b94fd67bc705c/5DFBF333/t51.2885-15/sh0.08/e35/s640x640/52120321_2250945525176309_6872548510354886526_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/BtgUD0CBUEB/',
        //             'date' => array(
        //                 'date' => '2019-02-05 15:19:58.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/9027a9b27a6a16a78f87891725a89194/5E08F089/t51.2885-15/e35/52120321_2250945525176309_6872548510354886526_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => 'What’s your top tip when visiting #villefranchesurmer? Comment below!',
        //             'comments' => 6,
        //             'likes' => 140,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/c90a7db109c79403881b0b9dcbe44fa1/5E0FBAB6/t51.2885-15/e35/s150x150/52120321_2250945525176309_6872548510354886526_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/7020f9dcce84ec8004e4ab4976e65cea/5E0794B0/t51.2885-15/e35/s240x240/52120321_2250945525176309_6872548510354886526_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/d68a7922b5b09d779483257f8ad21b12/5E11BECE/t51.2885-15/e35/s320x320/52120321_2250945525176309_6872548510354886526_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/2653adc78daa78f25f8a980f98e6a91f/5DEF6489/t51.2885-15/e35/s480x480/52120321_2250945525176309_6872548510354886526_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/8ca354832530b0806d6b94fd67bc705c/5DFBF333/t51.2885-15/sh0.08/e35/s640x640/52120321_2250945525176309_6872548510354886526_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '228453086',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche-sur-Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //         9 => array(
        //             'id' => '1970902166604615721',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/556c2c5d2c4281ad18ced3a8a62bfa09/5E02C2E8/t51.2885-15/sh0.08/e35/s640x640/50767933_281030055906402_2557870969277997851_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/BtaDRQHhBAp/',
        //             'date' => array(
        //                 'date' => '2019-02-03 04:57:48.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/a0df915e227fa9062eb1382b33814b15/5E0CB00D/t51.2885-15/e35/50767933_281030055906402_2557870969277997851_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => 'Good morning #villefranchesurmer #southoffrance #cotedazur #ilovenice #myvillefranchesurmer #explore #explorevillefranche exploreVillefranche.com',
        //             'comments' => 5,
        //             'likes' => 200,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/f78db0b1c65c5ddca6edfd38f2a45aad/5E159D4F/t51.2885-15/e35/s150x150/50767933_281030055906402_2557870969277997851_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/df39544877da20d9168215235cce4b31/5E0C0505/t51.2885-15/e35/s240x240/50767933_281030055906402_2557870969277997851_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/5daeaa59a01f1cc926b3e95fbcf6f289/5E029ABF/t51.2885-15/e35/s320x320/50767933_281030055906402_2557870969277997851_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/6b3030498a8242c7071e72f65a128420/5E04CAE5/t51.2885-15/e35/s480x480/50767933_281030055906402_2557870969277997851_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/556c2c5d2c4281ad18ced3a8a62bfa09/5E02C2E8/t51.2885-15/sh0.08/e35/s640x640/50767933_281030055906402_2557870969277997851_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '228453086',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche-sur-Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //         10 => array(
        //             'id' => '1970541796643914034',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/64bb50132137411a14dbe5cae686c540/5DFE49EE/t51.2885-15/sh0.08/e35/s640x640/50119026_101414327628150_4995226354599421897_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/BtYxVLcBUEy/',
        //             'date' => array(
        //                 'date' => '2019-02-02 17:01:49.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/9306f0d1a2f48234b00d0e05b606b1cf/5DF7720B/t51.2885-15/e35/50119026_101414327628150_4995226354599421897_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => 'See #bus stops, #train stations, and #parking on the new #map of #villefranchesurmer on ExploreVillefranche.com!',
        //             'comments' => 1,
        //             'likes' => 90,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/d67da439433ab4221a04cb13994786f4/5DF7D449/t51.2885-15/e35/s150x150/50119026_101414327628150_4995226354599421897_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/720f82d6d8e2e9db7068b31265103533/5DF90803/t51.2885-15/e35/s240x240/50119026_101414327628150_4995226354599421897_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/349c95ff5ab317bee3904a659db66f04/5DFB8EB9/t51.2885-15/e35/s320x320/50119026_101414327628150_4995226354599421897_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/a3c6e7d127b7fea8db02c3e66a0beb61/5DFEF6E3/t51.2885-15/e35/s480x480/50119026_101414327628150_4995226354599421897_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/64bb50132137411a14dbe5cae686c540/5DFE49EE/t51.2885-15/sh0.08/e35/s640x640/50119026_101414327628150_4995226354599421897_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '228453086',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche-sur-Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //         11 => array(
        //             'id' => '1968995703133208509',
        //             'typeName' => 'GraphImage',
        //             'height' => 1080,
        //             'width' => 1080,
        //             'thumbnailSrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/4ba32c81a80f6a494cbdd0ba8868aab4/5E0143E7/t51.2885-15/sh0.08/e35/s640x640/50590558_1107762022718112_5153574878155905713_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'link' => 'https://www.instagram.com/p/BtTRyjphn-9/',
        //             'date' => array(
        //                 'date' => '2019-01-31 13:50:00.000000',
        //                 'timezone_type' => 3,
        //                 'timezone' => 'UTC',
        //             ),
        //             'displaySrc' => 'https://scontent-frt3-1.cdninstagram.com/vp/75c30d04de7ca21caf0c2ffca9c7bd1a/5DF02B5D/t51.2885-15/e35/50590558_1107762022718112_5153574878155905713_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //             'caption' => 'New blog post about #swimming in the #bay of #villefranche! #southoffrance',
        //             'comments' => 5,
        //             'likes' => 269,
        //             'thumbnails' => array(
        //                 0 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/52b0690c942f78ec9d40ea32579bd810/5E034062/t51.2885-15/e35/s150x150/50590558_1107762022718112_5153574878155905713_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 150,
        //                     'config_height' => 150,
        //                 ),
        //                 1 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/5f359c7c093d0eff6454998a6ceecb4f/5DF3CB64/t51.2885-15/e35/s240x240/50590558_1107762022718112_5153574878155905713_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 240,
        //                     'config_height' => 240,
        //                 ),
        //                 2 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/23a233352a04af3e968b8ed3f3b4785c/5DF7A31A/t51.2885-15/e35/s320x320/50590558_1107762022718112_5153574878155905713_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 320,
        //                     'config_height' => 320,
        //                 ),
        //                 3 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/894fe9c4b1840ee3f94774329bd1fed7/5E11995D/t51.2885-15/e35/s480x480/50590558_1107762022718112_5153574878155905713_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 480,
        //                     'config_height' => 480,
        //                 ),
        //                 4 => array(
        //                     'src' => 'https://scontent-frt3-1.cdninstagram.com/vp/4ba32c81a80f6a494cbdd0ba8868aab4/5E0143E7/t51.2885-15/sh0.08/e35/s640x640/50590558_1107762022718112_5153574878155905713_n.jpg?_nc_ht=scontent-frt3-1.cdninstagram.com',
        //                     'config_width' => 640,
        //                     'config_height' => 640,
        //                 ),
        //             ),
        //             'location' => array(
        //                 'id' => '228453086',
        //                 'has_public_page' => true,
        //                 'name' => 'Villefranche-sur-Mer',
        //                 'slug' => 'villefranche-sur-mer',
        //             ),
        //             'video' => false,
        //             'videoViewCount' => 0,
        //         ),
        //     ],
        //     'endCursor' => 'QVFCX2ZMZWVkbWYxMUllVUlobmlCTDZSUmlacWNvRFJnamJERmtFYy1jZEFEc29hU0hTUTBOOXZXdjNCbEg4TG5WYi11VGZoWkQwcC1TY01ueExVLVRydQ==',
        // ];
        $data = json_decode(json_encode($data));
        $hashtags = [];
        $locations = [];
        $users = [];
        $biography_hashtags = [];
        $biography_users = [];
        $postLikes = [];
        $postComments = [];
        $data->videos = 0;
        $data->pictures = 0;
        $followingToFollowerRatio = 0;
        $followingToFollowerRatioMinHealthThreshold = 3;
        $minFollowers = 100;
        $minMedias = 3;
        $data->avgPostLikes = 0;
        $data->avgPostComments = 0;

        /* Match hashtags in profile */
        preg_match_all('/#(\w+)/', $data->biography, $matchesForHashtagsInCaption);

        /* Add all matches to array */
        foreach ($matchesForHashtagsInCaption[1] as $match) {
            if (!in_array($match, $biography_hashtags)) {
                $biography_hashtags[] .= $match;
            }
        }

        preg_match_all('/@(\w+)/', $data->biography, $matchesForUsersInCaption);

        /* Add all matches to array */
        foreach ($matchesForUsersInCaption[1] as $match) {
            if (!in_array($match, $biography_users)) {
                $biography_users[] .= $match;
            }
        }

        foreach ($data->medias as $media) {
            //$hashtags[] .= $media['caption'];
            /* Match hashtags */
            preg_match_all('/#(\w+)/', $media->caption, $matches);

            /* Add all matches to array */
            foreach ($matches[1] as $match) {
                if (!in_array($match, $hashtags)) {
                    $hashtags[] .= $match;
                }
            }

            preg_match_all('/@(\w+)/', $media->caption, $matchesForUsers);

            /* Add all matches to array */
            foreach ($matchesForUsers[1] as $match) {
                if (!in_array($match, $users)) {
                    $users[] .= $match;
                }
            }

            $postLikes[] .= $media->likes;
            $postComments[] .= $media->comments;

            if ($media->video) {
                $data->videos++;
            } else {
                $data->pictures++;
            }
            if ($media->location) {
                $locations[$media->location->id] = ['id' => $media->location->id, 'name' => $media->location->name, 'slug' => $media->location->slug, 'has_public_page' => $media->location->has_public_page];
            }
        }
        $a = array_filter($postLikes);
        $data->avgPostLikes = $a ? array_sum($a) / count($a) : 0;
        $a = array_filter($postComments);
        $data->avgPostComments = $a ? array_sum($a) / count($a) : 0;

        #combine arrays from caption data and post data
        $users = array_unique(array_merge($users, $biography_users));
        $hashtags = array_unique(array_merge($hashtags, $biography_hashtags));

        return view('instagramAccount', compact('data', 'hashtags', 'locations', 'users'));
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Bot::class);
        return SyncBots::dispatchNow();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bot = Bot::where('id', $id)->with('user')->firstOrFail();
        $this->authorize('show', $bot);
        return view('bots.show', ['bot' => $bot]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        # PhoneLog::create(['phone_id' => $phone->id, 'type' => 'INBOUND']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $PhoneLog = PhoneLog::findOrFail($id);

        $request->validate([
            'notes' => 'nullable',
            'ended_at' => 'nullable',
        ]);

        //$PhoneLog->update($request->only('notes', 'ended_at'));
        return $PhoneLog;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function connect(Request $request, $id)
    {
        $bot = Bot::findOrFail($id);
        $this->authorize("connectToBot", $bot);
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'AccessToken' => 'key',
                'Authorization' => 'Bearer token',
                'developerkey' => config('blog.remoteit.developerkey'),
            ];
            $client = new Client([
                'headers' => $headers,
            ]);

            $response = $client->request('POST', 'https://api.remot3.it/apv/v27/user/login', [RequestOptions::JSON => [
                "username" => config('blog.remoteit.username'),
                "password" => config('blog.remoteit.password'),
            ]]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            $obj = json_decode($body);

            ## Get devices
            $headers = [
                'Content-Type' => 'application/json',
                'token' => $obj->token,
                'Authorization' => 'Bearer token',
                'developerkey' => config('blog.remoteit.developerkey'),
            ];
            $client = new Client([
                'headers' => $headers,
            ]);

            $response = $client->request('POST', 'https://api.remot3.it/apv/v27/device/connect', [RequestOptions::JSON => [
                "deviceaddress" => $bot->address,
                "wait" => true,
            ]]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            $obj = json_decode($body);
            return "ssh -l pi " . $obj->connection->proxyserver . " -p " . $obj->connection->proxyport;
        } catch (Exception $e) {
            return $e;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
