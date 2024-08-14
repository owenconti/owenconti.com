<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            'articles' => Page::where('type', 'post')->limit(5)->latest()->get(),
            'cards' => [
                ['label' => 'Springloaded', 'description' => 'Springloaded is the software development studio I co-founded with Jeff Sagal in April 2022.', 'icon' => 'springloaded-icon', 'url' => 'https://springloaded.co'],
                ['label' => 'YouTube', 'description' => 'I post video versions of my articles on my YouTube channel.', 'icon' => 'youtube-icon', 'url' => 'https://youtube.com/owenconti'],
                ['label' => 'GitHub', 'description' => 'I keep all of my development work and open source code on GitHub.', 'icon' => 'github-icon', 'url' => 'https://github.com/owenconti'],
                ['label' => 'Chat with me on X', 'description' => 'My short form and conversational content is posted on X.', 'icon' => 'twitter-icon', 'url' => 'https://x.com/owenconti'],
                ['label' => 'Twitch', 'description' => 'I sometimes stream my side project and open source work on Twitch.', 'icon' => 'twitch-icon', 'url' => 'https://twitch.tv/owenconti'],
                ['label' => 'LinkedIn', 'description' => 'Connect with me on LinkedIn! Happy to chat anything business related over there.', 'icon' => 'linkedin-icon', 'url' => 'https://www.linkedin.com/in/owen-conti-2bb75b184'],
            ],
        ]);
    }
}
