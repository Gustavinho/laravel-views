<x-modal>
    <x-slot name="content">
        <div
                wire:ignore
                wire:model.defer="value"
                x-data="{
                init($dispatch) {
                ClassicEditor
                    .create(this.$el, {
                        toolbar: ['bold', 'italic', 'link'],
                        fillEmptyBlocks: false
                    })
                    .then(function (editor) {
                        editor.model.document.on('change:data', () => {
                            $dispatch('input', editor.getData())
                        })
                    });
                }
                }"
                x-init="init($dispatch)"
        >
            {!! $value !!}
        </div>
    </x-slot>

    <x-slot name="buttons">
        <button
                wire:loading.attr="disabled"
                class="py-2 px-4 rounded transition duration-200 ease-in-out focus:outline-none"
                wire:click="closeModal"
        >
            {{ __('Cancel') }}
        </button>
        <button
                wire:loading.attr="disabled"
                class="py-2 px-4 rounded transition duration-200 ease-in-out focus:outline-none {{ variants()->button('primary')->class() }}"
                wire:click="update"
        >
            {{ __('Save') }}
        </button>
    </x-slot>
</x-modal>