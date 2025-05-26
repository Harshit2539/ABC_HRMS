@extends('layouts.master')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<style>
    .nav-item {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        color: #333;
        text-decoration: none;
        position: relative;
    }

    .nav-item:hover {
        color: #e01e5a;
    }

    .nav-item.has-dropdown:after {
        content: "▼";
        font-size: 0.5rem;
        margin-left: 0.25rem;
        vertical-align: middle;
    }

    .icon-button {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 0.5rem;
        border-radius: 4px;
        color: #666;
    }

    .icon-button:hover {
        background-color: #f5f5f5;
    }

    .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #e01e5a;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-left: 0.5rem;
    }

    .breadcrumb {
        padding: 0.75rem 1rem;
        font-size: 0.75rem;
        color: #666;
        background-color: #f8f8f8;
    }

    .breadcrumb a {
        color: #666;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

  


    .page-description {
        font-size: 0.75rem;
        color: #444;
        line-height: 1.4;
    }

   

    .content {
        padding: 1rem;
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1rem;
    }

    .employee-section {
        background-color: white;
        border-radius: 4px;
        padding: 1rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .employee-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .employee-type {
        font-size: 0.75rem;
        color: #666;
        margin-right: 1rem;
        width: 120px;
    }

  
   

 

    .payroll-processed {
        font-size: 0.75rem;
        color: #666;
        margin-bottom: 1rem;
    }

    .component-group {
        background-color: #f5f7fa;
        padding: 0.5rem;
        border-radius: 4px;
        margin-bottom: 1rem;
    }

    .component-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .component-title {
        font-size: 0.75rem;
        color: #666;
    }

    .component-expand {
        font-size: 0.75rem;
        color: #0066cc;
        text-decoration: none;
    }

   

   

    .component-items {
        list-style: none;
    }

    .component-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem;
        border-bottom: 1px solid #eee;
        font-size: 0.75rem;
        cursor: pointer;
    }

    .component-item:last-child {
        border-bottom: none;
    }

    .component-item-checkbox {
        margin-right: 0.5rem;
    }

    .component-item-expand {
        margin-right: 0.5rem;
        width: 16px;
        height: 16px;
        text-align: center;
        line-height: 14px;
        border-radius: 2px;
        font-size: 14px;
        color: #666;
        background-color: #eee;
        display: inline-block;
    }

    .sub-items {
        margin-left: 20px;
        display: none;
    }

    .sub-items.show {
        display: block;
    }

    .component-item-name {
        flex-grow: 1;
    }

    .component-item-value {
        text-align: right;
        font-weight: 500;
    }

    .details-section {
        background-color: white;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .details-header {
        padding: 1rem;
        border-bottom: 1px solid #eee;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .details-content {
        padding: 1rem;
    }

    .details-item {
        margin-bottom: 1rem;
    }

    .details-label {
        font-size: 0.75rem;
        color: #666;
        margin-bottom: 0.25rem;
    }

    .details-value {
        font-size: 0.875rem;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-size: 0.875rem;
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        background-color: #7c13dc;
        color: white;
    }

    .btn-secondary {
        background-color: white;
        color: #333;
        border: 1px solid #ccc;
    }

    .filter-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 1rem;
    }

    .filter-dropdown {
        display: inline-flex;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 0.5rem;
        font-size: 0.75rem;
        background-color: white;
        margin-left: 0.5rem;
    }

    .filter-dropdown-icon {
        margin-right: 0.5rem;
    }

    .filter-dropdown:after {
        content: "▼";
        font-size: 0.5rem;
        margin-left: 0.5rem;
    }



    .top-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .download-btn {
        display: flex;
        align-items: center;
        background-color: #2ecc71;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.6rem 1rem;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .download-btn:hover {
        background-color: #27ae60;
    }

    .download-icon {
        margin-right: 0.5rem;
    }


    .month-year-selector {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: white;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        margin-bottom: 1rem;
    }
    
    .month-year-title {
        display: flex;
        align-items: center;
        font-size: 1rem;
        font-weight: 500;
    }
    
    .month-year-title svg {
        margin-right: 0.5rem;
        color: #7c13dc;
    }
    
    .month-year-dropdown {
        position: relative;
        display: inline-block;
    }
    
    .month-year-dropdown select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #f5f7fa;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 0.5rem 2rem 0.5rem 1rem;
        font-size: 0.875rem;
        cursor: pointer;
        min-width: 160px;
    }
    
    .month-year-dropdown::after {
        content: "▼";
        font-size: 0.7rem;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #666;
    }

   
