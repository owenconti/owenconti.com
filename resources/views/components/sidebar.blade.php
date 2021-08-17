<div>
    <x-search />
    @if (isset($page) && $page->isPost())
        <x-related-articles :page="$page" />
    @endif
    <x-category-cloud />
    <x-sidebar-links />
</div>