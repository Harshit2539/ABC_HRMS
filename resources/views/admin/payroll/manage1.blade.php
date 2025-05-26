@extends('layouts.master')
<style>
    .overlayy {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
    }

    .modall {
        position: relative;
        width: 900px;
        z-index: 9999;
        margin: 0 auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 20px;
    }

    .closee {
        position: absolute;
        right: 10px;
    }

    .money-icon {
        transition: transform 0.3s ease;
        /* Smooth animation */
    }



    .create-payroll:hover+.create-payroll-message {
        display: block;
    }


    .alert {
        font-family: -apple-system, BlinkMacSystemFont, 'Roboto', 'Segoe UI', 'Oxygen-Sans', 'Ubuntu', 'Cantarell', 'Helvetica Neue', sans-serif;
        min-height: 38px;
        border-radius: 4px;
        border-left: 4px solid;
        opacity: 1;
        transition: opacity 0.6s;
    }

    .info {
        background: rgba(186, 208, 228, .37);
        color: #0f7f83;
        border-color: #69aeb8;
    }
    .matnonmat{
        color:red;
        font-weight:bold;
    }

</style>

@section('content')
{{-- message --}}
{!! Toastr::message() !!}





<div class="page-wrapper" id="payroll">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <span><h3 class="page-title">Payroll Manage</h3></span>
                </div>
                <div class="col-sm-6" style="place-items : self-end;">
                <h3>
                    <a :href="'{{ route('view.payslip', '') }}/' + employee_id" 
                    class="btn btn-sm btn-fill btn-primary mt-4" 
                    id="save" 
                    style="font-weight:600; margin-top:0px !important;">
                    View
                    </a>
                </h3>
                </div>


            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-12">
            <div class="alert info"><b>Note*</b><br>
                <ul>
                    <li>If you need to calculate any field, you can do the calculation and enter the resulting amount there.</li>
                </ul>
            </div>
            </div>
          
        </div>

        <div class="row g-3 align-items-end">
            <div class="col-md-2">
                <label for="type_amount" class="form-label">Amount</label>
                <input type="number" v-model.number="type_amount" class="form-control" id="type_amount" placeholder="Enter amount">
            </div>

            <div class="col-md-2">
                <label for="current_days" class="form-label">Total Days</label>
                <input type="number" v-model.number="current_days" class="form-control" id="current_days" placeholder="Total days">
            </div>

            <div class="col-md-2">
                <label for="absence_days" class="form-label">Absence Days</label>
                <input type="number" v-model.number="absence_days" class="form-control" id="absence_days" placeholder="Absence days">
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="button" @click="calculateAmount" class="btn btn-primary w-100 fw-semibold">Calculate</button>
                <button type="button" @click="resetAmount" class="btn btn-secondary w-100 fw-semibold">Reset</button>
            </div>

            <div class="col-md-3">
                <label for="amount_after_absence" class="form-label">Amount After Absence</label>
                <input type="number" v-model.number="amount_after_absence" class="form-control" id="amount_after_absence" placeholder="Final amount">
            </div>
        </div>

        <div class="row mt-5">

 
            
            <div class="col-8">

                <section class="review-section information">
                    <div class="row" style="display:contents">
                        <div class="review-header text-center">
                            <h3 class="review-title">Employee Salary Information</h3>
                            <h3>
                                <p class="text-muted"><span class="badge bg-inverse-warning">Main Salary</span></p>
                            </h3>
                        </div>
                        <div id="checkinsuccess"  class="d-none alert alert-success">Data Successfully Updated</div>
                        <div id="messagefailed"   class="d-none alert alert-danger">Something Went Wrong</div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap review-table mb-0">
                                <tbody style="font-size:small;">
                                    <tr>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Basic Salary</label>
                                                    <input type="text" v-model.number="basic_salary" class="form-control" id="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Overpayment</label>
                                                    <input type="text" v-model.number="overpayment" class="form-control" id="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Good separation bonus</label>
                                                    <input type="text" v-model.number="good_separation_bonus" class="form-control" id="name">
                                                </div>

                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="depart3">Absence</label>
                                                    <input type="text" class="form-control" id="depart3" v-model.number = "absence">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">PES separation allowance</label>
                                                    <input type="text" v-model.number="pes_separation_allowance" class="form-control" id="name">
                                                </div>
                                            </form>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section class="review-section information">
                    <div class="row" style="display:contents">
                        <div class="review-header text-center">
                            <h3>
                                <p class="text-muted"><span class="badge bg-inverse-warning">BONUSES AND OTHER CASH BENEFITS</span></p>
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap review-table mb-0">
                                <tbody style="font-size:small;">
                                    <tr>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">responsibility bonus</label>
                                                    <input type="text" v-model.number="responsibility_bonus" class="form-control" id="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">seniority bonus</label>
                                                    <input type="text" v-model.number="seniority_bonus" class="form-control" id="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Attendance bonus</label>
                                                    <input type="text" v-model.number="attendance_bonus" class="form-control" id="name">
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Performance bonus/Function compensation</label>
                                                    <input type="text" v-model.number="performance_bonus" class="form-control" id="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">cash bonus</label>
                                                    <input type="text" v-model.number="cash_bonus" class="form-control" id="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Housing allowance</label>
                                                    <input type="text" class="form-control" v-model.number="housing_allowance" id="name">
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Transport allowance</label>
                                                    <input type="text" class="form-control" v-model.number="transport_allowance" id="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Electricity</label>
                                                    <input type="text" class="form-control" v-model.number="electricity" id="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Water</label>
                                                    <input type="text" class="form-control" v-model.number="water" id="name">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section class="review-section information">
                    <div class="row" style="display:contents;">
                        <div class="review-header text-center">
                            <h3>
                                <p class="text-muted"><span class="badge bg-inverse-warning">BENEFITS IN KIND</span></p>
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap review-table mb-0">
                                <tbody style="font-size:small;">
                                    <tr>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Costs of representation</label>
                                                    <input type="text" class="form-control" v-model.number="cost_of_representation" id="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Milk bonuses</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="milk_bonus">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Dirt premium</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="dirt_premium">
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Domestic</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="domestic">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Water</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="benefit_water">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Food</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="food">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section class="review-section information">
                    <div class="row" style="display:contents;">
                        <div class="review-header text-center">
                            <h3>
                                <p class="text-muted"><span class="badge bg-inverse-warning">Others</span></p>
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap review-table mb-0">
                                <tbody style="font-size:small;"> 
                                    <tr>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">13th month</label>
                                                    <input type="text" class="form-control" v-model.number="month" id="name">
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                            <div class="form-group">
                                                    <label for="name">Leave</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="leave">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section class="review-section information">
                    <div class="row" style="display:contents;">
                        <div class="review-header text-center">
                            <h3>
                                <p class="text-muted"><span class="badge bg-inverse-warning">Deductions</span></p>
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-nowrap review-table mb-0">
                                <tbody style="font-size:small;">
                                    <tr>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Mutual</label>
                                                    <input type="text" class="form-control" v-model.number="mutual" id="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Salary Advance</label>
                                                    <input type="text" class="form-control" v-model.number="salary_advance" id="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">School Credit</label>
                                                    <input type="text" class="form-control" v-model.number="school_credit" id="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Emergency Loan</label>
                                                    <input type="text" class="form-control" v-model.number="emergency_loan" id="name">
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Ordinary P Loan</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="ordinary_p_loan">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">car_loan</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="car_loan">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Ascoma</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="ascoma">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Rolling Equipment Credit</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="rolling_equipment_credit">
                                                </div>
                                            </form>
                                        </td>

                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Salary Deduction</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="salary_deduction">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Notice due by the employee</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="notice_due_by_the_employee">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Regul IRPP 2017</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="regul_irpp_2017">
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Regul CAC 2017</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="regul_cac_2017">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>


            <div class="col-4">
                <section class="review-section information">
                    <div class="row" style="display:contents;">
                        <div class="review-header text-center">
                            <h3>
                                <p class="text-muted"><span class="badge bg-inverse-warning">Calculations</span></p>
                            </h3>
                        </div>
                        <div class="table-responsive">
                            
                            <table class="table table-bordered table-nowrap review-table mb-0">
                                <tbody style="font-size:small;">
                                    <tr>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Gross Salary</label>
                                                    <input type="text" class="form-control" id="name" :value="gross_salary" disabled>

                                                    <label for="name">Contributable Salary NP</label>
                                                    <input type="text" class="form-control" id="name" :value="contributable_salary_np" disabled>

                                                    <label for="name">Extra1</label>
                                                    <input type="text" class="form-control" id="name" v-model="extra1" disabled>

                                                    <label for="name">CAC CALCULATED</label>
                                                    <input type="text" class="form-control" id="name" v-model="cacCalculated" disabled>

                                                    <label for="name">CFC CALCULATED</label>
                                                    <input type="text" class="form-control" id="name" v-model="cfcCalculated" disabled>

                                                    <label for="name">Social</label>
                                                    <input type="text" class="form-control" id="name" v-model="social" disabled>

                                                    <label for="name">FNE</label>
                                                    <input type="text" class="form-control" id="name" v-model="FNE" disabled>
                                                  
                                                    <label for="name">ALLOC</label>
                                                    <input type="text" class="form-control" id="name" v-model="ALLOC" disabled>

                                                    <label for="name">Extra2</label>
                                                    <input type="text" class="form-control" id="name" v-model="Extra2" disabled>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    
                                                    <label for="name">Taxable Salary</label>
                                                    <input type="text" class="form-control" id="name" v-model="taxableSalary" disabled>

                                                    <label for="name">Capped Contributory Salary</label>
                                                    <input type="text" class="form-control" id="name" v-model="cappedContributorySalary" disabled>

                                                    <label for="name">IRPP CALCULATED</label>
                                                    <input type="text" class="form-control" id="name" v-model="irppCalculated" disabled>

                                                    <label for="name">TDL CALCULATED</label>
                                                    <input type="text" class="form-control" id="name" v-model="tdlCalculated" disabled>
                                                  
                                                    <label for="name">RAV CALCULATED</label>
                                                    <input type="text" class="form-control" id="name" v-model="ravCalculated" disabled>

                                                    <label for="name"> CFC</label>
                                                    <input type="text" class="form-control" id="name" v-model="CFC" disabled>

                                                    <label for="name">PVI</label>
                                                    <input type="text" class="form-control" id="name" v-model="PVI" disabled>

                                                    <label for="name">AT</label>
                                                    <input type="text" class="form-control" id="name" v-model="AT" disabled>

                                                    <label for="name">Net To Pay</label>
                                                    <input type="text" class="form-control" id="name" v-model="netToPay" disabled>

                                                </div>
                                            </form>
                                        </td>


                                    </tr> 
                                </tbody>
                            </table>
                            <button v-if = "is_available == 0" type="submit" @click="savePayslipData" class="btn btn-sm btn-fill btn-primary mt-4" id="save" style="font-weight:600; ">Save</button>
                            <button v-if = "is_available == 1" type="submit" @click="updatePayslipData" class="btn btn-sm btn-fill btn-primary mt-4" id="save" style="font-weight:600; ">Update</button>

                        </div>
                    </div>
                </section>
            </div>


        </div>


    </div>
    <!-- /Page Content -->
