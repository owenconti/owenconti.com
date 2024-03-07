<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class ArticleMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:article {slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffolds out a new article.';

    protected $type = 'Article';

    protected function getStub(): string
    {
        return base_path('stubs/article.stub');
    }

    public function handle(): void
    {
        $slug = trim($this->argument('slug'));
        $path = base_path("content/pages/{$slug}.md");

        if ($this->files->exists($path)) {
            $this->error("{$slug} already exists!");

            return;
        }

        $stub = $this->files->get($this->getStub());
        $stub = Str::of($stub)
            ->replace("\nslug:", "\nslug: posts/{$slug}")
            ->replace('title:', "title: '".Str::of($slug)->title()->replace('-', ' ')."'")
            ->replace('updated_at:', 'updated_at: '.now()->format('Y-m-d'))
            ->replace('created_at:', 'created_at: '.now()->format('Y-m-d'));

        $this->files->put($path, $stub);
    }
}
