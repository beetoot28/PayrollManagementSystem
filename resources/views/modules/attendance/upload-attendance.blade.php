<x-app-layout>
    <x-slot name="title">
        {{ $title = 'Upload Attendance' }}
    </x-slot>

    <div class="flex flex-row items-center">
        <x-auth-validation-errors class="my-4 mx-auto" :errors="$errors" />
    </div>

    <div class="py-12" x-data="attendance">
        @include('modules.attendance.warning-modal')
        @include('modules.attendance.add-attendance-modal')
        @include('modules.attendance.save-attendance-modal')
        @include('modules.attendance.errorsave-attendance-modal')
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
            <div style="display: none;" x-show="!show_data">
                {{-- <button x-on:click="count_att">Click Me</button> --}}
                <label for="cutoff_date" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Cut off Date <span class="text-red-400 text-lg">*</span></label>

                <div class="mb-6 flex flex-row items-center">
                    <div class="flex flex-col">
                        <input datepicker datepicker-autohide  type="text" id="cutoff_date" name="cutoff_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $current_date }}" x-ref="cutoff_date" autocomplete="off">
                    </div>
                    <button type="button" class="flex h-9 items-center px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" x-on:click="check_cutoff">Go</button>
                    <span class="ml-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-700" style="display: none;" x-show="is_passed">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-700" style="display: none;" x-show="is_not_passed">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700 animate-spin" style="display: none;" x-show="is_check_cutoff">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
                        </svg>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-700 animate-spin">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg> --}}
                        <span class="ml-2 text-red-400 text-xs font-bold" x-show="is_blank_cutoff" x-text="error_message"></span>
                    </span>
                </div>
                <template x-if="error">
                    <div class="bg-red-100 overflow-hidden shadow-sm sm:rounded-md mt-2 px-3 py-3 text-center mb-2">
                        <span class="text-red-400 text-md font-bold" x-text="error_message"></span>
                    </div>
                </template>
                <label for="attendance_file">
                    <div class="w-full rounded-lg bg-gray-50 h-32 border-dashed border-2 border-indigo-600 flex items-center justify-center" :class="[ !allowed_upload ? 'cursor-not-allowed' : 'cursor-pointer']" x-show="!show_data"
                        :class="[dragging ? 'border-blue-400' : 'border-gray-200']"
                        x-on:dragover.prevent="dragging = true"
                        x-on:dragleave.prevent="dragging = false"
                        x-on:drop.prevent="onDropFile">

                        <input type="file" hidden id="attendance_file" name="attendance_file" x-on:change="select_file" x-ref="file" :disabled="!allowed_upload">
                        <span>Drag and drop, or <span class="text-green-300 font-bold text-lg">browse</span> your files</span>
                    </div>
                </label>

                <template x-for="(item, index) in csvFile" :key="index">
                    <div class="bg-gray-100 mx-5 mt-5 p-3 flex rounded-md items-center">
                        <div class="">
                        </div>
                        <div class="flex flex-col w-full">
                            <div class="flex flex-row justify-between w-full items-center">
                                <span class="text-sm text-gray-700 font-semibold" x-text="item.file.name"></span>
                                <span class="invisible text-2xl cursor-pointer text-gray-700 font-semibold">&times;</span>
                            </div>
                            <div class="flex flex-row justify-between w-full bg-gray-200 rounded-full">
                                <div class="bg-green-400 h-2 rounded-full" :style="`width: ${item.progress}%`">
                                </div>
                            </div>
                            <div class="flex flex-row justify-between w-full pt-1">
                                <span class="text-sm text-gray-700 font-semibold"><span x-text="item.file_size"></span> MB</span>
                                <span class="text-sm text-gray-700 font-semibold"><span x-text="item.progress"></span>%</span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <template x-if="show_data">
                <div>
                    <div class="items-center">
                        <div class="left-48 top-28 inline-block hover:shadow-lg focus:shadow-lg space-x-2" role="group">
                            <button type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-1 mb-2" x-on:click="show_warning = true">Reupload</button>
                            <button type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-1 mb-2" x-on:click="show_addrecord = true">Add Record</button>
                            <button type="button" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" x-on:click="show_warning = true">Back</button>
                            <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" x-on:click="show_save = true">Save</button>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="show_data">
                <div class="mt-2 justify-center flex items-center shadow-md sm:rounded-lg overflow-x-auto">
                    <table class="w-full text-sm text-left dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="">
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Employee No.
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Employee Name
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Account No.
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    No.
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Cut-off Date
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Date
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Time In (AM)
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Time Out (AM)
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Time In (PM)
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Time Out (PM)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <template x-for="(attendance) in attendance_data"> --}}
                            <template x-for="(value, index) in attendance_data">
                                <tr>
                                    <td scope="row"  class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                        x-text="value[0]">
                                    </td>
                                    <td scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                        x-text="value[3]">
                                    </td>
                                    <td scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                        x-text="value[1]">
                                    </td>
                                    <td class="text-center"
                                        x-text="value[2]">
                                    </td>
                                    <td class="text-center">
                                        <span x-text="$refs.cutoff_date.value"></span>
                                    </td>
                                    <td class="text-center" x-text="value[4]">
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2" contenteditable='true'
                                        x-text="value[5]" @input="update_current_record(index, 5, $el.textContent)">
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2" contenteditable='true'
                                        x-text="value[6]" @input="update_current_record(index, 6, $el.textContent)">
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2" contenteditable='true'
                                        x-text="value[7]" @input="update_current_record(index, 7, $el.textContent)">
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2" contenteditable='true'
                                        x-text="value[8]" @input="update_current_record(index, 8, $el.textContent)">
                                    </td>


                                    {{-- <td class="flex flex-row justify-center py-7">
                                        <a href="{{ route('view-employee', $employee->employee_id) }}" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-1 mr-2 mb-2">View</a>
                                        <a href="{{ route('edit-employee', $employee->employee_id) }}" class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-1 mr-2 mb-2">Edit</a>
                                        <a href="" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-1 text-center mr-2 mb-2">Print</a>
                                    </td> --}}
                                </tr>
                            </template>
                            {{-- </template> --}}
                        </tbody>
                    </table>
                    <div :class="[ show_data == false ? '' : 'hidden']">
                        No data to show
                    </div>
                </div>
            </template>
        </div>
        <div class="flex items-center h-full justify-center mx-auto overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full  md:inset-0 px-2 pt-2" style="display: none" x-show="no_click_allowed">

        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('attendance', () => ({
            'error_message': '',
            'show_data': false,
            'attendance_data': [],
            'attendance_array_temp': [],
            'show_warning': false,
            'show_addrecord': false,
            'show_save': false,

            'dragging': false,
            'csv_data': [],
            'csvFile': [],
            'upload_successful': false,
            'error': false,
            'is_blank_cutoff': false,
            'attendance_count': 0,

            'allowed_upload': false,
            'no_click_allowed': false,
            'is_check_cutoff': false,
            'is_passed': false,
            'is_not_passed': false,

            'error_during_save': false,
            'redirect': false,

            'temp_records': [],
            'add_cutoff_date': '',
            'add_error': false,

            count_att(){
                console.log(this.attendance_array_temp);
            },
            update_current_record(row, column, details){
                this.attendance_array_temp[row][column] = details;
            },
            get_current_cutoff(cutoff_val){
                this.add_cutoff_date = cutoff_val;
            },
            select_file($event){
                this.csvFile = [];
                let files = [...$event.target.files];
                this.uploadFiles(files);
            },
            onDropFile($event){
                this.csvFile = [];
                this.dragging = false;
                let files = [...$event.dataTransfer.items]
                    .filter(item => item.kind === 'file')
                    .map(item => item.getAsFile());

                this.uploadFiles(files)
            },
            uploadFiles(files){
                this.no_click_allowed = true;

                //allowed file type | CSV
                const allowed_type = 'csv';
                let upload_type = '';
                let next_step = false;
                for (const key in files) {
                    if (Object.hasOwnProperty.call(files, key)) {
                        const element = files[key];
                        upload_type = element.name.split(".").pop();

                        if (allowed_type == upload_type.toLowerCase()) {
                            // for file size
                            const bytesToMegaBytes = bytes => (bytes / (1024 ** 2)).toFixed(2);
                            this.csvFile.unshift({
                                file: element,
                                progress: 0,
                                file_size: bytesToMegaBytes(element.size),
                            });
                            next_step = true;
                            break;
                        }
                        else{
                            break;
                        }

                    }
                }
                if(next_step) {
                    for (const key in files) {
                        if (Object.hasOwnProperty.call(this.csvFile, key)) {
                            this.csv_data = [];
                            let form = new FormData;
                            form.append('attendance_file', this.csvFile[key].file);
                            form.append('file_type', upload_type);
                            axios.post('{{ route('upload_attendance') }}', form, {
                                onUploadProgress: (event) => {
                                    this.csvFile[key].progress = Math.round(event.loaded * 100 / event.total);
                                    if (this.csvFile[key].progress == 100){
                                        this.upload_successful = true;
                                    }
                                }
                            })
                            .then((response) => {
                                var _resp = response.data[0];
                                this.show_data = true;
                                this.attendance_count = response.data[0].length;

                                let dtr_counter = 0;
                                let dtr_to_process = [];
                                const dummy_date = '2023-01-01';
                                for (let index = 0; index < this.attendance_count; index++) {
                                    if (index != 0){
                                        let dtr_row = {
                                            '_field1': _resp[index][0],
                                            '_field2': _resp[index][1],
                                            '_field3': _resp[index][2],
                                            '_field4': _resp[index][3],
                                            '_field5': _resp[index][4],
                                            '_field6': _resp[index][5],
                                            '_field7': _resp[index][6],
                                            '_field8': _resp[index][7],
                                            '_field9': _resp[index][8]
                                        };
                                        dtr_to_process.push([dtr_row]);
                                    }
                                }

                                axios.post('/process-time', {dtr_to_process}, {
                                    headers: {
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then((_response) => {
                                    console.log( _response.data);
                                    let _array = [];
                                    for (const key in _response.data) {
                                        if (Object.hasOwnProperty.call(_response.data, key)) {
                                            const element = _response.data[key];
                                            _array[key] = Object.values(element);

                                            this.attendance_array_temp.push(_array[key]);
                                            this.attendance_data.push(_array[key]);
                                        }
                                    }
                                    // console.log(this.attendance_array_temp);
                                });
                                //
                                this.no_click_allowed = false;
                            },
                            (error) => {
                                console.log(error);
                            });
                        }
                    }
                }
                else {
                    this.upload_successful = false;
                    this.error_message = "Invalid file type";
                    this.error = true;
                    setTimeout(() => {
                        this.error_message = "";
                        this.error = false;
                    }, 2000);

                }
            },
            async save_attendance(){
                // Extract data for saving to database
                const arr = this.attendance_array_temp;
                this.no_click_allowed = true;
                this.show_save = false;

                // Array that holds formatted data
                var attendance = [];
                for (let index = 0; index < arr.length; index++) {
                    // let Obj = Object.values(this.attendance_array_temp[index][0]);
                    let row = {
                        "employee_no":      arr[index][0],
                        "account_no":       arr[index][1],
                        "no":               arr[index][2],
                        "employee_name":    arr[index][3],
                        "date":             arr[index][4],
                        "time_in_am":       arr[index][5],
                        "time_out_am":      arr[index][6],
                        "time_in_pm":       arr[index][7],
                        "time_out_pm":      arr[index][8]
                    }
                    attendance.push(row);
                }

                // Post data
                await axios.post('{{ route('store-attendances') }}', {
                        cutoff_date: this.$refs.cutoff_date.value,
                        attendance_data: attendance
                    }, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                .then((response) => {
                    console.log(response.data);
                    if(response.data == 1){
                        this.error_during_save = response.data;
                        this.error_message = 'Something went wrong please double check if all fields are not empty!';
                        this.no_click_allowed = false;
                    }
                    else if(response.data == 0) {
                        this.redirect = true;
                        this.error_during_save = true;
                        this.error_message = 'Attendance Uploaded Successfully';
                        this.no_click_allowed = false;
                    }
                    // else if(response.data == 'employee code error'){
                    //     this.error_during_save = true;
                    //     this.error_message = 'One of the employee code does not match in database records!';
                    //     this.no_click_allowed = false;
                    // }
                    else {
                        this.error_during_save = true;
                        // this.error_message = 'Time in and Time out cannot be empty!';
                        this.error_message = response.data;
                        this.no_click_allowed = false;
                    }
                },
                (error) => {
                    console.log(error);
                });
                this.no_click_allowed = false;
            },
            add_new_records(employee_no, account_no, no, employee_name, date_in, time_in_am, time_out_am, time_in_pm, time_out_pm){
                if (this.$refs.employee_no.value && this.$refs.account_no.value && this.$refs.employee_name.value && this.$refs.time_in_am.value && this.$refs.time_out_am.value && this.$refs.time_in_pm.value && this.$refs.time_out_pm.value && this.$refs.date_in.value){
                    let row = [employee_no, account_no, no, employee_name, date_in, time_in_am, time_out_am, time_in_pm, time_out_pm];
                    this.temp_records.push(row);

                    this.$refs.employee_no.value = '';
                    this.$refs.employee_name.value = '';
                    this.$refs.department.value = '';
                    this.$refs.date_in.value = '';
                    this.$refs.time_in_am.value = '';
                    this.$refs.time_out_am.value = '';
                    this.$refs.time_in_pm.value = '';
                    this.$refs.time_out_pm.value = '';
                    this.$refs.account_no.value = '';
                    this.$refs.no.value = '';

                }
                else {
                    this.add_error = true;
                    setTimeout(() => {
                        this.add_error = false;
                    }, 2000);
                }
            },
            merge_records(){
                const _length = this.temp_records.length;
                for (let index = 0; index < _length; index++) {
                    this.attendance_array_temp.push(this.temp_records[index]);
                    this.attendance_data.push(this.temp_records[index]);
                }
                // console.log(this.temp_records);
                // console.log(this.attendance_array_temp);

                // this.attendance_data = [];
                // this.attendance_data = this.attendance_array_temp;
                this.show_addrecord = false;
                this.temp_records = [];
            },
            remove_record(delete_index){
                var temp_array = this.temp_records;
                const record_length = this.temp_records.length;
                this.no_click_allowed = true;
                this.temp_records = [];

                for (let index = 0; index < record_length; index++) {
                    if (index != delete_index){
                        this.temp_records.push(temp_array[index]);
                    }
                }
                setTimeout(() => {
                    this.no_click_allowed = false;
                }, 500);
            },
            close_add_record(){
                this.show_addrecord = false;
                this.temp_records = [];
                this.$refs.employee_no.value = '';
                this.$refs.employee_name.value = '';
                this.$refs.department.value = '';
                this.$refs.time_in_am.value = '';
                this.$refs.time_out_am.value = '';
                this.$refs.time_in_pm.value = '';
                this.$refs.time_out_pm.value = '';
                this.$refs.account_no.value = '';
                this.$refs.no.value = '';
            },
            check_cutoff(){
                if (this.$refs.cutoff_date.value == ''){
                    this.error_message = 'Cut off date cannot be empty!';
                    this.is_blank_cutoff = true;
                    setTimeout(() => {
                        this.error_message = "";
                        this.is_blank_cutoff = false;
                    }, 2000);
                }
                else {

                    this.is_not_passed = false;
                    this.is_passed = false;
                    this.no_click_allowed = true;
                    this.is_check_cutoff = true;
                    this.allowed_upload = false;

                    let cutoff_date = this.$refs.cutoff_date.value;

                    // let form = new FormData();
                    // form.append('cutoff_date', cutoff_date);
                    let is_passed = true;
                    axios.get('/check-cutoff')
                    .then((response) => {
                        for(let i=0; i< response.data.length; i++) {
                            if (new Date(cutoff_date) <= new Date(response.data[i].cutoff_date)){
                                is_passed = false;
                                break;
                            }
                        }

                        // 'allowed_upload': false,
                        // 'no_click_allowed': false,
                        // 'is_check_cutoff': false,
                        // 'is_passed': false,
                        // '': false,

                        if (is_passed){
                            this.allowed_upload = true;
                            this.no_click_allowed = false;
                            this.is_check_cutoff = false;
                            this.is_not_passed = false;
                            this.is_passed = true;

                        }
                        else {
                            this.allowed_upload = false;
                            this.is_not_passed = true;
                            this.is_check_cutoff = false;
                            this.no_click_allowed = false;
                        }
                    });
                }
                // this.allowed_upload = true;
            },
            date_formatter(date_input){
                // const MONTH_SHORT_NAMES = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                // var time_series = [];
                // for(var i=0; i < date_input.length; i++) {
                //     var date_object = new Date(date_input[i]);
                //     var month = date_object.getMonth();
                //     var day = date_object.getDate();
                //     var year = date_object.getFullYear();

                //     if (day.toString().length < 2)
                //         day = '0' + day;

                //     //time_series[i] = (MONTH_SHORT_NAMES[month]+'-'+day+'-'+ year);
                //     time_series[i] = (MONTH_SHORT_NAMES[month]+' '+day+' '+ year);
                // }
                return new Date(date_input);
            },

            'employees': @json($employees),
            'filtered_employees': [],
            'click_emp': false,
            'search_emp': false,
            'message': '',
            show_suggestion(){
                this.filtered_employees = [];
                var emp = @json($employees);
                var index = 0;
                for (const key in emp) {
                    if (Object.hasOwnProperty.call(emp, key)) {
                        const emp_record = ((emp[key].last_name) +' '+ (emp[key].first_name) +' '+ (emp[key].middle_name)).toLowerCase();
                        const result = emp_record.toLowerCase().includes((this.$refs.employee_name.value).toLowerCase());
                        if(result){
                            this.filtered_employees[index] = emp[key];
                            index++;
                        }
                    }
                }
            },
        }));
    });
</script>
