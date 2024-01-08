<div class="divide-y-4 dark:divide-zinc-800 divide-zinc-200 space-y-6">
    <x-search />
    @if (isset($page) && $page->isPost())
        <x-related-articles :page="$page" class="text-sm" />
    @endif
    <x-sidebar-links />
    <x-category-cloud />
</div>
