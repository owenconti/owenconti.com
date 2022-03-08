<div>
    <x-search />
    @if (isset($page) && $page->isPost())
        <x-related-articles :page="$page" class="text-sm" />
    @endif
    <x-category-cloud />
    <x-sidebar-links />
</div>
