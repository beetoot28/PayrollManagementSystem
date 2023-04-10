<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display: none;" x-show="active_tab == 7" x-transition:enter.duration.500ms>
    <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">

            <!-- ERROR MESSAGE -->
            <template x-if="ch_error">
                <div class="bg-red-100 overflow-hidden shadow-sm sm:rounded-md px-3 py-1 text-center mb-2">
                    <span class="text-red-400 text-md font-bold" x-text="settings_msg"></span>
                </div>
            </template>

            <!-- SUCCESS MESSAGE -->
            <template x-if="ch_success">
                <div class="bg-green-100 overflow-hidden shadow-sm sm:rounded-md px-3 py-1 text-center mb-2">
                    <span class="text-green-400 text-md font-bold" x-text="settings_msg"></span>
                </div>
            </template>

            <div class="flex items-center justify-between mb-3">
                <button type="button" class="px-3 py-1.5 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" x-on:click="new_holiday = true"> New </button>
            </div>

            <div class="mb-3">
                <template x-for="holiday in custom_pagination">
                    <div class="flex flex-row items-center justify-between bg-green-100 hover:bg-green-200 rounded-md p-3 mb-3 border-2 border-transparent hover:border-slate-500">
                        <div class="flex flex-col">
                            <span class="font-bold text-md" x-text="holiday_date_formatter(holiday.holiday_date)">J</span>
                            <span class="text-sm italic" x-text="holiday.holiday_name"></span>
                            <span class="text-sm font-semibold" x-text="holiday_type(holiday.holiday_type)"></span>
                        </div>
                        <div class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                            <button type="button" title="Edit" class="text-white bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-1 text-center mr-2 mb-2"
                                x-on:click="edit_holiday = true, holiday_id = holiday.id, $refs.hu_date.value = holiday_date_formatter_dateinput(holiday.holiday_date), $refs.hu_type.value = holiday.holiday_type, $refs.hu_name.value = holiday.holiday_name"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                            <button type="button" title="Delete" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-1 text-center mr-2 mb-2"
                                x-on:click="delete_record = true, holiday_id = holiday.id"
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                                </button>
                        </div>
                    </div>
                </template>
            </div>
            <div class="w-full justify-end flex items-center" style="display: none;"  x-show="pageCount() > 1">
                <!--First Button-->
                {{-- <button x-on:click="viewPage(0)" :disabled="pageNumber==0" :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber==0 }">
                    <svg class="h-5 w-5 text-indigo-600" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="19 20 9 12 19 4 19 20"></polygon><line x1="5" y1="19" x2="5" y2="5"></line></svg>
                </button> --}}

                <!--Previous Button-->
                <button x-on:click="prevPage" :disabled="pageNumber==0" class="px-1.5 py-2 rounded-l-md bg-white border border-gray-200" :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber==0 }">
                    <svg class="text-gray-300" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>

                <!-- Display page numbers -->
                <template x-for="(page,index) in pages()" :key="index">
                    {{-- <button class="px-3 py-2 text-sm" class="bg-white text-gray-700" :class="{ 'bg-white text-gray-700 font-bold' : index === pageNumber }" type="button" x-on:click="viewPage(index)"> --}}
                    <button class="px-3 py-2 text-sm" class="" :class="[ index === pageNumber ? 'bg-white text-gray-700 font-bold border border-gray-200' :  'bg-white text-gray-700 border border-gray-200']" type="button" x-on:click="viewPage(index)">
                        <span x-text="index+1"></span>
                    </button>
                </template>

                <!--Next Button-->
                <button x-on:click="nextPage" :disabled="pageNumber >= pageCount() -1" class="px-1.5 py-2 rounded-r-md bg-white border border-gray-200" :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber >= pageCount() -1 }">
                    <svg class="text-gray-300" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>

                <!--Last Button-->
                {{-- <button x-on:click="viewPage(Math.ceil(total/size)-1)" :disabled="pageNumber >= pageCount() -1" :class="{ 'disabled cursor-not-allowed text-gray-600' : pageNumber >= pageCount() -1 }">
                    <svg class="h-5 w-5 text-indigo-600" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 4 15 12 5 20 5 4"></polygon><line x1="19" y1="5" x2="19" y2="19"></line></svg>
                </button> --}}
            </div>
        </div>

    </div>
</div>