</style>
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid mt-4">
            <div class="row" id = "employeesalary">
                <div class="col-12">


                    <!-- Breadcrumb -->
                    <div class="breadcrumb">
                        <a href="#">Home</a> > <a href="#">Payroll</a> > Salary
                    </div>

                




        <!-- Month Year Dropdown -->
                    <div class="month-year-selector">
                        <div class="month-year-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>Select Pay Period</span>
                        </div>
                           <div class="col-sm-4">
 
                        
 
                         <!-- <a href="javascript:void(0)" id="exportPayslipExcel">
                            <button type="button" class="btn btn-primary"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Payslip Excel</button>
                        </a> -->
 
                        </div>
                     
                        <div class="month-year-dropdown">
                               <a href="javascript:void(0)" id="exportPaySlipBtn">
                            <button type="button" class="btn btn-danger" ><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
                        </a>
                            <select v-model="selectedMonthYear" @change="handleMonthYearChange">
                                <option v-for="option in monthYearOptions" :key="option.value" :value="option.value">
                                    @{{ option.label }}
                                </option>
                            </select>
                        </div>
                    </div>






                    <div class="content" v-if="is_available">
                        <div class="employee-section">
                            <div class="d-flex" style="justify-content:space-between">
                            <div class="employee-header">
                                <div class="employee-type">Employee Type:<br>@{{employee_object.first_name }} @{{employee_object.last_name}}</div>
                            </div>

                            <div class="payroll-processed">
                                Payroll Processed On:<br>
                                @{{payroll_process_data}}
                            </div>

                            </div>
                        

                            <div class="component-group">
                                <div class="component-header">
                                    <div class="component-title">Component Group ℹ️</div>
                                    <a href="#" class="component-expand">Collapse All</a>
                                </div>
                            

                                <ul class="component-items">
                                    <li>
                                        <div class="component-item">
                                            <div>
                                                <span class="component-item-expand">-</span>
                                                <input type="checkbox" class="component-item-checkbox">
                                                <span class="component-item-name">Net Pay</span>
                                            </div>
                                            <span class="component-item-value">@{{net_pay}}</span>
                                        </div>
                                        <ul class="sub-items show">
                                            <li class="component-item">
                                                <div>
                                                    <span class="component-item-expand">-</span>
                                                    <span class="component-item-name">Gross</span>
                                                </div>

                                                <span class="component-item-value">
                                                        @{{ grossTotal }}
                                                    </span>


                                            </li>
                                            <ul class="sub-items show" style="margin-left: 40px;">
                                                <li class="component-item">
                                                    <div>
                                                        <span class="component-item-name">Basic</span>
                                                    </div>
                                                    <span class="component-item-value">
                                                        @{{ basic }}
                                                    </span>
                                                </li>
                                                <li class="component-item">
                                                    <div>
                                                        <span class="component-item-name">HRA</span>
                                                    </div>
                                                    <span class="component-item-value">@{{hra}}</span>
                                                </li>
                                                <li class="component-item">
                                                    <div>
                                                        <span class="component-item-name">Conveyance</span>
                                                    </div>
                                                    <span class="component-item-value">@{{convience}}</span>
                                                </li>
                                                <li class="component-item">
                                                    <div>
                                                        <span class="component-item-name">Bonus</span>
                                                    </div>
                                                    <span class="component-item-value">@{{bonus}}</span>
                                                </li>
                                                <li class="component-item">
                                                    <div>
                                                        <span class="component-item-name">Fixed Allowance</span>
                                                    </div>
                                                    <span class="component-item-value">@{{fixed_allowance}}</span>
                                                </li>
                                            </ul>
                                            <li class="component-item">
                                                <div>
                                                    <span class="component-item-expand">-</span>
                                                    <span class="component-item-name">Total Deduction</span>
                                                </div>
                                                <span class="component-item-value">@{{total_deduction}}</span>
                                            </li>
                                            <ul class="sub-items show" style="margin-left: 40px;">
                                                <li class="component-item">
                                                    <div>
                                                        <span class="component-item-name">Medical Insurance</span>
                                                    </div>
                                                    <span class="component-item-value">@{{medical_insurance}}</span>
                                                </li>
                                                <li class="component-item">
                                                    <div>
                                                        <span class="component-item-name">PF Employer</span>
                                                    </div>
                                                    <span class="component-item-value">@{{pf_employer}}</span>
                                                </li>
                                                <li class="component-item">
                                                    <div>
                                                        <span class="component-item-name">PF Employee</span>
                                                    </div>
                                                    <span class="component-item-value">@{{pf_employee}}</span>
                                                </li>
                                            </ul>
                                            <li class="component-item">
                                                <div>
                                                    <span class="component-item-expand">+</span>
                                                    <span class="component-item-name">Salary Master</span>
                                                </div>
                                                <span class="component-item-value">0.00</span>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="component-item">
                                            <div>
                                                <span class="component-item-expand">-</span>
                                                <input type="checkbox" class="component-item-checkbox">
                                                <span class="component-item-name">Calculation Fields</span>
                                            </div>
                                            <span class="component-item-value">0.00</span>
                                        </div>
                                        <ul class="sub-items show">
                                            <li class="component-item">
                                                <div>
                                                    <span class="component-item-expand">+</span>
                                                    <span class="component-item-name">Gross</span>
                                                </div>
                                                <span class="component-item-value">0.00</span>
                                            </li>
                                            <li class="component-item">
                                                <div>
                                                    <span class="component-item-expand">+</span>
                                                    <span class="component-item-name">Total Deduction</span>
                                                </div>
                                                <span class="component-item-value">0.00</span>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        
                        </div>

                        <div class="details-section">
                            <div class="details-header">Details</div>
                            <div class="details-content">
                                <div class="details-item">
                                    <div class="details-label">Employee</div>
                                    <div class="details-value">@{{employee_object.first_name }} &nbsp; @{{employee_object.last_name}}</div>
                                </div>
                                <div class="details-item">
                                    <div class="details-label">Join Date</div>
                                    <div class="details-value">@{{employee_object.joined_date }}</div>
                                </div>
                                <div class="details-item">
                                    <div class="details-label">Date Of Birth</div>
                                    <div class="details-value">@{{employee_object.birthday }}</div>
                                </div>
                                <div class="details-item">
                                    <div class="details-label">Location</div>
                                    <div class="details-value">-</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="{{ URL::to('assets/js/axios.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

    var app = new Vue({
        el: '#employeesalary',
        components: {
        },
        data: {
            payroll_process_date : @json($released_date),
            employee_id : parseInt(@json($employee_id)),
            employee_object : @json($employee_object),
            grossTotal: parseFloat(@json($gross_salary)),
            net_pay : parseFloat(@json($in_hand_salary)),
            basic: parseFloat(@json($basic)),
            hra :  parseFloat(@json($hra)),
            convience : parseFloat(@json($convience)) ,
            bonus :  parseFloat(@json($bonus)) ,
            fixed_allowance : parseFloat(@json($fixed_allowance), 2),
            total_deduction :  parseFloat(@json($total_deduction)) ,
            medical_insurance :  parseFloat(@json($medical_insurance)),
            pf_employer :  parseFloat(@json($pf_employer)),
            pf_employee :  parseFloat(@json($pf_employee)),
            is_available : @json($is_available),

            currentDate: new Date(),
            selectedMonthYear: '', // Format: 'YYYY-MM'
            monthYearOptions: [],
            monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
                },

            methods: {
                    generateMonthYearOptions() {
                        const options = [];
                        const currentDate = new Date();
                        const currentYear = currentDate.getFullYear();
                        const currentMonth = currentDate.getMonth() + 1; // JavaScript months are 0-indexed
                        
                        // Generate options for the last 24 months
                        for (let i = 0; i < 24; i++) {
                            let year = currentYear;
                            let month = currentMonth - i;
                            
                            while (month <= 0) {
                                month += 12;
                                year--;
                            }
                            
                            const value = `${year}-${String(month).padStart(2, '0')}`;
                            const label = `${this.monthNames[month - 1]} ${year}`;
                            
                            options.push({ value, label });
                        }
                        
                        return options;
                    },
            
                    handleMonthYearChange() {
                        vm = this;
                        const selectedDate = vm.selectedMonthYear;

                        axios.post('filter-salary/pay-period', {
                            date: selectedDate,
                        })
                        .then(response => {
                            // Response handle karein yahan
                            vm.is_available = response.data.is_available;
                            vm.payroll_process_date  =  response.data.released_date;
                            vm.grossTotal = parseFloat(response.data.gross_salary);
                            vm.net_pay = parseFloat(response.data.in_hand_salary);
                            vm.basic = parseFloat(response.data.basic);
                            vm.hra =  parseFloat(response.data.hra);
                            vm.convience = parseFloat(response.data.convience);
                            vm.bonus =  parseFloat(response.data.bonus);
                            vm.fixed_allowance = parseFloat(response.data.fixed_allowance, 2);
                            vm.total_deduction =  parseFloat(response.data.total_deduction);
                            vm.medical_insurance =  parseFloat(response.data.medical_insurance);
                            vm.pf_employer =  parseFloat(response.data.pf_employer);
                            vm.pf_employee =  parseFloat(response.data.pf_employee);
                        })
                        .catch(error => {
                            console.error('Error fetching salary data:', error);
                        });
                    }
            },
       
        
    
        mounted() {
            // Initialize the month-year options and set default selection to current month
            this.monthYearOptions = this.generateMonthYearOptions();
            if (this.monthYearOptions.length > 0) {
                this.selectedMonthYear = this.monthYearOptions[0].value;
            }
        },

        computed: {
            selectedMonthYearFormatted() {
                if (!this.selectedMonthYear) return '';
                
                const [year, month] = this.selectedMonthYear.split('-');
                return `${this.monthNames[parseInt(month) - 1]} ${year}`;
            }
        },
        watch: {
         
        }
    })
