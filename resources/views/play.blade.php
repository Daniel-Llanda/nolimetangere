<x-app-layout>
    <x-slot name="header" class="bg-orange-800">
        <h2 class="font-semibold text-sm text-white leading-tight">
            {{ __('Play') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto flex justify-center items-center flex-col gap-3 sm:px-6 lg:px-8 py-8">
            <a href="{{route('kabanata_una')}}" class="text-center text-white w-full sm:max-w-lg p-5 bg-orange-800 text-black border-4 border-black shadow-[4px_4px_0_#000] font-['Press_Start_2P']">
                Kabanata 1
            </a>
            <a href="" class="text-center text-white w-full sm:max-w-lg p-5 bg-orange-800 text-black border-4 border-black shadow-[4px_4px_0_#000] font-['Press_Start_2P']">
                Kabanata 2
            </a>
            <a href="" class="text-center text-white w-full sm:max-w-lg p-5 bg-orange-800 text-black border-4 border-black shadow-[4px_4px_0_#000] font-['Press_Start_2P']">
                Kabanata 3
            </a>
            <a href="" class="text-center text-white w-full sm:max-w-lg p-5 bg-orange-800 text-black border-4 border-black shadow-[4px_4px_0_#000] font-['Press_Start_2P']">
                Kabanata 4
            </a>
            <a href="" class="text-center text-white w-full sm:max-w-lg p-5 bg-orange-800 text-black border-4 border-black shadow-[4px_4px_0_#000] font-['Press_Start_2P']">
                Kabanata 5
            </a>
        </div>
    </div>

</x-app-layout>
