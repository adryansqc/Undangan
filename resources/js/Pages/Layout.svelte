<script>
    import { inertia } from '@inertiajs/svelte';
    import { onMount } from 'svelte';
    let isMenuOpen = false;
    let isScrolled = false;

    function toggleMenu() {
        isMenuOpen = !isMenuOpen;
    }

    onMount(() => {
        const handleResize = () => {
            if (window.innerWidth > 768) {
                isMenuOpen = false;
            }
        };

        const handleScroll = () => {
            isScrolled = window.scrollY > 0;
        };

        window.addEventListener('resize', handleResize);
        window.addEventListener('scroll', handleScroll);
        return () => {
            window.removeEventListener('resize', handleResize);
            window.removeEventListener('scroll', handleScroll);
        };
    });
    export let children;
</script>

<div class="min-h-screen flex flex-col bg-gradient-to-br from-blue-100 to-purple-200">
    <header class={`fixed w-full z-50 transition-all duration-300 ${isScrolled ? 'bg-white/90 backdrop-blur-sm shadow-lg' : 'bg-transparent'}`}>
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <h1 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 hover:scale-105 transition-transform duration-300">
                Undangan
            </h1>
            <button
                class="md:hidden p-2 focus:outline-none rounded-lg hover:bg-gray-100/50 transition-colors duration-300"
                on:click={toggleMenu}
                aria-label="Toggle menu"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-blue-600 hover:text-purple-600 transition duration-300 ease-in-out"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"
                    />
                </svg>
            </button>

            <!-- Navigasi Utama (Desktop) -->
            <nav class="hidden md:flex space-x-6 ml-auto nav-center">
                <a href="/tamu" use:inertia class="relative text-blue-600 hover:text-purple-600 transition duration-300 ease-in-out transform hover:scale-110 after:content-[''] after:absolute after:w-full after:h-0.5 after:bg-purple-600 after:bottom-0 after:left-0 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
                    Tamu
                </a>
                <a href="/tamu/galeri" use:inertia class="relative text-blue-600 hover:text-purple-600 transition duration-300 ease-in-out transform hover:scale-110 after:content-[''] after:absolute after:w-full after:h-0.5 after:bg-purple-600 after:bottom-0 after:left-0 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
                    Galeri
                </a>
            </nav>
        </div>

        <!-- Dropdown Menu (Mobile) -->
        {#if isMenuOpen}
            <nav class="md:hidden bg-white/90 backdrop-blur-sm shadow-lg mt-2 py-4 animate-fadeIn">
                <ul class="flex flex-col space-y-4 items-center">
                    <li>
                        <a href="/tamu" use:inertia class="text-blue-600 hover:text-purple-600 transition duration-300 ease-in-out transform hover:scale-110 px-4 py-2 rounded-lg hover:bg-gray-100/50">
                            Tamu
                        </a>
                    </li>
                    <li>
                        <a href="/tamu/galeri" use:inertia class="text-blue-600 hover:text-purple-600 transition duration-300 ease-in-out transform hover:scale-110 px-4 py-2 rounded-lg hover:bg-gray-100/50">
                            Galeri
                        </a>
                    </li>
                </ul>
            </nav>
        {/if}
    </header>

    <main class="flex-grow container mx-auto px-4 py-8 mt-20">
        <slot>{children}</slot>
    </main>

    <footer class="bg-white/90 backdrop-blur-sm shadow-lg py-4">
        <div class="container mx-auto px-4 text-center text-gray-600">
            &copy; 2023 My App. All rights reserved.
        </div>
    </footer>
</div>

<style>
    .min-h-screen {
        min-height: 100vh;
    }
    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    @media (min-width: 768px) {
        .px-4 {
            padding-left: 2rem;
            padding-right: 2rem;
        }
    }

    .nav-center {
        justify-content: center;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>
