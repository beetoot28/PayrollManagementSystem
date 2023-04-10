<div class="inline-flex items-center justify-center z-20 top-0 w-full absolute h-full -mt-2" style="display: none;" x-show="update_dr" x-transition.duration.400ms>
    <div class="w-2/5 bg-white rounded-lg shadow-md opacity-100 p-3">

        <div class="flex justify-between">
            {{-- <span class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3">Update Remarks</span> --}}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-blue-700 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            <span x-text="update_msg" class="text-green-500 text-md font-bold "></span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-7 h-7 cursor-pointer rounded-md p-1 hover:bg-gray-300 hover:text-gray-800 text-gray-600 font-semibold "
                x-on:click="clear_drvalues">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <!-- INPUTS -->
        <div class="flex flex-col space-y-3 mt-5 h-96">
            <div class="flex flex-col space-x-3 h-96 overflow-x-auto" :class="[loading_drs ? '' : 'justify-center']">
                <div class="flex items-center justify-center" x-show="!loading_drs">
                    <img :src="src" alt="" class="h-6 w-6">
                    <span class="text-gray-400 p-2 font-bold">LOADING...</span>
                </div>
                <div class="flex items-center shadow-md sm:rounded-lg" x-show="loading_drs">
                    <table class="w-full text-sm text-left dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="">
                                <th scope="col" class="py-2 text-sm whitespace-nowrap text-center font-bold">
                                    <input id="all" name="" x-on:click="check_uncheck_all(document.getElementById('all').checked)"
                                    type="checkbox"
                                    value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </th>
                                <th scope="col" class="py-2 text-white text-sm whitespace-nowrap text-center font-bold">
                                    Amount
                                </th>
                                <th scope="col" class="py-2 text-white text-sm whitespace-nowrap text-center font-bold">
                                    Note
                                </th>
                                <th scope="col" class="py-2 text-white text-sm whitespace-nowrap text-center font-bold">
                                    Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="row in dr_records">
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                        <span>
                                            <input :id="row.id" name=""
                                            x-on:click="check_uncheck(row, document.getElementById(row.id).checked)"
                                            :checked="(row.is_paid == 1 ? true : false)"
                                            type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        </span>
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                        <span x-text="row.amount"></span>
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                        <span x-text="row.note"></span>
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                        <span x-text="date_formatter(row.created_at)"></span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                        <tfoot>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td colspan="4" class="py-3 border-gray-300 text-gray-900 text-sm p-2"><span class="font-bold">Total: </span> <span>&#x20B1; <span x-text="dr_total_amount.toFixed(2)"></span></span></td>
                            </tr>
                          </tfoot>
                    </table>
                </div>

            </div>

            <button type="button" class="px-3 py-1 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                x-on:click="f_update_drs, changes_detected = true" x-ref="dr_update_button">
                Save
            </button>
            {{-- <form action="{{ route('update-dr-values') }}" method="POST">
                @csrf
                <input type="number" name="employee_id" id="employee_id" value="30" hidden>
                <input type="number" name="cutoff_id" id="cutoff_id" value="192" hidden>
                <input type="number" name="payroll_id" id="payroll_id" value="4" hidden>
                <button type="submit">Submit</button>
            </form> --}}
        </div>
    </div>
</div>