</script>











<script>
document.addEventListener('DOMContentLoaded', function() {
    const expandButtons = document.querySelectorAll('.component-item-expand');
    
    expandButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent the click from bubbling up
            
            // Toggle the button text between + and -
            this.textContent = this.textContent === '+' ? '-' : '+';
            
            // Find the closest parent component-item
            const parentItem = this.closest('li');
            
            // Find the sub-items list within this parent
            const subItems = parentItem.querySelector('.sub-items');
            
            // If there are subitems, toggle their visibility
            if (subItems) {
                subItems.classList.toggle('show');
            }
        });
    });
    
    // Add click event to entire component item for better UX
    const componentItems = document.querySelectorAll('.component-item');
    componentItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Only handle the click if it wasn't on a checkbox
            if (!e.target.classList.contains('component-item-checkbox')) {
                const expandButton = this.querySelector('.component-item-expand');
                if (expandButton) {
                    expandButton.click();
                }
            }
        });
    });
    
    // Expand All button functionality - now "Collapse All" by default since everything starts expanded
    const expandAllButton = document.querySelector('.component-expand');
    if (expandAllButton) {
        expandAllButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Toggle between Expand All and Collapse All
            const isCollapsing = this.textContent === 'Collapse All';
            this.textContent = isCollapsing ? 'Expand All' : 'Collapse All';
            
            // Get all main items (not sub-items)
            const mainItems = document.querySelectorAll('.component-items > li > .component-item');
            
            mainItems.forEach(item => {
                const expandButton = item.querySelector('.component-item-expand');
                const subItems = item.parentElement.querySelector('.sub-items');
                
                if (expandButton && subItems) {
                    // Set the expand button to + or - depending on action
                    expandButton.textContent = isCollapsing ? '+' : '-';
                    
                    // Show or hide the sub-items
                    if (isCollapsing) {
                        subItems.classList.remove('show');
                    } else {
                        subItems.classList.add('show');
                    }
                }
            });
        });
    }
});
</script>


