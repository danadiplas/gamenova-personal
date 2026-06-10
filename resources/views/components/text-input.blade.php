@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'rounded-md shadow-sm bg-[#0b0818] border-[#7c3aed] border-2 hover:border-[#5c2bb1] active:border-[#5c2bb1] focus:border-[#5c2bb1] text-white']) }}>
