<script>
    import Layout from './Layout.svelte';
    import { onMount } from 'svelte';
    import { router, page } from '@inertiajs/svelte';

    // Update galeri prop to match the collection structure
    export let galeri = {
        data: [],
        meta: {
            current_page: 1,
            from: 1,
            last_page: 1,
            path: '',
            per_page: 3,
            to: 1,
            total: 0
        },
        links: {
            first: null,
            last: null,
            prev: null,
            next: null
        }
    };

    export let flash = {};

    // State untuk modal tambah
    let showModal = false;
    let foto = null;
    let previewUrl = null;
    let isUploading = false;

    // State untuk modal edit
    let showEditModal = false;
    let editingFoto = null;
    let editPreviewUrl = null;
    let isUpdating = false;

    // State untuk modal hapus
    let showDeleteModal = false;
    let deletingFoto = null;
    let isDeleting = false;

    // State untuk flash message
    let showFlash = false;
    let flashMessage = '';
    let flashType = 'success';

    function toggleModal() {
        showModal = !showModal;
        if (!showModal) {
            resetForm();
        }
    }

    function toggleEditModal(item = null) {
        if (item) {
            editingFoto = item;
            editPreviewUrl = `/storage/${item.foto}`;
        } else {
            editingFoto = null;
            editPreviewUrl = null;
        }
        showEditModal = !showEditModal;
    }

    function toggleDeleteModal(item = null) {
        deletingFoto = item;
        showDeleteModal = !showDeleteModal;
    }

    function resetForm() {
        foto = null;
        previewUrl = null;
    }

    function handleFileChange(event) {
        const file = event.target.files[0];
        if (file) {
            foto = file;
            previewUrl = URL.createObjectURL(file);
        }
    }

    function handleEditFileChange(event) {
        const file = event.target.files[0];
        if (file) {
            foto = file;
            editPreviewUrl = URL.createObjectURL(file);
        }
    }

    function submitForm() {
        if (!foto) return;

        isUploading = true;

        const formData = new FormData();
        formData.append('foto', foto);

        router.post('/tambah-foto', formData, {
            forceFormData: true,
            onSuccess: () => {
                toggleModal();
                isUploading = false;
            },
            onError: () => {
                isUploading = false;
            }
        });
    }

    function submitEditForm() {
        if (!foto && !editingFoto) return;

        isUpdating = true;

        const formData = new FormData();
        if (foto) {
            formData.append('foto', foto);
        }
        formData.append('_method', 'PUT');

        router.post(`/update-foto/${editingFoto.id}`, formData, {
            forceFormData: true,
            onSuccess: () => {
                toggleEditModal();
                isUpdating = false;
            },
            onError: () => {
                isUpdating = false;
            }
        });
    }

    function submitDeleteForm() {
        if (!deletingFoto) return;

        isDeleting = true;

        router.delete(`/hapus-foto/${deletingFoto.id}`, {
            onSuccess: () => {
                toggleDeleteModal();
                isDeleting = false;
            },
            onError: () => {
                isDeleting = false;
            }
        });
    }

    // Periksa flash message setiap kali page berubah
    $: {
        if ($page.props.flash) {
            if ($page.props.flash.success) {
                flashMessage = $page.props.flash.success;
                flashType = 'success';
                showFlash = true;
            } else if ($page.props.flash.error) {
                flashMessage = $page.props.flash.error;
                flashType = 'error';
                showFlash = true;
            } else if ($page.props.flash.message) {
                flashMessage = $page.props.flash.message;
                flashType = 'info';
                showFlash = true;
            }

            if (showFlash) {
                setTimeout(() => {
                    showFlash = false;
                }, 5000);
            }
        }
    }

    onMount(() => {
        // Cek flash saat komponen dimount
        if (flash.success) {
            flashMessage = flash.success;
            flashType = 'success';
            showFlash = true;
        } else if (flash.error) {
            flashMessage = flash.error;
            flashType = 'error';
            showFlash = true;
        } else if (flash.message) {
            flashMessage = flash.message;
            flashType = 'info';
            showFlash = true;
        }

        if (showFlash) {
            setTimeout(() => {
                showFlash = false;
            }, 5000);
        }
    });

    function changePage(url) {
        if (!url) return;
        
        router.get(url, {}, {
            preserveState: true,
            preserveScroll: true,
            only: ['galeri']
        });
    }
</script>

<Layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-100 to-purple-200">
        <!-- Flash Message -->
        {#if showFlash}
            <div class={`fixed top-4 right-4 px-4 py-2 rounded shadow-lg z-50 ${flashType === 'error' ? 'bg-red-500' : flashType === 'info' ? 'bg-blue-500' : 'bg-green-500'} text-white`}>
                {flashMessage}
            </div>
        {/if}

        <div class="w-full max-w-6xl bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Galeri Foto</h2>
                <button
                    on:click={toggleModal}
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors"
                >
                    Tambah Foto
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                {#each galeri.data as item}
                    <div class="bg-white p-2 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 relative group">
                        <img
                            src={`/storage/${item.foto}`}
                            alt="Foto Galeri"
                            class="w-full h-64 object-cover rounded"
                        />

                        <!-- Overlay action buttons yang muncul saat hover -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center gap-2 transition-opacity duration-300 rounded">
                            <button
                                on:click={() => toggleEditModal(item)}
                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition-colors"
                            >
                                Edit
                            </button>
                            <button
                                on:click={() => toggleDeleteModal(item)}
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors"
                            >
                                Hapus
                            </button>
                        </div>
                    </div>
                {/each}
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex flex-col items-center space-y-4">
                <div class="flex justify-center items-center space-x-2">
                    <!-- First Page -->
                    <button 
                        class="px-4 py-2 rounded-md {!galeri.links.first ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-blue-500 text-white hover:bg-blue-600'}"
                        on:click={() => changePage(galeri.links.first)}
                        disabled={!galeri.links.first}
                    >
                        First
                    </button>

                    <!-- Previous Page -->
                    <button 
                        class="px-4 py-2 rounded-md {!galeri.links.prev ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-blue-500 text-white hover:bg-blue-600'}"
                        on:click={() => changePage(galeri.links.prev)}
                        disabled={!galeri.links.prev}
                    >
                        Previous
                    </button>

                    <!-- Current Page Info -->
                    <span class="px-4 py-2 text-gray-700">
                        Page {galeri.meta.current_page} of {galeri.meta.last_page}
                    </span>

                    <!-- Next Page -->
                    <button 
                        class="px-4 py-2 rounded-md {!galeri.links.next ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-blue-500 text-white hover:bg-blue-600'}"
                        on:click={() => changePage(galeri.links.next)}
                        disabled={!galeri.links.next}
                    >
                        Next
                    </button>

                    <!-- Last Page -->
                    <button 
                        class="px-4 py-2 rounded-md {!galeri.links.last ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-blue-500 text-white hover:bg-blue-600'}"
                        on:click={() => changePage(galeri.links.last)}
                        disabled={!galeri.links.last}
                    >
                        Last
                    </button>
                </div>

                <!-- Results Info -->
                <div class="text-sm text-gray-600">
                    Showing {galeri.meta.from} to {galeri.meta.to} of {galeri.meta.total} results
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Foto -->
    {#if showModal}
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-medium text-gray-900">Tambah Foto</h3>
                    <button
                        on:click={toggleModal}
                        class="text-gray-400 hover:text-gray-500"
                        aria-label="Close modal"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form on:submit|preventDefault={submitForm}>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="foto">
                            Pilih Foto
                        </label>
                        <input
                            type="file"
                            id="foto"
                            accept="image/*"
                            on:change={handleFileChange}
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        >
                    </div>

                    {#if previewUrl}
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Preview:</p>
                            <img src={previewUrl} alt="Preview" class="w-full h-48 object-cover rounded">
                        </div>
                    {/if}

                    <div class="flex justify-end">
                        <button
                            type="button"
                            on:click={toggleModal}
                            class="mr-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600"
                            disabled={!foto || isUploading}
                        >
                            {isUploading ? 'Mengunggah...' : 'Simpan'}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    {/if}

    <!-- Modal Edit Foto -->
    {#if showEditModal}
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-medium text-gray-900">Edit Foto</h3>
                    <button
                        on:click={() => toggleEditModal()}
                        class="text-gray-400 hover:text-gray-500"
                        aria-label="Close modal"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form on:submit|preventDefault={submitEditForm}>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="edit-foto">
                            Pilih Foto Baru
                        </label>
                        <input
                            type="file"
                            id="edit-foto"
                            accept="image/*"
                            on:change={handleEditFileChange}
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        >
                    </div>

                    {#if editPreviewUrl}
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Foto Saat Ini:</p>
                            <img src={editPreviewUrl} alt="Preview" class="w-full h-48 object-cover rounded">
                        </div>
                    {/if}

                    <div class="flex justify-end">
                        <button
                            type="button"
                            on:click={() => toggleEditModal()}
                            class="mr-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600"
                            disabled={isUpdating}
                        >
                            {isUpdating ? 'Menyimpan...' : 'Simpan Perubahan'}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    {/if}

    <!-- Modal Hapus Foto -->
    {#if showDeleteModal}
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-medium text-gray-900">Hapus Foto</h3>
                    <button
                        on:click={() => toggleDeleteModal()}
                        class="text-gray-400 hover:text-gray-500"
                        aria-label="Close modal"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700">Apakah Anda yakin ingin menghapus foto ini?</p>
                    {#if deletingFoto}
                        <div class="mt-4">
                            <img src={`/storage/${deletingFoto.foto}`} alt="Foto yang akan dihapus" class="w-full h-48 object-cover rounded">
                        </div>
                    {/if}
                </div>

                <div class="flex justify-end">
                    <button
                        type="button"
                        on:click={() => toggleDeleteModal()}
                        class="mr-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200"
                    >
                        Batal
                    </button>
                    <button
                        on:click={submitDeleteForm}
                        class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600"
                        disabled={isDeleting}
                    >
                        {isDeleting ? 'Menghapus...' : 'Hapus'}
                    </button>
                </div>
            </div>
        </div>
    {/if}
</Layout>
