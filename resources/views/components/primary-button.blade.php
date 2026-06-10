<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 rounded-md  text-white  tracking-widest   transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
