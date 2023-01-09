<x-app-layout>
    <section class="bg-gray-200 ">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0 bg-white">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8 ">
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                    Form Upload Data Tunggal 
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('dataTunggal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="nilai" class="block mb-2 text-sm font-medium text-gray-900 ">Number</label>
                        <input type="number" name="nilai" id="nilai" placeholder="Insert number here..." class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>
                    <button type="submit" class="bg-gray-200 w-full text-gray-900 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Submit </button>
                </form>
            </div>
        </div>
    </div>
</section>
</x-app-layout>