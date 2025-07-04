<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Noli Me Tangere') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full w-full m-0 p-0">
<main class="h-screen w-screen bg-cover bg-center relative overflow-hidden" style="background-image: url('{{ asset('images/chapter_one/outside_house.JPG') }}');">
    {{-- Back button --}}
    <a href="{{ route('play') }}" class="absolute top-4 left-4 bg-white/20 backdrop-blur-md backdrop-saturate-150 text-black p-2 rounded-full shadow-lg transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </a>

    {{-- Narrator --}}
    <div id="narrator" class="absolute top-8 left-1/2 transform -translate-x-1/2 bg-black/60 text-white px-6 py-3 rounded shadow text-lg font-medium">
        “Sa bahay ni Kapitan Tiago ay may engrandeng pagtitipon. Dumating ang mga kilalang tao sa lipunan. Lahat ay naghihintay sa panauhing galing Europa.”
    </div>

    {{-- Tooltip --}}
    <div id="tooltip" class="hidden absolute top-24 left-1/2 transform -translate-x-1/2 bg-yellow-200 text-black text-sm px-4 py-2 rounded shadow transition-opacity duration-500 opacity-0">
        Click Enter
    </div>

    {{-- Ibarra Dialog --}}
    <div id="ibarra-dialog" class="hidden absolute text-sm px-4 py-2 rounded shadow bg-white/80 text-black max-w-sm text-center z-10"></div>

    {{-- Ibarra --}}
    <img id="ibarra" src="{{ asset('images/chapter_one/ibarra.png') }}" alt="Ibarra" class="absolute h-48" style="left: 50px; bottom: 40px;">

    {{-- Tiya Isabel and her dialog --}}
    <div id="tiya-container" class="absolute inset-0 flex items-center justify-center flex-col">
        <div id="tiya-dialog" class="hidden mb-2 bg-white/80 text-black text-sm px-4 py-2 rounded shadow max-w-sm text-center"></div>
        <img id="tiya" src="{{ asset('images/chapter_one/tiya_isabel.png') }}" alt="Tiya Isabel" class="h-48">
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ibarra = document.getElementById('ibarra');
        const tiya = document.getElementById('tiya');
        const narrator = document.getElementById('narrator');
        const tooltip = document.getElementById('tooltip');
        const tiyaDialog = document.getElementById('tiya-dialog');
        const ibarraDialog = document.getElementById('ibarra-dialog');
        let enterPressedRecently = false;


        let left = 50;
        let bottom = 40;
        const step = 10;
        let canMove = false;
        let tooltipShown = false;
        let dialogStep = 0;

        function updateIbarraPosition() {
            ibarra.style.left = `${left}px`;
            ibarra.style.bottom = `${bottom}px`;

            // Also position the ibarraDialog above Ibarra
            const ibarraRect = ibarra.getBoundingClientRect();
            ibarraDialog.style.left = `${ibarraRect.left + ibarraRect.width / 2}px`;
            ibarraDialog.style.top = `${ibarraRect.top - 40}px`;
            ibarraDialog.style.transform = 'translateX(-50%)';
        }

        document.addEventListener('keydown', (e) => {
            if (!canMove && !tooltipShown) {
                tooltip.classList.remove('hidden');
                setTimeout(() => tooltip.classList.add('opacity-100'), 10);
                tooltipShown = true;
            }

            if (!canMove && e.key === 'Enter') {
                narrator.remove();
                tooltip.remove();
                canMove = true;
                return;
            }

            if (canMove && dialogStep === 0) {
                switch (e.key) {
                    case 'ArrowLeft': left -= step; break;
                    case 'ArrowRight': left += step; break;
                    case 'ArrowUp': bottom += step; break;
                    case 'ArrowDown': bottom -= step; break;
                    default: return;
                }

                updateIbarraPosition();

                const ibarraRect = ibarra.getBoundingClientRect();
                const tiyaRect = tiya.getBoundingClientRect();
                const distance = Math.hypot(
                    ibarraRect.left - tiyaRect.left,
                    ibarraRect.bottom - tiyaRect.bottom
                );

                if (distance < 100 && dialogStep === 0) {
                    tiyaDialog.innerText = '“Crisóstomo! Salamat at nakabalik ka. Tuloy ka, iho. Nasa loob na ang mga panauhin.”';
                    tiyaDialog.classList.remove('hidden');
                    dialogStep = 1;
                }
            }
            if (canMove && dialogStep === 1 && e.key === 'Enter' && !enterPressedRecently) {
                enterPressedRecently = true;
                setTimeout(() => enterPressedRecently = false, 300); // Prevent double-enter

                tiyaDialog.classList.add('hidden');
                ibarraDialog.innerText = '“Salamat po, Tiya Isabel. Matagal-tagal din akong nawala.”';
                ibarraDialog.classList.remove('hidden');
                updateIbarraPosition();
                dialogStep = 2;
            }

            if (canMove && dialogStep === 2 && e.key === 'Enter' && !enterPressedRecently) {
                enterPressedRecently = true;
                setTimeout(() => enterPressedRecently = false, 300);

                ibarraDialog.classList.add('hidden');

                fetch("{{ route('update.status') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ route('chapter.inside_house') }}";
                    }
                });

                dialogStep = 3;
            }
        });

        updateIbarraPosition();
    });
</script>



</body>
</html>
