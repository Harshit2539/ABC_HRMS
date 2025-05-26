<table>
    <thead>
        <tr>
            <th colspan="10" style="font-size: 16px; font-weight: bold; text-align: left;">COMPANY: ABC FINANCE SA</th>
        </tr>
        <tr>
            <th colspan="10" style="text-align: left;">BP: 12711 DOUALA</th>
        </tr>
        <tr>
            <th colspan="10" style="text-align: left;">ACTIVITY: MICROFINANCE</th>
        </tr>
        <tr>
            <th colspan="10" style="text-align: left;">Such:675898122</th>
        </tr>
        <tr>
            <th colspan="10" style="text-align: left;">Human Resources</th>
        </tr>
        <tr>
            <th colspan="10"></th>
        </tr>
        <tr>
            <th colspan="10"></th>
        </tr>
        <tr>
            <th colspan="10"></th>
        </tr>
        <tr>
            <th colspan="10"></th>
        </tr>
        <tr>
            <th colspan="1"></th>
            <th colspan="4">IDENTIFICATION</th>
            <th colspan="5">MAIN SALARY</th>
            <th colspan="9">BONUS AND OTHER CASH BENEFITS</th>
            <th colspan="2">Reimbursement Of Expenses </th>
            <th colspan="4">Benefits in Kind</th>
            <th colspan="11"></th>
            <th colspan="9">TAX SALARY DEDUCTIONS</th>
            <th colspan="1">SOCIAL</th>
            <th colspan="2">TAX (Employer DEDUCTION)</th>
            <th colspan="3">SOCIAL (Employer DEDUCTION)</th>
            <th colspan="1"></th>
            <th colspan="10">DEDUCTION</th>
            <th colspan="2">IRPP/CAC regularization</th>
            <th colspan="1">Disbursement</th>


        </tr>
        <tr>
            <th>Sr No</th>
            <th>Cat</th>
            <th>Names and Surnames</th>
            <th>Functions</th>
            <th>Agencies</th>
            <th>Basic Salary</th>
            <th>Overpayment</th>
            <th>Good Separation Bonus</th>
            <th>PES Separation Allowance</th>
            <th>Absence</th>
            <th>Responsibility Bonus</th>
            <th>Seniority Bonus</th>
            <th>Attendance Bonus</th>
            <th>Performance Bonus/ Function Compensation</th>
            <th>Cash Bonus</th>
            <th>Hosuing Allowance</th>
            <th>Transport Allowance</th>
            <th>Electricity</th>
            <th>Water</th>
            <th>Cost Of Representation</th>
            <th>Milk Bonus</th>
            <th>Dirt Premium</th>
            <th>Domestic</th>
            <th>Water</th>
            <th>Food</th>

            <th>13th Month</th>
            <th>Leave</th>
            <th>Gross Salary</th>
            <th>Taxable Salary</th>
            <th></th>
            <th>Taxable Salary</th>
            <th>Contributable Salary NP</th>
            <th>Capped Contributory Salary</th>
            <th></th>
            <th>IRPP Calculated</th>
            <th>Var</th>

            <!-- Salary Desuction -->
            <th>IRPP c</th>
            <th>CAC c</th>
            <th>TDL c</th>
            <th>VAR</th>
            <th>TDL c</th>
            <th>CFC c</th>
            <th>RAV c</th>
            <th>VAR</th>
            <th>RAV c</th>

            <!-- Social -->
            <th>PVI c</th>

            <!-- Employer Deduction -->
            <th>CFC</th>
            <th>FNE</th>
            <th>PVI</th>
            <th>ALLOC</th>
            <th>A T</th>
            <th></th>

            <!-- Deduction -->
            <th>Mutual</th>
            <th>Salary advance</th>
            <th>School credit</th>
            <th>EMERGENCY LOAN</th>
            <th>ORDINARY P. LOAN</th>
            <th>CAR LOAN</th>
            <th>Ascoma</th>
            <th>Rolling equipment credit</th>
            <th>Salary deduction</th>
            <th>Notice due by the employee</th>

            <!-- IRPP/CAC regularization -->
            <th>REGUL IRPP 2017</th>
            <th>REGUL CAC 2017</th>

            <!-- IRPP/CAC regularization -->
            <th>NET TO PAY</th>


        </tr>
    </thead>
    <tbody>
        @foreach($employees as $key => $data)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{$data->employee->employee_payslip_category->category_name}}</td>
            <td>{{ $data->employee->first_name . ' ' .$data->employee->last_name }}</td>
            <td>{{$data->employee->department_name->department}}</td>
            <td>{{$data->employee->division->name}}</td>

            <td>{{ ($data->basic_salary) ?? '-'}}</td>
            <td>{{ ($data->overpayment) ?? '-' }}</td>
            <td>{{ ($data->good_seperation_bonus) ?? '-'}}</td>
            <td>{{ ($data->pes_seperation_allowance) ?? '-' }}</td>
            <td>{{ $data->absence ?? '-' }}</td>

            <td>{{$data->responsibility_bonus }}</td>
            <td>{{$data->seniority_bonus}}</td>
            <td>{{ $data->attendance_bonus}}</td>
            <td>{{$data->performance_bonus}}</td>
            <td>{{$data->cash_bonus}}</td>
            <td>{{ $data->housing_allowance }}</td>
            <td>{{ $data->transport_allowance}}</td>
            <td>{{ $data->electricity}}</td>
            <td>{{ $data->water  }}</td>

            <td>{{$data->cost_of_representation}}</td>
            <td>{{$data->milk_bonus}}</td>
            <td>{{ $data->dirt_premium}}</td>
            <td>{{ $data->domestic}}</td>
            <td>{{ $data->benefit_water}}</td>
            <td>{{ $data->food}}</td>

            <td>{{$data->month}}</td>
            <td>{{ $data->hrms_leave}}</td>
            <td>{{$data->gross_salary}}</td>
            <td>{{$data->taxable_salary}}</td>
            <td>-</td>
            <td>{{$data->taxable_salary}}</td>
            <td>{{ $data->contributable_salary_np }}</td>
            <td>{{ $data->capped_contributory_salary}}</td>
            <td>{{ $data->extra1}}</td>
            <td>{{ $data->irpp_calculated  }}</td>
            <td>-</td>

            <!-- TAX -->
            <td>{{$data->irpp_calculated}}</td>
            <td>{{ $data->cac_calculated}}</td>
            <td>{{$data->tdl_calculated}}</td>
            <td>-</td>
            <td>{{$data->tdl_calculated}}</td>
            <td>{{$data->cfc_calculated}}</td>
            <td>{{ $data->rav_calculated }}</td>
            <td>-</td>
            <td>{{ $data->rav_calculated }}</td>
            <!-- SOCIAL -->
            <td>{{ $data->social }}</td>

            <!-- Employer Deduction -->
            <td>{{$data->cfc}}</td>
            <td>{{ $data->fne }}</td>
            <td>{{ $data->pvi}}</td>
            <td>{{ $data->alloc}}</td>
            <td>{{ $data->at  }}</td>

            <td>{{ $data->extra2  }}</td>


            <!-- Deductions -->
            <td>{{$data->mutual}}</td>
            <td>{{ $data->salary_advance}}</td>
            <td>{{$data->school_credit}}</td>
            <td>{{$data->emergency_loan}}</td>
            <td>{{ $data->ordinary_p_loan}}</td>
            <td>{{$data->car_loan}}</td>
            <td>{{$data->ascoma}}</td>
            <td>{{ $data->rolling_equipment_credit}}</td>
            <td>{{$data->salary_deduction}}</td>
            <td>{{$data->notice_due_by_the_employee}}</td>

            <!-- IRPP/CAC regularization -->
            <td>{{$data->regul_irpp_2017}}</td>
            <td>{{ $data->regul_cac_2017}}</td>
            <!-- Disbursement -->
            <td>{{$data->net_to_pay}}</td>

        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4"></td>
            <td style="font-weight: bold;">TOTAL</td>

            <!-- MAIN SALARY -->
            <td style="font-weight: bold;">{{ $totals['basic_salary'] }}</td>
            <td style="font-weight: bold;">{{ $totals['overpayment'] }}</td>
            <td style="font-weight: bold;">{{ $totals['good_seperation_bonus'] }}</td>
            <td style="font-weight: bold;">{{ $totals['pes_seperation_allowance'] }}</td>
            <td style="font-weight: bold;">{{ $totals['absence'] }}</td>

            <!-- BONUSES AND OTHER CASH BENEFITS -->
            <td style="font-weight: bold;">{{ $totals['responsibility_bonus'] }}</td>
            <td style="font-weight: bold;">{{ $totals['seniority_bonus'] }}</td>
            <td style="font-weight: bold;">{{ $totals['attendance_bonus'] }}</td>
            <td style="font-weight: bold;">{{ $totals['performance_bonus'] }}</td>
            <td style="font-weight: bold;">{{ $totals['cash_bonus'] }}</td>
            <td style="font-weight: bold;">{{ $totals['housing_allowance'] }}</td>
            <td style="font-weight: bold;">{{ $totals['transport_allowance'] }}</td>
            <td style="font-weight: bold;">{{ $totals['electricity'] }}</td>
            <td style="font-weight: bold;">{{ $totals['water'] }}</td>


            <!-- Reimbursement of expenses -->
            <td style="font-weight: bold;">{{ $totals['cost_of_representation'] }}</td>
            <td style="font-weight: bold;">{{ $totals['milk_bonus'] }}</td>

            <!-- BENEFITS IN KIND -->
            <td style="font-weight: bold;">{{ $totals['dirt_premium'] }}</td>
            <td style="font-weight: bold;">{{ $totals['domestic'] }}</td>
            <td style="font-weight: bold;">{{ $totals['benefit_water'] }}</td>
            <td style="font-weight: bold;">{{ $totals['food'] }}</td>



            <td style="font-weight: bold;">{{ $totals['month'] }}</td>
            <td style="font-weight: bold;">{{ $totals['hrms_leave'] }}</td>
            <td style="font-weight: bold;">{{ $totals['gross_salary'] }}</td>
            <td style="font-weight: bold;">{{ $totals['taxable_salary'] }}</td>
            <td style="font-weight: bold;">-</td>
            <td style="font-weight: bold;">{{ $totals['taxable_salary'] }}</td>
            <td style="font-weight: bold;">{{ $totals['contributable_salary_np'] }}</td>
            <td style="font-weight: bold;">{{ $totals['capped_contributory_salary'] }}</td>
            <td style="font-weight: bold;">{{ $totals['extra1'] }}</td>
            <td style="font-weight: bold;">{{ $totals['irpp_calculated'] }}</td>
            <td style="font-weight: bold;">0</td>


            <!-- TAX-->
            <td style="font-weight: bold;">{{ $totals['irpp_calculated'] }}</td>
            <td style="font-weight: bold;">{{ $totals['cac_calculated'] }}</td>
            <td style="font-weight: bold;">{{ $totals['tdl_calculated'] }}</td>
            <td style="font-weight: bold;">0</td>
            <td style="font-weight: bold;">{{ $totals['tdl_calculated'] }}</td>
            <td style="font-weight: bold;">{{ $totals['cfc_calculated'] }}</td>
            <td style="font-weight: bold;">{{ $totals['rav_calculated'] }}</td>
            <td style="font-weight: bold;">0</td>
            <td style="font-weight: bold;">{{ $totals['rav_calculated'] }}</td>
            <td style="font-weight: bold;">{{ $totals['social'] }}</td>
            <td style="font-weight: bold;">{{ $totals['cfc'] }}</td>
            <td style="font-weight: bold;">{{ $totals['fne'] }}</td>
            <td style="font-weight: bold;">{{ $totals['pvi'] }}</td>
            <td style="font-weight: bold;">{{ $totals['alloc'] }}</td>
            <td style="font-weight: bold;">{{ $totals['at'] }}</td>
            <td style="font-weight: bold;">{{ $totals['extra2'] }}</td>



            <!-- Deductions -->

            <td style="font-weight: bold;">{{$totals['mutual']}}</td>
            <td style="font-weight: bold;">{{ $totals['salary_advance'] }}</td>
            <td style="font-weight: bold;">{{ $totals['school_credit'] }}</td>
            <td style="font-weight: bold;">{{ $totals['emergency_loan'] }}</td>
            <td style="font-weight: bold;">{{ $totals['ordinary_p_loan'] }}</td>
            <td style="font-weight: bold;">{{ $totals['car_loan'] }}</td>
            <td style="font-weight: bold;">{{ $totals['ascoma'] }}</td>
            <td style="font-weight: bold;">{{ $totals['rolling_equipment_credit'] }}</td>
            <td style="font-weight: bold;">{{ $totals['salary_deduction'] }}</td>
            <td style="font-weight: bold;">{{ $totals['notice_due_by_the_employee'] }}</td>

            <!-- IRPP/CAC regularization -->

            <td style="font-weight: bold;">{{ $totals['regul_irpp_2017'] }}</td>
            <td style="font-weight: bold;">{{ $totals['regul_cac_2017'] }}</td>

            <!-- Disbursement -->
            <td style="font-weight: bold;">{{ $totals['net_to_pay'] }}</td>






















        </tr>
        <!-- <tr>
            <td colspan="4"></td>
            <td>C</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td>E</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td>M</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td style="font-weight: bold;">TOTAL</td>
            <td style="font-weight: bold;">-</td>
            <td style="font-weight: bold;">-</td>
            <td style="font-weight: bold;">-</td>
            <td style="font-weight: bold;">-</td>
            <td style="font-weight: bold;">-</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td style="font-weight: bold;">DIRECTION</td>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td>C</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td>E</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td>M</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td style="font-weight: bold;">TOTAL</td>
            <td style="font-weight: bold;">-</td>
            <td style="font-weight: bold;">-</td>
            <td style="font-weight: bold;">-</td>
            <td style="font-weight: bold;">-</td>
            <td style="font-weight: bold;">-</td>
        </tr> -->
    </tfoot>
</table>