<script>
 
 
 
 
   $('#exportPaySlipBtn').on('click', function () {
 
   let selectedMonth = $('#start').val();
 
 
        if (!selectedMonth) {
            let currentDate = new Date();
            selectedMonth = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2);
        }
 
 
        $.ajax({
            url: "{{ route('employees.payslip.pdf') }}",
            type: "GET",
            data: { month: selectedMonth },
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response) {
 
               var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "payslip_" + selectedMonth + ".pdf";
                link.click();
            },
            error: function (xhr, status, error) {
                console.error("Error exporting payslip:", error);
                toastr.error("Failed to export payslip. Please try again OR May be data not found");
            }
        });
 
 
       // window.location.href = "{{ route('employees.payslip.pdf') }}?month=" + selectedMonth;
 
    });
 
 
 
  $('#exportPayslipExcel').on('click', function () {
 
 
     let selectedMonth = $('#start').val();
 
        if (!selectedMonth) {
            let currentDate = new Date();
            selectedMonth = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2);
        }
 
     
        $.ajax({
            url: "{{ route('payslip-excel.export') }}",
            type: "GET",
            data: { month: selectedMonth },
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response) {
 
                let blob = new Blob([response], { type: 'application/vnd.ms-excel' });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "payslip_" + selectedMonth + ".xlsx";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function (xhr, status, error) {
                console.error("Error exporting payslip:", error);
                toastr.error("Failed to export payslip. Please try again OR May be data not found");
            }
        });
    });
 

</script>
 

@endsection