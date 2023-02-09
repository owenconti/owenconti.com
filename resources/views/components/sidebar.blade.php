<div>
    <x-search />
    @if (isset($page) && $page->isPost())
        <x-related-articles :page="$page" class="text-sm" />
    @endif
    <x-sidebar-links />
    <x-category-cloud />
</div>
