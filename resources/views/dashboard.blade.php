<x-app-layout>
    <x-slot name="header" class="bg-orange-800">
        <h2 class="font-semibold text-sm text-white  leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 bg-orange-800 text-black border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="p-6 text-white">
                    <ul class="list-disc pl-6 space-y-2 text-sm leading-relaxed">
                        <li><strong>Kabanata 1 – Ang Pagtitipon:</strong> Dumating si Crisóstomo Ibarra mula Europa at sinalubong sa isang piging sa bahay ni Kapitan Tiago. Doon ay nagkaroon siya ng tensyon kay Padre Damaso.</li>
                        <li><strong>Kabanata 2 – Sa Ilalim ng Piging:</strong> Habang nagpapatuloy ang handaan, narinig ni Ibarra ang bulungan ng mga bisita ukol sa kanyang ama, si Don Rafael, na kinikilalang erehe ng simbahan.</li>
                        <li><strong>Kabanata 3 – Mga Alaala sa Madrid:</strong> Sa tahimik na sulok ng bahay, binalikan ni Ibarra ang mga alaala ng pag-aaral niya sa Europa at kung paano ito humubog sa kanyang paninindigan.</li>
                        <li><strong>Kabanata 4 – Paglalakad sa San Diego:</strong> Bumalik si Ibarra sa kanilang bayan. Sa bawat kanto, naramdaman niya ang pagbabago sa paligid at ang bigat ng alaala ng kanyang ama.</li>
                        <li><strong>Kabanata 5 – Alay sa Ama:</strong> Dinalaw ni Ibarra ang puntod ni Don Rafael. Doon ay nangakong ipagpapatuloy ang adhikain ng ama at iaahon ang bayan mula sa pagkapiit ng korapsyon at pananampalatayang bulag.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
