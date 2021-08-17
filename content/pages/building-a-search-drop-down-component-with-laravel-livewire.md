---
slug: posts/building-a-search-drop-down-component-with-laravel-livewire
title: 'Building a Search Drop Down Component with Laravel Livewire'
type: post
category_slug: laravel
excerpt: 'Follow along as we build a drop down component with Caleb Porzio''s Laravel Livewire.'
video: ndEyRBQUFU4
updated_at: 1590683382
created_at: 1590683382
---

[Laravel Livewire](https://livewire-framework.com/) allows you to build interactive web applications without any custom JavaScript. It's built around the [Laravel](https://laravel.com/) framework.

Watch the video below for a step-by-step guide on how you can use Laravel Livewire to build an interactive search drop down component, without any custom JavaScript.

PHP component file:

```php
<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;

class ContactSearchBar extends Component
{
    public $query;
    public $contacts;
    public $highlightIndex;

    public function mount()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->query = '';
        $this->contacts = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->contacts) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->contacts) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectContact()
    {
        $contact = $this->contacts[$this->highlightIndex] ?? null;
        if ($contact) {
            $this->redirect(route('show-contact', $contact['id']));
        }
    }

    public function updatedQuery()
    {
        $this->contacts = Contact::where('name', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.contact-search-bar');
    }
}
```

Blade view:

```php
<div class="relative">
    <input
        type="text"
        class="form-input"
        placeholder="Search Contacts..."
        wire:model="query"
        wire:keydown.escape="reset"
        wire:keydown.tab="reset"
        wire:keydown.ArrowUp="decrementHighlight"
        wire:keydown.ArrowDown="incrementHighlight"
        wire:keydown.enter="selectContact"
    />

    <div wire:loading class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
        <div class="list-item">Searching...</div>
    </div>

    @if(!empty($query))
        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="reset"></div>

        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
            @if(!empty($contacts))
                @foreach($contacts as $i => $contact)
                    <a
                        href="{{ route('show-contact', $contact['id']) }}"
                        class="list-item {{ $highlightIndex === $i ? 'highlight' : '' }}"
                    >{{ $contact['name'] }}</a>
                @endforeach
            @else
                <div class="list-item">No results!</div>
            @endif
        </div>
    @endif
</div>
```