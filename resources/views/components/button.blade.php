<button
  class="py-2 px-4 rounded focus:outline-none {{ isset($block) ? 'w-full' : '' }} shadow {{ variants()->button($variant ?? 'primary')->class() }}"
  @click="{{ $onClick ?? '' }}"
>
  {{ $title }}
</button>