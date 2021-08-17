<div>
    <x-search />
    @if ($page ?? null)
        <x-related-articles :page="$page" />
    @endif
    <x-category-cloud />
    <x-sidebar-links />
</div>