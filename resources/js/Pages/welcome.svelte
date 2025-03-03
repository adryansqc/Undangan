<script>
    import { onMount } from 'svelte';
    import Layout from './Layout.svelte';
    import { inertia } from '@inertiajs/svelte';
    import { router } from '@inertiajs/svelte';

    export let tamu = {
        data: [],
        meta: {
            current_page: 1,
            last_page: 1
        },
        links: []
    };
    // Debugging
    console.log('Tamu data received:', tamu);
    export let flash = {};

    let pertama = tamu.data.length > 0 ? tamu.data[0].nama : "Tamu";
    let showFlash = false;
    let flashMessage = '';

    function handleDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            router.delete(`/tamu/${id}`, {
                onSuccess: () => {
                    alert('Data tamu berhasil dihapus!');
                },
                onError: (errors) => {
                    alert('Terjadi kesalahan: ' + JSON.stringify(errors));
                },
            });
        }
    }

    function navigateToPage(page) {
        if (page) {
            router.visit(`/tamu?page=${page}`);
        }
    }

    onMount(() => {
        if (flash.message) {
            flashMessage = flash.message;
            showFlash = true;
        } else if (flash.success) {
            flashMessage = flash.success;
            showFlash = true;
        } else if (flash.error) {
            flashMessage = flash.error;
            showFlash = true;
        }

        if (showFlash) {
            setTimeout(() => {
                showFlash = false;
            }, 5000);
        }
    });
</script>

<Layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-100 to-purple-200">

        {#if showFlash}
            <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
                {flashMessage}
            </div>
        {/if}

        <header class="text-center space-y-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                Welcome {pertama}!
            </h1>
            <p class="text-lg md:text-xl text-gray-700 max-w-md mx-auto">
                Selamat datang di aplikasi Laravel + Svelte + Inertia.js! Kami senang Anda bergabung dengan kami.
            </p>
        </header>

        <div class="mt-6 w-full max-w-lg bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">Daftar Tamu:</h2>
            <ul class="divide-y divide-gray-300">
                {#each tamu.data as item}
                    <li class="py-2 flex justify-between items-center">
                        <span>{item.nama}</span>
                        <div class="flex space-x-2">
                            <a
                                href={`/tamu/${item.slug}`}
                                use:inertia
                                class="px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            >
                                Lihat
                            </a>
                            <button
                                on:click={() => handleDelete(item.id)}
                                class="px-3 py-1 text-sm font-medium text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            >
                                Hapus
                            </button>
                        </div>
                    </li>
                {/each}
            </ul>

            {#if tamu.meta.last_page > 1}
                <div class="flex justify-center mt-4 space-x-2">
                    <!-- Previous Page Button -->
                    <button
                        class="px-3 py-1 rounded {tamu.meta.current_page > 1 ? 'bg-blue-500 text-white hover:bg-blue-600' : 'bg-gray-300 text-gray-500 cursor-not-allowed'}"
                        on:click={() => navigateToPage(tamu.meta.current_page - 1)}
                        disabled={tamu.meta.current_page <= 1}
                    >
                        &laquo; Prev
                    </button>

                    <!-- Page Number Display -->
                    <span class="px-3 py-1 rounded bg-gray-200">
                        {tamu.meta.current_page} dari {tamu.meta.last_page}
                    </span>

                    <!-- Next Page Button -->
                    <button
                        class="px-3 py-1 rounded {tamu.meta.current_page < tamu.meta.last_page ? 'bg-blue-500 text-white hover:bg-blue-600' : 'bg-gray-300 text-gray-500 cursor-not-allowed'}"
                        on:click={() => navigateToPage(tamu.meta.current_page + 1)}
                        disabled={tamu.meta.current_page >= tamu.meta.last_page}
                    >
                        Next &raquo;
                    </button>
                </div>
            {/if}
        </div>

        <!-- Tombol Tambah Tamu -->
        <div class="mt-8">
            <a href="/tamu/create" use:inertia
               class="inline-block px-6 py-3 text-lg font-semibold text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-full shadow-lg hover:from-blue-700 hover:to-purple-700 transition duration-300 ease-in-out">
                Tambah Tamu
            </a>
        </div>
    </div>
</Layout>
