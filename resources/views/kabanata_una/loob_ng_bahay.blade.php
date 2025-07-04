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
<main class="h-screen w-screen bg-cover bg-center relative overflow-hidden" style="background-image: url('{{ asset('images/chapter_one/inside_house.PNG') }}');">

    {{-- Back button --}}
    <a href="{{ route('play') }}" class="z-50 absolute top-4 left-4 bg-white/20 backdrop-blur-md backdrop-saturate-150 text-black p-2 rounded-full shadow-lg transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </a>
       {{-- Narrator --}}
    <div id="narrator" class="absolute top-8 left-1/2 transform -translate-x-1/2 bg-black/60 text-white px-6 py-3 rounded shadow text-lg font-medium">
        
    </div>

    {{-- Tooltip --}}
    <div id="tooltip" class="hidden absolute top-24 left-1/2 transform -translate-x-1/2 bg-yellow-200 text-black text-sm px-4 py-2 rounded shadow transition-opacity duration-500 opacity-0">
        Press Enter to continue
    </div>

       {{-- Ibarra --}} 
    <div id="ibarra" class="absolute bottom-20 left-20 flex flex-col items-center">
        <div id="dialog-ibarra" class="hidden mb-2 bg-white/80 text-black text-xs px-3 py-2 rounded shadow max-w-xs text-center"></div>
        <img src="{{ asset('images/chapter_one/ibarra.png') }}" alt="Ibarra" class="h-40">
    </div>

    {{-- Padre Damaso --}}
    <div id="padre-damaso" class="absolute bottom-20 left-60 flex flex-col items-center">
        <div id="dialog-damaso" class="hidden mb-2 bg-white/80 text-black text-xs px-3 py-2 rounded shadow max-w-xs text-center"></div>
        <img src="{{ asset('images/chapter_one/padre_damaso.png') }}" alt="Padre Damaso" class="h-40">
    </div>

    {{-- Padre Sibyla --}}
    <div id="padre-sibyla" class="absolute bottom-20 left-[24rem] flex flex-col items-center">
        <div id="dialog-sibyla" class="hidden mb-2 bg-white/80 text-black text-xs px-3 py-2 rounded shadow max-w-xs text-center"></div>
        <img src="{{ asset('images/chapter_one/padre_sibyla.png') }}" alt="Padre Sibyla" class="h-40">
    </div>

    {{-- Tiya Isabel --}}
    <div id="tiya-isabel" class="absolute bottom-20 left-[36rem] flex flex-col items-center">
        <div id="dialog-isabel" class="hidden mb-2 bg-white/80 text-black text-xs px-3 py-2 rounded shadow max-w-xs text-center"></div>
        <img src="{{ asset('images/chapter_one/tiya_isabel.png') }}" alt="Tiya Isabel" class="h-40">
    </div>


    {{-- Kapitan Tiago --}}
    <div id="kapitan-tiago" class="absolute bottom-20 left-[48rem] flex flex-col items-center">
        <div id="dialog-tiago" class="hidden mb-2 bg-white/80 text-black text-xs px-3 py-2 rounded shadow max-w-xs text-center"></div>
        <img src="{{ asset('images/chapter_one/kapitan_tiago.png') }}" alt="Kapitan Tiago" class="h-40">
    </div>
    <!-- Choice Box -->
    <div id="choice-box" class="hidden absolute bottom-10 left-1/2 transform -translate-x-1/2 bg-white/90 p-4 rounded shadow-lg space-y-2 text-sm text-black text-center">
        <p class="font-semibold mb-2">Piliin ang tugon ni Ibarra:</p>
        <button class="choice-btn bg-yellow-300 hover:bg-yellow-400 px-4 py-2 rounded" data-response="Ang aking ama ay hindi kailanman lumaban sa simbahan. Siya’y isang taong may malasakit sa kapwa.">“Ang aking ama ay hindi kailanman lumaban sa simbahan. Siya’y isang taong may malasakit sa kapwa.”</button>
        <button class="choice-btn bg-yellow-300 hover:bg-yellow-400 px-4 py-2 rounded" data-response="Hindi ko hahayaang dungisan ninyo ang pangalan ng aking ama.">“Hindi ko hahayaang dungisan ninyo ang pangalan ng aking ama.”</button>
        <button class="choice-btn bg-yellow-300 hover:bg-yellow-400 px-4 py-2 rounded" data-response="(Manahimik at ngumiti nang magalang.)">(Manahimik at ngumiti nang magalang.)</button>
    </div>

    <div class="absolute bottom-[12rem] left-[67rem] flex flex-col items-center w-16 h-16 bg-red-600">
        <img src="{{ asset('images/chapter_one/don_rafael.png') }}" alt="">
    </div>
    <div id="puzzle-modal" class="hidden fixed inset-0 bg-black z-50 flex items-center justify-center">
        <div class=" p-4 w-[320px] h-[320px] relative">
            <h2 class="text-center font-bold mb-2 text-white">Ayusin ang Larawan</h2>
            <div id="puzzle-board" class="grid grid-cols-3 gap-1 w-full h-full"></div>
            <button onclick="closePuzzle()" class="absolute top-2 right-2 text-xs text-red-500">X</button>
        </div>
    </div>


