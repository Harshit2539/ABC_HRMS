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
</style>

<style>
        .custom-month-picker {
            position: relative;
            display: inline-block;
            width: 250px;
        }
        .custom-month-picker input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #4CAF50;
            background: #f9f9f9;
            font-size: 16px;
            transition: 0.3s;
        }
        .custom-month-picker input:focus {
            outline: none;
            border-color: #2e8b57;
            background: #fff;
            box-shadow: 0 0 10px rgba(46, 139, 87, 0.2);
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
                <div class="col-sm-12 d-flex" style="justify-content:space-between">
                    <span>
                        <h3 class="page-title">Payslip Detail</h3>
                    </span>
                    <span>
                        <label for="start" class="form-label fw-bold">Select Month:</label>
                        <div class="custom-month-picker">
                            <input class="form-control" type="month" id="start" name="start" v-model="filterSalary" min="2018-03" value="2018-05">
                        </div>
                        <button style="position:relative; bottom:0.8rem;" class="btn btn-primary mt-4" @click="fetchPayslip">Submit</button>
                    </span>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
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
                                                    <!-- @{{basic_salary}} -->
                                                    <input type="text" v-model.number="basic_salary" class="form-control" id="name" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Overpayment</label>
                                                    <input type="text" v-model.number="overpayment" class="form-control" id="name" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Good separation bonus</label>
                                                    <input type="text" v-model.number="good_separation_bonus" class="form-control" id="name" disabled>
                                                </div>

                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="depart3">Absence</label>
                                                    <input type="text" class="form-control" id="depart3" v-model.number = "absence" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">PES separation allowance</label>
                                                    <input type="text" v-model.number="pes_separation_allowance" class="form-control" id="name" disabled>
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
                                                    <input type="text" v-model.number="responsibility_bonus" class="form-control" id="name" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">seniority bonus</label>
                                                    <input type="text" v-model.number="seniority_bonus" class="form-control" id="name" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Attendance bonus</label>
                                                    <input type="text" v-model.number="attendance_bonus" class="form-control" id="name" disabled>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Performance bonus/Function compensation</label>
                                                    <input type="text" v-model.number="performance_bonus" class="form-control" id="name" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">cash bonus</label>
                                                    <input type="text" v-model.number="cash_bonus" class="form-control" id="name" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Housing allowance</label>
                                                    <input type="text" class="form-control" v-model.number="housing_allowance" id="name" disabled>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Transport allowance</label>
                                                    <input type="text" class="form-control" v-model.number="transport_allowance" id="name" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Electricity</label>
                                                    <input type="text" class="form-control" v-model.number="electricity" id="name" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Water</label>
                                                    <input type="text" class="form-control" v-model.number="water" id="name" disabled>
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
                                                    <input type="text" class="form-control" v-model.number="cost_of_representation" id="name" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Milk bonuses</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="milk_bonus" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Dirt premium</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="dirt_premium" disabled>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Domestic</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="domestic" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Water</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="benefit_water" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Food</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="food" disabled>
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
                                                    <input type="text" class="form-control" v-model.number="month" id="name" disabled>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                            <div class="form-group">
                                                    <label for="name">Leave</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="leave" disabled>
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
                                                    <input type="text" class="form-control" v-model.number="mutual" id="name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Salary Advance</label>
                                                    <input type="text" class="form-control" v-model.number="salary_advance" id="name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">School Credit</label>
                                                    <input type="text" class="form-control" v-model.number="school_credit" id="name" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Emergency Loan</label>
                                                    <input type="text" class="form-control" v-model.number="emergency_loan" id="name" disabled>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Ordinary P Loan</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="ordinary_p_loan" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">car_loan</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="car_loan" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Ascoma</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="ascoma" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Rolling Equipment Credit</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="rolling_equipment_credit" disabled>
                                                </div>
                                            </form>
                                        </td>

                                        <td>
                                            <form>
                                                <div class="form-group">
                                                    <label for="name">Salary Deduction</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="salary_deduction" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Notice due by the employee</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="notice_due_by_the_employee" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Regul IRPP 2017</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="regul_irpp_2017" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Regul CAC 2017</label>
                                                    <input type="text" class="form-control" id="name" v-model.number="regul_cac_2017" disabled>
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
                                                    <input type="text" class="form-control" id="name" v-model="gross_salary" disabled>

                                                    <label for="name">Contributable Salary NP</label>
                                                    <input type="text" class="form-control" id="name" v-model="contributable_salary_np" disabled>

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
<script src="
https://cdn.jsdelivr.net/npm/axios@1.7.9/dist/axios.min.js
"></script>
<script>
    var app = new Vue({
        el: '#payroll',
        data: {
            // payslip: @json($data ?? null), // Agar data empty ho toh null pass karein
            basic_salary: @json($data->basic_salary ?? 0),
            overpayment: @json($data->overpayment ?? 0),
            good_separation_bonus: @json($data->good_seperation_bonus ?? 0),
            absence : @json($data->absence ?? 0),
            pes_separation_allowance: @json($data->pes_seperation_allowance ?? 0),
            responsibility_bonus: @json($data->responsibility_bonus ?? 0),
            seniority_bonus: @json($data->seniority_bonus ?? 0),
            attendance_bonus: @json($data->attendance_bonus ?? 0),
            performance_bonus: @json($data->performance_bonus ?? 0),
            cash_bonus: @json($data->cash_bonus ?? 0),
            housing_allowance: @json($data->housing_allowance ?? 0),
            transport_allowance: @json($data->transport_allowance ?? 0),
            electricity: @json($data->electricity ?? 0),
            water: @json($data->water ?? 0),
            cost_of_representation: @json($data->cost_of_representation ?? 0),
            milk_bonus: @json($data->milk_bonus ?? 0),
            dirt_premium: @json($data->dirt_premium ?? 0),
            domestic: @json($data->domestic ?? 0),
            benefit_water: @json($data->benefit_water ?? 0),
            food: @json($data->food ?? 0),
            // gross_salary : 0,
            // taxable_salary: @json($data->basic_salary ?? 0),
            // capped_contributory_salary: @json($data->basic_salary ?? 0),
            month : @json($data->month ?? 0),
            leave : @json($data->hrms_leave ?? 0),

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

            //tax
            gross_salary : @json($data->gross_salary ?? 0),
            contributable_salary_np :  @json($data->contributable_salary_np ?? 0),
            extra1 :  @json($data->extra1 ?? 0),
            cacCalculated :  @json($data->cac_calculated ?? 0),
            cfcCalculated :  @json($data->cfc_calculated ?? 0),
            social :  @json($data->social ?? 0),
            FNE :  @json($data->fne ?? 0),
            ALLOC :  @json($data->alloc ?? 0),
            Extra2 :  @json($data->extra2 ?? 0),
            taxableSalary :  @json($data->taxable_salary ?? 0),
            cappedContributorySalary :  @json($data->capped_contributory_salary ?? 0),
            irppCalculated :  @json($data->irpp_calculated ?? 0),
            tdlCalculated :  @json($data->tdl_calculated ?? 0),
            ravCalculated :  @json($data->rav_calculated ?? 0),
            CFC :  @json($data->cfc ?? 0),
            PVI :  @json($data->pvi ?? 0),
            AT :  @json($data->at ?? 0),
            netToPay :  @json($data->net_to_pay ?? 0),
            filterSalary : "",
        },

        methods : {
            fetchPayslip() {
                this.loading = true;
                axios.post("/api/get-payslip", {
                    filterData: this.filterSalary,
                })
                .then(response => {
                    console.log(response.data);
                    // this.payslipData = response.data;
                    this.basic_salary = response.data.basic_salary ?? 0;


                    this.overpayment = response.data.overpayment ?? 0,
                    this.good_separation_bonus = response.data.good_seperation_bonus ?? 0,
                    this.absence = response.data.absence ?? 0,
                    this.pes_separation_allowance = response.data.pes_seperation_allowance ?? 0,
                    this.responsibility_bonus = response.data.responsibility_bonus ?? 0,
                    this.seniority_bonus = response.data.seniority_bonus ?? 0,
                    this.attendance_bonus = response.data.attendance_bonus ?? 0,
                    this.performance_bonus = response.data.performance_bonus ?? 0,
                    this.cash_bonus = response.data.cash_bonus ?? 0,
                    this.housing_allowance = response.data.housing_allowance ?? 0,
                    this.transport_allowance = response.data.transport_allowance ?? 0,
                    this.electricity = response.data.electricity ?? 0,
                    this.water = response.data.water ?? 0,
                    this.cost_of_representation = response.data.cost_of_representation ?? 0,
                    this.milk_bonus = response.data.milk_bonus ?? 0,
                    this.dirt_premium = response.data.dirt_premium ?? 0,
                    this.domestic = response.data.domestic ?? 0,
                    this.benefit_water = response.data.benefit_water ?? 0,
                    this.food = response.data.food ?? 0,
                    this.month = response.data.month ?? 0,
                    this.leave = response.data.hrms_leave ?? 0,

                    //deduction
                    this.mutual = response.data.mutual ?? 0,
                    this.salary_advance = response.data.salary_advance ?? 0,
                    this.school_credit = response.data.school_credit ?? 0,
                    this.emergency_loan = response.data.emergency_loan ?? 0,
                    this.ordinary_p_loan = response.data.ordinary_p_loan ?? 0,
                    this.car_loan = response.data.car_loan ?? 0,
                    this.ascoma = response.data.ascoma ?? 0,
                    this.rolling_equipment_credit = response.data.rolling_equipment_credit ?? 0,
                    this.salary_deduction = response.data.salary_deduction ?? 0,
                    this.notice_due_by_the_employee = response.data.notice_due_by_the_employee ?? 0,
                    this.regul_irpp_2017 = response.data.regul_irpp_2017 ?? 0,
                    this.regul_cac_2017 = response.data.regul_cac_2017 ?? 0,

                    //tax
                    this.gross_salary = response.data.gross_salary ?? 0,
                    this.contributable_salary_np =  response.data.contributable_salary_np ?? 0,
                    this.extra1 =  response.data.extra1 ?? 0,
                    this.cacCalculated =  response.data.cac_calculated ?? 0,
                    this.cfcCalculated =  response.data.cfc_calculated ?? 0,
                    this.social =  response.data.social ?? 0,
                    this.FNE =  response.data.fne ?? 0,
                    this.ALLOC =  response.data.alloc ?? 0,
                    this.Extra2 =  response.data.extra2 ?? 0,
                    this.taxableSalary =  response.data.taxable_salary ?? 0,
                    this.cappedContributorySalary =  response.data.capped_contributory_salary ?? 0,
                    this.irppCalculated =  response.data.irpp_calculated ?? 0,
                    this.tdlCalculated =  response.data.tdl_calculated ?? 0,
                    this.ravCalculated =  response.data.rav_calculated ?? 0,
                    this.CFC =  response.data.cfc ?? 0,
                    this.PVI =  response.data.pvi ?? 0,
                    this.AT =  response.data.at ?? 0,
                    this.netToPay =  response.data.net_to_pay ?? 0
                })
                .catch(error => {
                    console.error("Error fetching data", error);
                })
                .finally(() => {
                    this.loading = false;
                });
            }
        }

    })
</script>



@endsection