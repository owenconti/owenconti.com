<div class="relative flex items-center justify-center px-4 text-center text-white border-4 og-image bg-brand-dark border-accent">
	<div>
		<h1 class="px-2 py-3 text-5xl font-bold text-white bg-accent">{{ $title }}</h1>
		@if($excerpt)
			<p class="inline-block p-4 mt-8 text-lg text-white border-l-2 border-accent bg-brand-dark-lighten">&ldquo;{{ $excerpt }}&rdquo;</p>
		@endif
	</div>
	<p class="absolute bottom-0 right-0 mb-4 mr-10 text-4xl tracking-wider font-heading">owenconti.com</p>
</div>