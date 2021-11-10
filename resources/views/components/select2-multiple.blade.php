@props(['placeholder' => 'Select Options'])

<div wire:ignore>
    <select id="{{ $attributes->whereStartsWith('id')->first() }}" class="form-control select2" multiple="multiple" data-placeholder="{{ $placeholder }}" style="width: 75%;">
        {{ $slot }}
    </select>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', () => {
        $('#{{ $attributes->whereStartsWith('id')->first() }}').select2().on('change', function (e) {
            let data = $(this).val();
            @this.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', data);
        });
    });
</script>
@endpush