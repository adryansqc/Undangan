<script>
    import Layout from './Layout.svelte';
    import { onMount } from 'svelte';
    import { Inertia } from '@inertiajs/inertia';
    import { router } from '@inertiajs/svelte';


    let formData = {
        nama: '',
        pronoun: '',
    };

    // Fungsi untuk mengirim data ke server
    function handleSubmit() {
        router.post('/tamu/store', formData);
    }
</script>

<Layout>

<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-100 to-purple-200">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tambah Tamu Baru</h2>

        <!-- Form Input -->
        <form on:submit|preventDefault={handleSubmit}>
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input
                    type="text"
                    id="nama"
                    bind:value={formData.nama}
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required
                />
            </div>

            <div class="mb-4">
                <label for="pronoun" class="block text-sm font-medium text-gray-700">Pronoun</label>
                <input
                    type="text"
                    id="pronoun"
                    bind:value={formData.pronoun}
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required
                />
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Simpan
            </button>
        </form>
    </div>
</div>

</Layout>