</div>



<!-- Main content -->


<!-- Script Code -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-select/3.10.0/vue-select.js" integrity="sha512-T3FxfGZozDaMebkyEail/ou+a9U7Q+9P1VzG3QphdjjEJVmJdyvgGszLzK1bk8UBeZHh0iyRMHHZxH6XUtY8xQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var app = new Vue({
        el: '#payroll',

        data: {
            // payslip: @json($data ?? null), // Agar data empty ho toh null pass karein
            basic_salary: @json($is_available) ? @json($data->basic_salary ?? 0) : @json($employee_basic_salary->basic_salary ?? 0),
            overpayment: @json($is_available) ? @json($data->overpayment ?? 0) : @json($employee_basic_salary->category_allowance->overpayment),
            good_separation_bonus: @json($is_available) ? @json($data->good_seperation_bonus ?? 0) : @json($employee_basic_salary->category_allowance->good_seperation_bonus),
            absence :   @json($is_available) ?  @json($data->absence ?? 0) :  @json($employee_basic_salary->category_allowance->absence),
            pes_separation_allowance:  @json($is_available) ?  @json($data->pes_seperation_allowance ?? 0) : @json($employee_basic_salary->category_allowance->pes_separation_allowance),
            responsibility_bonus: @json($is_available) ? @json($data->responsibility_bonus ?? 0) : @json($employee_basic_salary->category_allowance->responsibility_bonus),
            seniority_bonus: @json($is_available) ? @json($data->seniority_bonus ?? 0) : @json($employee_basic_salary->category_allowance->seniority_bonus),
            attendance_bonus: @json($is_available) ? @json($data->attendance_bonus ?? 0) : @json($employee_basic_salary->category_allowance->attendance_bonus),
            performance_bonus: @json($is_available) ? @json($data->performance_bonus ?? 0) : @json($employee_basic_salary->category_allowance->performance_bonus),
            cash_bonus:  @json($is_available) ?  @json($data->cash_bonus ?? 0) : @json($employee_basic_salary->category_allowance->cash_bonus),
            housing_allowance: @json($is_available) ?  @json($data->housing_allowance ?? 0) : @json($employee_basic_salary->category_allowance->housing_allowance),
            transport_allowance: @json($is_available) ? @json($data->transport_allowance ?? 0) : @json($employee_basic_salary->category_allowance->transport_allowance),
            electricity: @json($is_available) ? @json($data->electricity ?? 0) : @json($employee_basic_salary->category_allowance->electricity),
            water: @json($is_available) ? @json($data->water ?? 0) : @json($employee_basic_salary->category_allowance->water),
            cost_of_representation: @json($is_available) ? @json($data->cost_of_representation ?? 0) :  @json($employee_basic_salary->category_allowance->cost_of_representation),
            milk_bonus: @json($is_available) ? @json($data->milk_bonus ?? 0) : @json($employee_basic_salary->category_allowance->milk_bonus),
            dirt_premium: @json($is_available) ? @json($data->dirt_premium ?? 0) : @json($employee_basic_salary->category_allowance->dirt_premium),
            domestic: @json($is_available) ? @json($data->domestic ?? 0) : @json($employee_basic_salary->category_allowance->domestic),
            benefit_water: @json($is_available) ? @json($data->benefit_water ?? 0) : @json($employee_basic_salary->category_allowance->benefit_water),
            food: @json($is_available) ? @json($data->food ?? 0) : @json($employee_basic_salary->category_allowance->food),
            // taxable_salary: @json($data->basic_salary ?? 0),
            // capped_contributory_salary: @json($data->basic_salary ?? 0),
            month : @json($is_available) ?  @json($data->month ?? 0) : @json($employee_basic_salary->category_allowance->thirteen_month),
            leave : @json($is_available) ?  @json($data->hrms_leave ?? 0) : @json($employee_basic_salary->category_allowance->leave_1),

            //deduction
            mutual : @json($data->mutual ?? 0),
            salary_advance : @json($data->salary_advance ?? 0),
            school_credit : @json($data->school_credit ?? 0),
            emergency_loan : @json($data->emergency_loan ?? 0),
            ordinary_p_loan : @json($data->ordinary_p_loan ?? 0),
            car_loan : @json($data->car_loan ?? 0),
            ascoma : @json($data->ascoma ?? 0),
            rolling_equipment_credit : @json($data->rolling_equipment_credit ?? 0),
            salary_deduction : @json($data->salary_deduction ?? 0),
            notice_due_by_the_employee : @json($data->notice_due_by_the_employee ?? 0),
            regul_irpp_2017 : @json($data->regul_irpp_2017 ?? 0),
            regul_cac_2017 : @json($data->regul_cac_2017 ?? 0),
            employee_id : @json($employee_id ?? ""),
            is_available : @json($is_available),
            payslip_id : @json($data->id ?? ""),
            current_days : 0,
            type_amount : 0,
            absence_days : 0,
            amount_after_absence : 0,
        },

        methods: {

            savePayslipData(){

                vm = this;
                // if (!this.validateForm()) return;

                var formData = new FormData();
                //Main Salary 
                formData.append('basic_salary', vm.basic_salary);
                formData.append('overpayment', vm.overpayment);
                formData.append('good_seperation_bonus', vm.good_separation_bonus);
                formData.append('absence', vm.absence);
                formData.append('pes_separation_allowance', vm.pes_separation_allowance);
                formData.append('responsibility_bonus', vm.responsibility_bonus);
                formData.append('seniority_bonus', vm.seniority_bonus);
                formData.append('attendance_bonus', vm.attendance_bonus);
                formData.append('performance_bonus', vm.performance_bonus);
                formData.append('cash_bonus', vm.cash_bonus);
                formData.append('housing_allowance', vm.housing_allowance);
                formData.append('transport_allowance', vm.transport_allowance);
                formData.append('electricity', vm.electricity);
                formData.append('water', vm.water);
                formData.append('cost_of_representation', vm.cost_of_representation);
                formData.append('milk_bonus', vm.milk_bonus);
                formData.append('dirt_premium', vm.dirt_premium);

                formData.append('domestic', vm.domestic);
                formData.append('benefit_water', vm.benefit_water);
                formData.append('food', vm.food);
                formData.append('month', vm.month);
                formData.append('leave', vm.leave);
                formData.append('mutual', vm.mutual);
                formData.append('salary_advance', vm.salary_advance);
                formData.append('school_credit', vm.school_credit);
                formData.append('emergency_loan', vm.emergency_loan);
                formData.append('ordinary_p_loan', vm.ordinary_p_loan);
                formData.append('car_loan', vm.car_loan);
                formData.append('ascoma', vm.ascoma);

                formData.append('rolling_equipment_credit', vm.rolling_equipment_credit);
                formData.append('salary_deduction', vm.salary_deduction);
                formData.append('notice_due_by_the_employee', vm.notice_due_by_the_employee);
                formData.append('regul_irpp_2017', vm.regul_irpp_2017);
                formData.append('regul_cac_2017', vm.regul_cac_2017);
               
                //Tax Detail

                formData.append('gross_salary', vm.gross_salary);
                formData.append('contributable_salary_np', vm.contributable_salary_np);
                formData.append('extra1', vm.extra1);
                formData.append('cacCalculated', vm.cacCalculated);
                formData.append('cfcCalculated', vm.cfcCalculated);
                formData.append('social', vm.social);
                formData.append('FNE', vm.FNE);
                formData.append('ALLOC', vm.ALLOC);
                formData.append('Extra2', vm.Extra2);
                formData.append('taxableSalary', vm.taxableSalary);
                formData.append('cappedContributorySalary', vm.cappedContributorySalary);
                formData.append('irppCalculated', vm.irppCalculated);
                formData.append('tdlCalculated', vm.tdlCalculated);
                formData.append('ravCalculated', vm.ravCalculated);
                formData.append('CFC', vm.CFC);
                formData.append('PVI', vm.PVI);
                formData.append('AT', vm.AT);
                formData.append('netToPay', vm.netToPay);
                formData.append('employee_id', vm.employee_id);
                
                $.ajax({
                    type: "POST",
                    url: "{{ url('submit/employeePayslip')}}",
                    data: formData,
                    contentType: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                      
                        if (data.message === 'success') {
                            Swal.fire({
                                title: "Success!",
                                text: "Employee payslip submitted successfully.",
                                icon: "success",
                                timer: 2000, 
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(); 
                            });
                        }
                        else if (data.message === 'exists') {
                            Swal.fire({
                                title: "Already Exists!",
                                text: "This Employee Payslip for this month is already exists.",
                                icon: "warning",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                        else {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong. Please try again.",
                                icon: "error",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                });



            },

            updatePayslipData(){

                vm = this;

                var formData = new FormData();
                //Main Salary 
                formData.append('basic_salary', vm.basic_salary);
                formData.append('overpayment', vm.overpayment);
                formData.append('good_seperation_bonus', vm.good_separation_bonus);
                formData.append('absence', vm.absence);
                formData.append('pes_separation_allowance', vm.pes_separation_allowance);
                formData.append('responsibility_bonus', vm.responsibility_bonus);
                formData.append('seniority_bonus', vm.seniority_bonus);
                formData.append('attendance_bonus', vm.attendance_bonus);
                formData.append('performance_bonus', vm.performance_bonus);
                formData.append('cash_bonus', vm.cash_bonus);
                formData.append('housing_allowance', vm.housing_allowance);
                formData.append('transport_allowance', vm.transport_allowance);
                formData.append('electricity', vm.electricity);
                formData.append('water', vm.water);
                formData.append('cost_of_representation', vm.cost_of_representation);
                formData.append('milk_bonus', vm.milk_bonus);
                formData.append('dirt_premium', vm.dirt_premium);

                formData.append('domestic', vm.domestic);
                formData.append('benefit_water', vm.benefit_water);
                formData.append('food', vm.food);
                formData.append('month', vm.month);
                formData.append('leave', vm.leave);
                formData.append('mutual', vm.mutual);
                formData.append('salary_advance', vm.salary_advance);
                formData.append('school_credit', vm.school_credit);
                formData.append('emergency_loan', vm.emergency_loan);
                formData.append('ordinary_p_loan', vm.ordinary_p_loan);
                formData.append('car_loan', vm.car_loan);
                formData.append('ascoma', vm.ascoma);

                formData.append('rolling_equipment_credit', vm.rolling_equipment_credit);
                formData.append('salary_deduction', vm.salary_deduction);
                formData.append('notice_due_by_the_employee', vm.notice_due_by_the_employee);
                formData.append('regul_irpp_2017', vm.regul_irpp_2017);
                formData.append('regul_cac_2017', vm.regul_cac_2017);

                //Tax Detail

                formData.append('gross_salary', vm.gross_salary);
                formData.append('contributable_salary_np', vm.contributable_salary_np);
                formData.append('extra1', vm.extra1);
                formData.append('cacCalculated', vm.cacCalculated);
                formData.append('cfcCalculated', vm.cfcCalculated);
                formData.append('social', vm.social);
                formData.append('FNE', vm.FNE);
                formData.append('ALLOC', vm.ALLOC);
                formData.append('Extra2', vm.Extra2);
                formData.append('taxableSalary', vm.taxableSalary);
                formData.append('cappedContributorySalary', vm.cappedContributorySalary);
                formData.append('irppCalculated', vm.irppCalculated);
                formData.append('tdlCalculated', vm.tdlCalculated);
                formData.append('ravCalculated', vm.ravCalculated);
                formData.append('CFC', vm.CFC);
                formData.append('PVI', vm.PVI);
                formData.append('AT', vm.AT);
                formData.append('netToPay', vm.netToPay);

                $.ajax({
                    type: "POST",
                    url: "{{ url('update/employeePayslip') }}/" + vm.payslip_id ,
                    data: formData,
                    contentType: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                    
                        if (data.message === 'success') {
                            Swal.fire({
                                title: "Success!",
                                text: "Employee payslip updated successfully.",
                                icon: "success",
                                timer: 2000, 
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(); 
                            });
                        }
                        else {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong. Please try again.",
                                icon: "error",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                });
            },

            calculateAmount(){
                vm = this;
                var days = vm.current_days - vm.absence_days;
                vm.amount_after_absence = Math.floor((vm.type_amount/vm.current_days) * days);
            },
            resetAmount(){
                vm = this;
                vm.type_amount = 0;
                vm.absence_days = 0;
                vm.amount_after_absence = 0;
            },
            
        },
        computed: {
            gross_salary() {
                vm = this;
                vm.basic_salary = (vm.basic_salary == null || vm.basic_salary == "") ? 0 : vm.basic_salary;
                vm.overpayment = (vm.overpayment == null || vm.overpayment == "") ? 0 : vm.overpayment;
                vm.good_separation_bonus = (vm.good_separation_bonus == null || vm.good_separation_bonus == "") ? 0 : vm.good_separation_bonus;
                vm.pes_separation_allowance = (vm.pes_separation_allowance == null || vm.pes_separation_allowance == "") ? 0 : vm.pes_separation_allowance;
                vm.responsibility_bonus = (vm.responsibility_bonus == null || vm.responsibility_bonus == "") ? 0 : vm.responsibility_bonus;
                vm.seniority_bonus = (vm.seniority_bonus == null || vm.seniority_bonus == "") ? 0 : vm.seniority_bonus;
                vm.attendance_bonus = (vm.attendance_bonus == null || vm.attendance_bonus == "") ? 0 : vm.attendance_bonus;
                vm.performance_bonus = (vm.performance_bonus == null || vm.performance_bonus == "") ? 0 : vm.performance_bonus;
                vm.cash_bonus = (vm.cash_bonus == null || vm.cash_bonus == "") ? 0 : vm.cash_bonus;
                vm.housing_allowance = (vm.housing_allowance == null || vm.housing_allowance == "") ? 0 : vm.housing_allowance;
                vm.transport_allowance = (vm.transport_allowance == null || vm.transport_allowance == "") ? 0 : vm.transport_allowance;
                vm.electricity = (vm.electricity == null || vm.electricity == "") ? 0 : vm.electricity;
                vm.water = (vm.water == null || vm.water == "") ? 0 : vm.water;
                vm.cost_of_representation = (vm.cost_of_representation == null || vm.cost_of_representation == "") ? 0 : vm.cost_of_representation;
                vm.milk_bonus = (vm.milk_bonus == null || vm.milk_bonus == "") ? 0 : vm.milk_bonus;
                vm.dirt_premium = (vm.dirt_premium == null || vm.dirt_premium == "") ? 0 : vm.dirt_premium;
                vm.domestic = (vm.domestic == null || vm.domestic == "") ? 0 : vm.domestic;
                vm.benefit_water = (vm.benefit_water == null || vm.benefit_water == "") ? 0 : vm.benefit_water;
                vm.food = (vm.food == null || vm.food == "") ? 0 : vm.food;
                vm.month = (vm.month == null || vm.month == "") ? 0 : vm.month;
                vm.leave = (vm.leave == null || vm.leave == "") ? 0 : vm.leave;
                vm.absence = (vm.absence == null || vm.absence == "") ? 0 : vm.absence;

                return (
                    // vm.basic_salary + vm.overpayment + vm.good_separation_bonus + vm.pes_separation_allowance - vm.absence + vm.responsibility_bonus +
                    vm.basic_salary + vm.overpayment + vm.good_separation_bonus + vm.pes_separation_allowance  + vm.responsibility_bonus +
                    vm.seniority_bonus + vm.attendance_bonus + vm.performance_bonus + vm.cash_bonus + vm.housing_allowance + vm.transport_allowance +
                    vm.electricity + vm.water + vm.cost_of_representation + vm.milk_bonus + vm.dirt_premium + vm.domestic + vm.benefit_water +
                    vm.food + vm.month + vm.leave
                );
            },
            contributable_salary_np(){
                vm =this;

                return (
                    vm.basic_salary + vm.overpayment  + vm.pes_separation_allowance  + vm.responsibility_bonus + vm.seniority_bonus +
                    vm.attendance_bonus + vm.performance_bonus + vm.cash_bonus + vm.housing_allowance + vm.electricity + vm.water + 
                    vm.domestic + vm.month + vm.leave
                );

            },
            cappedContributorySalary() {
                vm = this;
                return vm.contributable_salary_np >= 750000 ? 750000 : vm.contributable_salary_np;
            },
            social() {
                vm = this;
                return Math.round((vm.cappedContributorySalary * 4.2) / 100); // Calculating 4.2%
            },
            taxableSalary() {
                let baseSalarySum =
                this.basic_salary +
                this.overpayment +
                this.good_separation_bonus +
                this.pes_separation_allowance +
                // this.absence +
                this.responsibility_bonus +
                this.seniority_bonus +
                this.attendance_bonus +
                this.performance_bonus +
                this.cash_bonus;

                let fullSalary = baseSalarySum + this.transport_allowance + this.month;

                let housing =
                    fullSalary * 0.15 > this.housing_allowance
                    ? this.housing_allowance
                    : fullSalary * 0.15;

                let domesticAllowance =
                    fullSalary * 0.05 > this.domestic ? this.domestic : fullSalary * 0.05;

                let electricityAllowance =
                    fullSalary * 0.04 > this.electricity
                    ? this.electricity
                    : fullSalary * 0.04;

                let waterAllowance =
                    fullSalary * 0.02 > this.water ? this.water : fullSalary * 0.02;

                    let totalSalary =
                    baseSalarySum +
                    housing +
                    domesticAllowance +
                    electricityAllowance +
                    waterAllowance +
                    this.transport_allowance +
                    this.leave;

                return Math.round(totalSalary); // Round to nearest whole number
            },
            extra1() {
                vm = this;
                return Math.round(vm.taxableSalary * 0.7 - vm.social - 41667);
            },
            irppCalculated() {
                if (this.taxableSalary >= 62004) {
                if (this.extra1 >= 166667) {
                    return Math.round(
                    166667 * 0.1 +
                    (this.extra1 >= 250000
                        ? 83333 * 0.15 +
                        (this.extra1 >= 416667
                            ? 166667 * 0.25 + (this.extra1 - 416667) * 0.35
                            : (this.extra1 - 250000) * 0.25)
                        : (this.extra1 - 166667) * 0.15)
                    );
                } else {
                    return Math.round(this.extra1 * 0.1);
                }
                }
                return 0;
            },
            cacCalculated() {
                return Math.round(this.irppCalculated * 0.1);
            },
            tdlCalculated() {
                const salary = this.basic_salary; // Basic salary ko variable mein store karna
                if (salary < 62000) return 0;
                else if (salary < 75001) return 250;
                else if (salary < 100001) return 500;
                else if (salary < 125001) return 750;
                else if (salary < 150001) return 1000;
                else if (salary < 200001) return 1250;
                else if (salary < 300001) return 2000;
                else if (salary < 500001) return 2250;
                else return 2500;
            },
            cfcCalculated() {
                return this.taxableSalary ? Math.round(this.taxableSalary * 0.01) : 0;
            },
            ravCalculated() {
                const salary = this.taxableSalary || 0;
                if (salary < 50001) return 0;
                if (salary < 100001) return 750;
                if (salary < 200001) return 1950;
                if (salary < 300001) return 3250;
                if (salary < 400001) return 4550;
                if (salary < 500001) return 5850;
                if (salary < 600001) return 7150;
                if (salary < 700001) return 8450;
                if (salary < 800001) return 9750;
                if (salary < 900001) return 11050;
                if (salary < 1000001) return 12350;
                return 13000;
            },
            CFC() {
                return Math.floor((this.gross_salary || 0) * 0.015);
            },
            FNE() {
                return Math.round((this.gross_salary || 0) * 0.01);
            },
            PVI() {
                return Math.floor((this.cappedContributorySalary || 0) * 0.042);
            },
            ALLOC() {
                return Math.floor((this.cappedContributorySalary || 0) * 0.07);
            },
            AT() {
                return Math.floor((this.contributable_salary_np || 0) * 0.0175);
            },
            Extra2() {
                return Math.floor((this.CFC || 0) + (this.FNE || 0) + (this.PVI || 0) + (this.ALLOC || 0) + (this.AT || 0));
            },
            netToPay() {
                return Math.floor(
                (this.gross_salary || 0) -
                (this.mutual || 0) -
                (this.social || 0) -
                (this.ravCalculated || 0) -
                (this.cfcCalculated || 0) -
                (this.tdlCalculated || 0) -
                (this.cacCalculated || 0) -
                (this.irppCalculated || 0) -
                (this.salary_advance || 0) -
                (this.school_credit || 0) -
                (this.emergency_loan || 0) -
                (this.ordinary_p_loan || 0) -
                (this.car_loan || 0) -
                (this.ascoma || 0) -
                (this.rolling_equipment_credit || 0) -
                (this.salary_deduction || 0) -
                (this.notice_due_by_the_employee || 0) +
                (this.regul_irpp_2017 || 0) +
                (this.regul_cac_2017 || 0)
                ) - 4;
            }
        },
        mounted(){
            const now = new Date();
            this.current_days = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();
        },
        watch :  {
                absence(newVal) {
                    vm = this;
                    var days = vm.current_days - newVal;

                    //basic salary after absence
                    var basic_salary = @json($employee_basic_salary->basic_salary);
                    vm.basic_salary = Math.round((basic_salary/vm.current_days) * days);

                    //overpayment after absence
                    var overpayment = @json($employee_basic_salary->category_allowance->overpayment);
                    vm.overpayment = Math.round((overpayment/vm.current_days) * days);

                    //good seperation bonus after absence
                     var good_separation_bonus = @json($employee_basic_salary->category_allowance->good_seperation_bonus);
                     vm.good_separation_bonus = Math.round((good_separation_bonus/vm.current_days) * days);
                
                    //pes separation allowance after absence
                    var pes_separation_allowance = @json($employee_basic_salary->category_allowance->pes_separation_allowance);
                    vm.pes_separation_allowance = Math.round((pes_separation_allowance/vm.current_days) * days);

                    //responsibility_bonus after absence
                    var responsibility_bonus = @json($employee_basic_salary->category_allowance->responsibility_bonus);
                    vm.responsibility_bonus = Math.round((responsibility_bonus/vm.current_days) * days);

                    //seniority_bonus after absence
                    var seniority_bonus = @json($employee_basic_salary->category_allowance->seniority_bonus);
                    vm.seniority_bonus = Math.round((seniority_bonus/vm.current_days) * days);

                    //attendance_bonus after absence
                    var attendance_bonus = @json($employee_basic_salary->category_allowance->attendance_bonus);
                    vm.attendance_bonus = Math.round((attendance_bonus/vm.current_days) * days);

                    //performance_bonus after absence
                    var performance_bonus = @json($employee_basic_salary->category_allowance->performance_bonus);
                    vm.performance_bonus = Math.round((performance_bonus/vm.current_days) * days);

                    //cash_bonus after absence
                    var cash_bonus = @json($employee_basic_salary->category_allowance->cash_bonus);
                    vm.cash_bonus = Math.round((cash_bonus/vm.current_days) * days);

                    //housing_allowance after absence
                    var housing_allowance = @json($employee_basic_salary->category_allowance->housing_allowance);
                    vm.housing_allowance = Math.round((housing_allowance/vm.current_days) * days);

                    //transport_allowance after absence
                    var transport_allowance = @json($employee_basic_salary->category_allowance->transport_allowance);
                    vm.transport_allowance = Math.round((transport_allowance/vm.current_days) * days);

                    //electricity after absence
                    var electricity = @json($employee_basic_salary->category_allowance->electricity);
                    vm.electricity = Math.round((electricity/vm.current_days) * days);

                    //water after absence
                    var water = @json($employee_basic_salary->category_allowance->water);
                    vm.water = Math.round((water/vm.current_days) * days);

                    //cost_of_representation after absence
                    var cost_of_representation = @json($employee_basic_salary->category_allowance->cost_of_representation);
                    vm.cost_of_representation = Math.round((cost_of_representation/vm.current_days) * days);

                    //milk_bonus after absence
                    var milk_bonus = @json($employee_basic_salary->category_allowance->milk_bonus);
                    vm.milk_bonus = Math.round((milk_bonus/vm.current_days) * days);

                    //dirt_premium after absence
                    var dirt_premium = @json($employee_basic_salary->category_allowance->dirt_premium);
                    vm.dirt_premium = Math.round((dirt_premium/vm.current_days) * days);

                    //domestic after absence
                    var domestic = @json($employee_basic_salary->category_allowance->domestic);
                    vm.domestic = Math.round((domestic/vm.current_days) * days);

                    //benefit_water after absence
                    var benefit_water = @json($employee_basic_salary->category_allowance->benefit_water);
                    vm.benefit_water = Math.round((benefit_water/vm.current_days) * days);
                    
                    //food after absence
                    var food = @json($employee_basic_salary->category_allowance->food);
                    vm.food = Math.round((food/vm.current_days) * days);

                
                    
                },

        }


    })
</script>



@endsection