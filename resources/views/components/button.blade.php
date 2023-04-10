<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-green uppercase tracking-widest hover:bg-amber-300 active:bg-amber-400 focus:outline-none focus:border-yellow-300 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