</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tooltip = document.getElementById('tooltip');

        const dialogSequence = [
            { id: 'dialog-tiago', text: '“Malugod ko po kayong tinatanggap sa aking munting tahanan. Nawa’y malugod kayong makasalo sa hapunang ito!”' },
            { id: 'dialog-damaso', text: '“Bah! Anong balita? Dumating na raw ang binatang Ibarra mula Europa?”' },
            { id: 'dialog-sibyla', text: '“Oo, Padre Damaso. Siya’y nag-aral sa Madrid at iba’t ibang unibersidad sa Europa.”' },
            { id: 'dialog-damaso', text: '“Ang edukasyon sa Europa ay walang saysay kung hindi naman makadiyos!”' },
            { id: 'dialog-isabel', text: '“Padre, si Crisóstomo po ay anak ni Don Rafael. Isa pong mabuting tao.”' },
            { id: 'dialog-damaso', text: '“Don Rafael? Hmph! Isa siyang erehe! Walang respeto sa simbahan!”' }
            // After this → show ibarraChoices
        ];


        let step = 0;
        let started = false;
        const choiceBox = document.getElementById('choice-box');
        const ibarraDialog = document.getElementById('dialog-ibarra');

        document.querySelectorAll('.choice-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                choiceBox.classList.add('hidden');
                ibarraDialog.innerText = btn.getAttribute('data-response');
                ibarraDialog.classList.remove('hidden');

                // Show narrator message after 2 seconds
                setTimeout(() => {
                    const narrator = document.getElementById('narrator');
                    narrator.innerText = "Sa isang silid, napansin ni Ibarra ang sirang larawan ng kanyang ama...";
                    ibarraDialog.classList.add('hidden');

                    // ✅ Enable movement here
                    canMove = true;

                    setTimeout(() => {
                        narrator.innerText = "";
                    }, 5000);
                }, 2000);

            });
        });



        document.addEventListener('keydown', (e) => {
            if (!started && e.key === 'Enter') {
                tooltip.classList.add('hidden');
                started = true;
            }

            if (started && e.key === 'Enter') {
                if (step > 0) {
                    const prev = document.getElementById(dialogSequence[step - 1].id);
                    if (prev) prev.classList.add('hidden');
                }

                if (step < dialogSequence.length) {
                    const current = document.getElementById(dialogSequence[step].id);
                    if (current) {
                        current.innerText = dialogSequence[step].text;
                        current.classList.remove('hidden');
                    }
                    step++;

                    if (step === dialogSequence.length) {
                        // After last dialog, show choices
                        setTimeout(() => {
                            choiceBox.classList.remove('hidden');
                        }, 1000);
                    }
                }

            }
        });

        // Show tooltip on load
        setTimeout(() => tooltip.classList.remove('hidden'), 300);
        setTimeout(() => tooltip.classList.add('opacity-100'), 600);

        let canMove = false; // allow movement after narrator text

        const ibarraContainer = document.getElementById('ibarra');

    // Enable Ibarra movement
        document.addEventListener('keydown', (e) => {
            if (!canMove) return;

            const style = window.getComputedStyle(ibarraContainer);
            let left = parseInt(style.left);
            let bottom = parseInt(style.bottom);

            const step = 10;

            switch (e.key) {
                case 'ArrowLeft':
                    ibarraContainer.style.left = (left - step) + 'px';
                    break;
                case 'ArrowRight':
                    ibarraContainer.style.left = (left + step) + 'px';
                    break;
                case 'ArrowUp':
                    ibarraContainer.style.bottom = (bottom + step) + 'px';
                    break;
                case 'ArrowDown':
                    ibarraContainer.style.bottom = (bottom - step) + 'px';
                    break;
            }
        });
        const puzzleModal = document.getElementById('puzzle-modal');
        const puzzleBoard = document.getElementById('puzzle-board');
        let puzzleStarted = false;

        // Generate puzzle pieces
       function createPuzzlePieces() {
            puzzleBoard.innerHTML = '';
            const order = [...Array(9).keys()].sort(() => Math.random() - 0.5);
            order.forEach(i => {
                const div = document.createElement('div');
                div.className = 'border border-gray-300';
                div.draggable = true;
                div.dataset.index = i;

                const row = Math.floor(i / 3);
                const col = i % 3;

                div.style.width = '100px';
                div.style.height = '100px';
                div.style.backgroundImage = "url('{{ asset('images/chapter_one/don_rafael.png') }}')";
                div.style.backgroundSize = '300px 300px';
                div.style.backgroundPosition = `-${col * 100}px -${row * 100}px`;

                div.addEventListener('dragstart', dragStart);
                div.addEventListener('dragover', dragOver);
                div.addEventListener('drop', drop);

                puzzleBoard.appendChild(div);
            });
        }


        function dragStart(e) {
            e.dataTransfer.setData('text/plain', e.target.dataset.index);
            e.dataTransfer.setDragImage(e.target, 50, 50);
            
        }

        function dragOver(e) {
            e.preventDefault();
        }

        function drop(e) {
            e.preventDefault();
            const fromIndex = e.dataTransfer.getData('text');
            const toIndex = e.target.dataset.index;

            const fromEl = [...puzzleBoard.children].find(el => el.dataset.index == fromIndex);
            const toEl = e.target;

            if (!fromEl || !toEl || fromEl === toEl) return;

            // Swap background position and index
            [fromEl.style.backgroundPosition, toEl.style.backgroundPosition] = [toEl.style.backgroundPosition, fromEl.style.backgroundPosition];
            [fromEl.dataset.index, toEl.dataset.index] = [toEl.dataset.index, fromEl.dataset.index];

            checkSolved();
        }

        function checkSolved() {
            const pieces = [...puzzleBoard.children];
            const correct = pieces.every((el, idx) => parseInt(el.dataset.index) === idx);
            if (correct) {
                alert('Tama! Nabuo mo ang larawan.');
                closePuzzle();
            }
        }

        function openPuzzle() {
            createPuzzlePieces();
            puzzleModal.classList.remove('hidden');
            puzzleStarted = true;
        }

        function closePuzzle() {
            puzzleModal.classList.add('hidden');
        }

        // Detect if Ibarra is near Don Rafael picture
        const donRafael = document.querySelector("img[alt='']") || document.querySelector("img[src*='don_rafael.png']");
        const ibarra = document.getElementById('ibarra');

        setInterval(() => {
            if (!puzzleStarted) {
                const ibarraBox = ibarra.getBoundingClientRect();
                const rafaelBox = donRafael.getBoundingClientRect();

                const distance = Math.hypot(
                    ibarraBox.left - rafaelBox.left,
                    ibarraBox.top - rafaelBox.top
                );

                if (distance < 80) {
                    openPuzzle();
                }
            }
        }, 500);
    });
</script>
</body>
</html>
