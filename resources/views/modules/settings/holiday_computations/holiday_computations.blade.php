<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display: none;" x-show="active_tab == 6" x-transition.duration.400ms>
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
            {{-- <div class="mb-1 lg:mb-0 w-full">
                <select type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1">Rate</option>
                    <option value="2">Number of Days</option>
                    <option value="3">Rate per Hour</option>
                    <option value="4">Number of Hours OT</option>
                    <option value="5">Basic Wage</option>
                    <option value="6">Hourly Rate of the Basic Wage</option>
                    <option value="7">COLA</option>
                    <option value="8">Number of Hours Worked</option>
                </select>
            </div> --}}
            <template x-for="(holiday_computation, index) in holiday_computations" :key="index">
                <div class="mb-3">
                    <span class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3" x-text="holiday_computation.computation_field1"></span>

                    <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5 mb-3 lg:items-center">
                        {{-- <div class="mb-1 lg:mb-0 w-full" :class="[holiday_computation.computation_field1 ? '' : 'hidden']">
                            <input :id="('cf1_'+(index+1))" :name="('cf1_'+(index+1))" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="holiday_computation.computation_field1" autocomplete="off" disabled>
                        </div> --}}
                        <div class="mb-1 lg:mb-0 w-full" :class="[holiday_computation.computation_field2 ? '' : 'hidden']">
                            <select :id="generate_input_id(2, index)" :name="generate_input_id(2, index)" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                @if ($kinds_of_computations)
                                    @foreach ($kinds_of_computations as $comp)
                                        <template x-if="holiday_computation.computation_field2 == '{{$comp->id}}'">
                                            <option value="{{$comp->id}}" selected hidden>{{$comp->name}}</option>
                                        </template>
                                    @endforeach
                                @endif
                                @if ($kinds_of_computations)
                                    @foreach ($kinds_of_computations as $comp)
                                        <option value="{{$comp->id}}">{{$comp->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- LABELS -->
                        <div class="mb-1 lg:mb-0 flex justify-center" :class="[(index+1) == 1 || (index+1) == 2 || (index+1) == 3 || (index+1) == 4 || (index+1) == 5 || (index+1) == 6 || (index+1) == 9 || (index+1) == 11 ? '' : 'hidden']">
                            <label for="" class="block text-lg font-bold text-gray-900 dark:text-gray-300"> &times; </label>
                        </div>
                        <div class="mb-1 lg:mb-0 flex justify-center" :class="[(index+1) == 7 || (index+1) == 8 || (index+1) == 10 ? '' : 'hidden']">
                            <label for="" class="block text-lg font-bold text-gray-900 dark:text-gray-300"> + </label>
                        </div>

                        <div class="mb-1 lg:mb-0 w-full" :class="[holiday_computation.computation_field3 ? '' : 'hidden']">

                            <template x-if="index != 0 && index != 1 && index != 6 && index != 7 && index != 9">
                                <input :id="generate_input_id(3, index)" :name="generate_input_id(3, index)" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="holiday_computation.computation_field3" autocomplete="off" disabled>
                            </template>

                            <template x-if="index == 0 || index == 1|| index == 6 || index == 7 || index == 9">
                                <select :id="generate_input_id(3, index)" :name="generate_input_id(3, index)" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                    @if ($kinds_of_computations)
                                        @foreach ($kinds_of_computations as $comp)
                                            <template x-if="holiday_computation.computation_field3 == '{{$comp->id}}'">
                                                <option value="{{$comp->id}}" selected hidden>{{$comp->name}}</option>
                                            </template>
                                        @endforeach
                                    @endif
                                    @if ($kinds_of_computations)
                                        @foreach ($kinds_of_computations as $comp)
                                            <option value="{{$comp->id}}">{{$comp->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </template>
                        </div>

                        <!-- LABELS -->
                        <div class="mb-1 lg:mb-0 flex justify-center" :class="[(index+1) == 3 || (index+1) == 5 || (index+1) == 10 ? '' : 'hidden']">
                            <label for="" class="block text-lg font-bold text-gray-900 dark:text-gray-300"> + </label>
                        </div>
                        <div class="mb-1 lg:mb-0 flex justify-center" :class="[(index+1) == 4 || (index+1) == 6 || (index+1) == 7 || (index+1) == 8 || (index+1) == 9 || (index+1) == 11 ? '' : 'hidden']">
                            <label for="" class="block text-lg font-bold text-gray-900 dark:text-gray-300"> &times; </label>
                        </div>

                        <div class="mb-1 lg:mb-0 w-full" :class="[holiday_computation.computation_field4 ? '' : 'hidden']">
                            <template x-if="index != 2 && index != 4">
                                <input :id="generate_input_id(4, index)" :name="generate_input_id(4, index)" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="holiday_computation.computation_field4" autocomplete="off" disabled>
                            </template>

                            <template x-if="index == 2 || index == 4">
                                <select :id="generate_input_id(4, index)" :name="generate_input_id(4, index)" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                    @if ($kinds_of_computations)
                                        @foreach ($kinds_of_computations as $comp)
                                            <template x-if="holiday_computation.computation_field4 == '{{$comp->id}}'">
                                                <option value="{{$comp->id}}" selected hidden>{{$comp->name}}</option>
                                            </template>
                                        @endforeach
                                    @endif
                                    @if ($kinds_of_computations)
                                        @foreach ($kinds_of_computations as $comp)
                                            <option value="{{$comp->id}}">{{$comp->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </template>
                        </div>

                        <!-- LABELS -->
                        <div class="mb-1 lg:mb-0 flex justify-center" :class="[(index+1) == 4 || (index+1) == 6 || (index+1) == 9 || (index+1) == 11 ? '' : 'hidden']">
                            <label for="" class="block text-lg font-bold text-gray-900 dark:text-gray-300"> &times; </label>
                        </div>
                        <div class="mb-1 lg:mb-0 flex justify-center" :class="[(index+1) == 10 ? '' : 'hidden']">
                            <label for="" class="block text-lg font-bold text-gray-900 dark:text-gray-300"> + </label>
                        </div>

                        <div class="mb-1 lg:mb-0 w-full" :class="[holiday_computation.computation_field5 ? '' : 'hidden']">
                            <template x-if="index != 3 && index != 5 && index != 8">
                                <input :id="generate_input_id(5, index)" :name="generate_input_id(5, index)" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="holiday_computation.computation_field5" autocomplete="off" disabled>
                            </template>

                            <template x-if="index == 3 || index == 5 || index == 8">
                                <select :id="generate_input_id(5, index)" :name="generate_input_id(5, index)" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                    @if ($kinds_of_computations)
                                        @foreach ($kinds_of_computations as $comp)
                                            <template x-if="holiday_computation.computation_field5 == '{{$comp->id}}'">
                                                <option value="{{$comp->id}}" selected hidden>{{$comp->name}}</option>
                                            </template>
                                        @endforeach
                                    @endif
                                    @if ($kinds_of_computations)
                                        @foreach ($kinds_of_computations as $comp)
                                            <option value="{{$comp->id}}">{{$comp->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </template>
                        </div>

                        <!-- LABELS -->
                        <div class="mb-1 lg:mb-0 flex justify-center" :class="[(index+1) == 10 || (index+1) == 11 ? '' : 'hidden']">
                            <label for="" class="block text-lg font-bold text-gray-900 dark:text-gray-300"> &times; </label>
                        </div>

                        <div class="mb-1 lg:mb-0 w-full" :class="[holiday_computation.computation_field6 ? '' : 'hidden']">
                            <template x-if="index != 9 && index != 10">
                                <input :id="generate_input_id(6, index)" :name="generate_input_id(6, index)" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="holiday_computation.computation_field6" autocomplete="off" disabled>
                            </template>

                            <template x-if="index == 9 || index == 10">
                                <select :id="generate_input_id(6, index)" :name="generate_input_id(6, index)" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                    @if ($kinds_of_computations)
                                        @foreach ($kinds_of_computations as $comp)
                                            <template x-if="holiday_computation.computation_field6 == '{{$comp->id}}'">
                                                <option value="{{$comp->id}}" selected hidden>{{$comp->name}}</option>
                                            </template>
                                        @endforeach
                                    @endif
                                    @if ($kinds_of_computations)
                                        @foreach ($kinds_of_computations as $comp)
                                            <option value="{{$comp->id}}">{{$comp->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </template>
                        </div>

                        <!-- LABELS -->
                        <div class="mb-1 lg:mb-0 flex justify-center" :class="[(index+1) == 10 ? '' : 'hidden']">
                            <label for="" class="block text-lg font-bold text-gray-900 dark:text-gray-300"> &times; </label>
                        </div>

                        <div class="mb-1 lg:mb-0 w-full" :class="[holiday_computation.computation_field7 ? '' : 'hidden']">
                            <input :id="generate_input_id(7, index)" :name="generate_input_id(7, index)" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="holiday_computation.computation_field7" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="mb-1 lg:mb-0 flex flex-row justify-center space-x-3">
                        <button type="button" :id="generate_ebutton_id(index)" title="Edit" class="px-3 py-1 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            x-on:click="edit_holiday_computations(generate_ebutton_id(index), (generate_ubutton_id(index)), (generate_cbutton_id(index)), index)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </button>
                        <button hidden type="button" :id="generate_ubutton_id(index)" title="Update" class="px-3 py-1 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            disabled
                            x-on:click="update_holiday_computations(index, holiday_computation.computation_id, generate_ebutton_id(index), (generate_ubutton_id(index)), (generate_cbutton_id(index)))">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </button>
                        <button hidden type="button" :id="generate_cbutton_id(index)" title="Cancel" class="px-3 py-1 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            disabled
                            x-on:click="cancel_holiday_computations(generate_ebutton_id(index), (generate_ubutton_id(index)), (generate_cbutton_id(index)), index)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        {{-- x-ref="index == 1 ? ch_edit1 : (index == 2 ? 'ch_edit2' : (index == 3 ? 'ch_edit3' : (index == 4 ? 'ch_edit4' : (index == 5 ? 'ch_edit5' : (index == 6 ? 'ch_edit6' : (index == 7 ? 'ch_edit7' : (index == 8 ? 'ch_edit8' : (index == 9 ? 'ch_edit9' : (index == 10 ? ch_edit10 : (index == 0 ? 'ch_edit0' : ''))))))))))" --}}

                    </div>
                </div>
            </template>


        </div>
    </div>
</div>
