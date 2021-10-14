@props(['filter'])

<div class="px-4 my-4 text-left" x-data="{switchValue: @entangle($filter->id)}">
  <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
    <input type="checkbox" name="toggle" id="toggle"
      class="absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
      :class="switchValue && 'right-0'" style="background-image: unset;" x-model="switchValue" />
    <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
  </div>
  <label for="toggle" class="text-xs text-gray-700">{{ $filter->title }}</label>
</div>