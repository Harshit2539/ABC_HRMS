@extends('layouts.master')

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

              


                <div class="content" >
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

                                            <template v-if="!grosstotext">
                                                <span class="component-item-value">
                                                    @{{ grossTotal }}
                                                    <i class="fa fa-pencil" aria-hidden="true" @click="toggleEdit" style="margin-left: 5px; cursor: pointer;"></i>
                                                </span>
                                                </template>
                                                <template v-else>
                                                <span class="component-item-value" style="display: inline-flex; align-items: center;">
                                                    <input type="text" v-model="grossTotal"  style="width: 60px; margin-right: 5px;" />
                                                    <i class="fa fa-floppy-o" aria-hidden="true" @click = "calculateDetails"  style="cursor: pointer;"></i>
                                                </span>
                                            </template>


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

                        <div class="action-buttons">
                            <!-- <button class="btn btn-primary">Preview Payslip</button> -->
                            <button class="btn btn-secondary" @click = "saveSalary">Save Salary</button>
                            <!-- <button class="btn btn-primary">Process Payroll</button> -->
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


<script>

    var app = new Vue({
        el: '#employeesalary',
        components: {
        },
        data: {
            is_available : @json($is_available),
            grosstotext: false,
            payroll_process_data : @json($is_available) ? @json($released_date) : "",
            employee_salary_group : @json($salary_group->salary_group_id),
            employee_id : parseInt(@json($employee_id)),
            employee_object : @json($employee_detail),
            grossTotal: @json($is_available) ? parseFloat(@json($gross_salary)) : parseInt(0.00),
            net_pay : @json($is_available) ? parseFloat(@json($in_hand_salary)) : parseInt(0.00),
            basic:@json($is_available) ? parseFloat(@json($basic)) : parseInt(0.00),
            hra : @json($is_available) ? parseFloat(@json($hra)) : parseInt(0.00),
            convience : @json($is_available) ? parseFloat(@json($convience)) : parseInt(0.00),
            bonus : @json($is_available) ? parseFloat(@json($bonus)) : parseInt(0.00),
            fixed_allowance : @json($is_available) ? parseFloat(@json($fixed_allowance), 2) : parseInt(0.00),
            total_deduction : @json($is_available) ? parseFloat(@json($total_deduction)) : parseInt(0.00),
            medical_insurance : @json($is_available) ? parseFloat(@json($medical_allowance)) : parseInt(0.00),
            pf_employer : @json($is_available) ? parseFloat(@json($pf_employer)) : parseInt(0.00),
            pf_employee : @json($is_available) ? parseFloat(@json($pf_employee)) : parseInt(0.00),
                },

        methods: {
            toggleEdit() {
                this.grosstotext = !this.grosstotext;
            },
            calculateDetails() {
                vm = this;
                axios.post('/api/calculate-components', {
                    group_id: vm.employee_salary_group,
                    gross_salary: parseInt(vm.grossTotal)
                }, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {

                    vm = this;
                    let data = response.data;

                    // Assigning API response to Vue data variables
                    vm.basic = data.basic || 0;
                    vm.hra = data.hra || 0;
                    vm.convience = data.convience || 0;
                    vm.bonus = data.bonus || 0;
                    vm.fixed_allowance = data.fixed_allowance || 0;
                    vm.medical_insurance = data.mediacl_allowance || 0;
                    vm.pf_employee = data.pf_employee || 0;
                    vm.pf_employer = data.pf_employer || 0;
                    vm.total_deduction = data.total_deduction || 0;
                    vm.net_pay = data.in_hand_salary || 0;

                    vm.grosstotext = false;

                })
                .catch(error => {
                    console.error('Error:', error);
                });

                vm.grosstotext = false;
            },
            saveSalary(){
                let vm = this;
                axios.post('/api/save-salary', {
                    employee_id: vm.employee_id,
                    group_id : vm.employee_salary_group,
                    basic : vm.basic,
                    hra : vm.hra,
                    convience_allowance : vm.convience,
                    bonus : vm.bonus,
                    fixed_allowance : vm.fixed_allowance,
                    medical_insurance : vm.medical_insurance,
                    pf_employee : vm.pf_employee,
                    pf_employer : vm.pf_employer,
                    total_deduction : vm.total_deduction,
                    gross_salary : vm.grossTotal,
                })
                .then(response => {
                    if(response.data.status == 'success'){
                        return  Swal.fire({
                                text: "Process Done",
                                icon: "success",
                                timer: 2000, 
                                showConfirmButton: false
                            });
                    }

                })
                .catch(error => {
                    console.error(error);
                    alert('Failed to save salary.');
                });
                        }
         
        },
       
        
    
        mounted() {

           
            
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

@endsection