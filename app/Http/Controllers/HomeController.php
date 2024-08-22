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
                ['label' => 'Springloaded', 'description' => 'The custom software studio I co-founded with Jeff Sagal.', 'icon' => 'springloaded-icon', 'url' => 'https://springloaded.co'],
                ['label' => 'YouTube', 'description' => 'Video versions of my articles are posted on my YouTube channel.', 'icon' => 'youtube-icon', 'url' => 'https://youtube.com/owenconti'],
                ['label' => 'GitHub', 'description' => 'Open source contributions and project ideas are hosted on GitHub.', 'icon' => 'github-icon', 'url' => 'https://github.com/owenconti'],
                ['label' => 'Chat with me on X', 'description' => 'My short form and conversational content is posted on X.', 'icon' => 'twitter-icon', 'url' => 'https://x.com/owenconti'],
                ['label' => 'Twitch', 'description' => 'From time to time I stream side project work on Twitch.', 'icon' => 'twitch-icon', 'url' => 'https://twitch.tv/owenconti'],
                ['label' => 'LinkedIn', 'description' => 'Connect with me to chat anything business on LinkedIn.', 'icon' => 'linkedin-icon', 'url' => 'https://www.linkedin.com/in/owen-conti-2bb75b184'],
            ],
        ]);
    }
}
