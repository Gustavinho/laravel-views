{{-- components.link

Renders a simple link
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,

props
 - to
 - title

--}}
<a href="{{ $to }}" class="hover:text-blue-500 hover:underline">
  {{ $title }}
</a>