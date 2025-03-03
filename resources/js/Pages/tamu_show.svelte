<script>
    import Layout from './Layout.svelte';
    export let tamu = {};
    let isOpen = false;

    function toggleOpen() {
        isOpen = !isOpen;
    }

    // Sample countdown logic
    let countdownDate = new Date("Dec 14, 2025 15:37:25").getTime();
    let countdown = "";

    function updateCountdown() {
        let now = new Date().getTime();
        let distance = countdownDate - now;

        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdown = `${days}d ${hours}h ${minutes}m ${seconds}s`;

        if (distance < 0) {
            countdown = "EXPIRED";
        }
    }

        setInterval(updateCountdown, 1000);

        function enableScroll() {
            // Add your scroll enabling logic here
        }
    </script>

<Layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-pink-100 to-yellow-100">
        {#if !isOpen}
            <button type="button" class="open-button" on:click={toggleOpen} on:keydown={(e) => e.key === 'Enter' && toggleOpen()}>
                Buka Undangan
            </button>
        {/if}
        {#if isOpen}
            <section id="hero" class="w-full h-full min-h-screen p-3 mx-auto text-center flex justify-center items-center text-pinkPrimary bg-center bg-no-repeat"
                style="background-image: url('/assets/src/img/primary-background.jpg'); color: #E91E63; background-size: cover;">
                <div>
                    <h4 class="text-lg sm:text-xl lg:text-3xl drop-shadow-md animate__animated animate__fadeInLeft">
                        Kepada <span>{tamu.pronoun ?? 'Bapak/Ibu/Saudara/i'} {tamu.nama ?? ''},</span>
                    </h4>
                    <h1 class="my-3 font-sacramento text-4xl sm:text-5xl lg:text-6xl drop-shadow-md animate__animated animate__fadeInRight">Nama Laki-laki & Nama perempuan</h1>
                    <p class="mb-3 text-base sm:text-lg lg:text-2xl drop-shadow-md animate__animated animate__fadeInLeft">Akan melangsungkan resepsi pernikahan dalam:</p>
                    <div class="simply-countdown" id="simply-countdown">{countdown}</div>
                    <a href="#home" class="mt-10 inline-block px-3 py-1.5 rounded-lg shadow-sm shadow-bgPrimary bg-pinkPrimary text-base sm:text-lg lg:text-xl text-white hover:text-pinkPrimary hover:bg-white duration-200 transition animate__animated animate__pulse animate__infinite" on:click={enableScroll}>Lihat Undangan</a>
                </div>
            </section>
        {/if}
    </div>
</Layout>

<style>
    p {
        font-family: 'Lora', serif;
    }
    .open-button {
        padding: 10px 20px;
        font-size: 1.25rem;
        font-weight: bold;
        color: white;
        background-color: #f06292;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }
    .open-button:hover {
        background-color: #e91e63;
    }
    #hero {
        font-family: 'Lora', serif;
    }
    .font-sacramento {
        font-family: 'Sacramento', cursive;
    }
    .text-pinkPrimary {
        color: #E91E63;
    }
    .bg-pinkPrimary {
        background-color: #E91E63;
    }
</style>
