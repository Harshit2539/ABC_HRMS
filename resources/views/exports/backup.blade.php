   <!-- <style>
    .no-border td {
    border: none !important;
}
    </style> -->

    @foreach ($employee_data as $employee_data)
    <table class="pay-slip">
        <tr>
            <td  colspan="6" class="header" style="font-weight:bold; text-align : center;">PAY SLIP</td>
            <td colspan="3">Registration Number: 0003</td>
        </tr>
        <tr>
            <td colspan="3">Cat / ECh: {{$employee_data->employee->employee_payslip_category->category_name}}</td>
            <td colspan="3">CNPS No.:</td>
        </tr>
        <tr>
            <td>Month: {{$employee_data->released_date}}</td>
            <td colspan="3">NIU</td>
            <td colspan="3">Function: {{$employee_data->employee->department_name->department}}</td>
        </tr>
        <tr>
            <!-- <td colspan="3">Hire Date: 01/02/2024</td> -->
            <td colspan="3">Salary Month: {{ \Carbon\Carbon::create()->month($employee_data->current_month)->format('F') }}</td>
            </tr>
        <tr>
            <td colspan="6" class="header">Employee: {{$employee_data->employee->first_name}} &nbsp; {{$employee_data->employee->last_name}}</td>
        </tr>
    </table>
        
   

<!-- SALARY DETAILS -->

<table class="pay-slip">
    <tr class="column-header">
        <th>N°</th>
        <th>Désignation</th>
        <th>Number</th>
        <th>Base</th>
        <th colspan="3">Salary Share</th>
        <th colspan = "2">Employer Share</th>
        
    </tr>
    <tr class="column-header">
        <th style="text-align:center"></th>
        <th style="text-align:center"></th>
        <th style="text-align:center"></th>
        <th style="text-align:center"></th>
        <th style="text-align:center">Rate</th>
        <th style="text-align:center">Gain</th>
        <th style="text-align:center">Retention</th>
        <th style="text-align:center">Rate</th>
        <th style="text-align:center">Retention</th>
    </tr>
    <tr>
        <td style="text-align:start">1001</td>
        <td style="text-align:start" colspan="1">Basic Salary</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->basic_salary)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1002</td>
        <td style="text-align:start">Responsibility Bonus</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->responsibility_bonus)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1003</td>
        <td style="text-align:start">Extra Salary</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->overpayment)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1004</td>
        <td style="text-align:start">Representation Ind</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->cost_of_representation)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1016</td>
        <td style="text-align:start">Transport Ind</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->transport_allowance)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1010</td>
        <td style="text-align:start">Seniority Bonus</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->seniority_bonus)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1011</td>
        <td style="text-align:start">Assurance bonus</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->milk_bonus)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1012</td>
        <td style="text-align:start">Milk bonus</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->milk_bonus)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1013</td>
        <td style="text-align:start">Dirt Premium</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->dirt_premium)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1014</td>
        <td style="text-align:start">Performance Premium</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->performace_bonus)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1015</td>
        <td style="text-align:start">Separation allowance for school-age child</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">Not Defined Yest</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1005</td>
        <td style="text-align:start">Housing</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->housing_allowance)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1006</td>
        <td style="text-align:start">Domesticity</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->domestic)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1008</td>
        <td style="text-align:start">Electricity</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->electricity)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">1009</td>
        <td style="text-align:start">Water</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->water)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
  
    
    
    <tr>
        <td style="text-align:center"></td>
        <td style="text-align:start">13th m premium</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">-</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>

    <tr class="total-row">
        <td style="text-align:center"></td>
        <td style="text-align:start">Gross Total</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->basic_salary + $employee_data->responsibility_bonus + $employee_data->cost_of_representation + $employee_data->transport_allowance +
             $employee_data->seniority_bonus + $employee_data->milk_bonus + $employee_data->dirt_premium + $employee_data->performace_bonus + $employee_data->housing_allowance  +
            $employee_data->domestic + $employee_data->electricity + $employee_data->water)}}
            </td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
</table>


<!-- DEDUCTIONS -->

<table class="pay-slip">
   
  
    <tr>
        <td style="text-align:censtartter">2000</td>
        <td style="text-align:start">IRPP</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->irpp_calculated)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
 
    <tr>
        <td style="text-align:start">2001</td>
        <td style="text-align:start">CAC/IRPP</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->cac_calculated)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr>
        <td style="text-align:start">2002</td>
        <td style="text-align:start">CFC</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->cfc_calculated)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>

    <tr>
        <td style="text-align:start">2003</td>
        <td style="text-align:start">RAV</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->rav_calculated)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>

    <tr>
        <td style="text-align:start">2004</td>
        <td style="text-align:start">Local Development Tax</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->tdl_calculated)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
   
    <tr>
        <td style="text-align:start">2005</td>
        <td style="text-align:start">Old Age Pension</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td></td>
        <td style="text-align:center">{{number_format($employee_data->social)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>

 
    <tr class="total-row">
        <td style="text-align:start"></td>
        <td style="text-align:start">Total Contributions</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->irpp_calculated + $employee_data->cac_calculated + $employee_data->cfc_calculated + $employee_data->rav_calculated 
            + $employee_data->tdl_calculated + $employee_data->social ) }}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    <tr class="total-row">
        <td style="text-align:center"></td>
        <td colspan="2" style="text-align:start">Mutual Deduction</td>
        <td colspan="2" style="text-align:center"></td>
    </tr>
    <tr class="total-row">
        <td style="text-align:center"></td>
        <td colspan="2" style="text-align:start">Other Deductions</td>
        <td colspan="2" style="text-align:center"></td>
    </tr>
</table>



<!-- FINAL NET SALARY -->

<table class="pay-slip">
    <tr class="column-header">
        <th style="text-align:start">Cumul</th>
        <th style="text-align:center">Gross Salary</th>
        <th colspan="2" style="text-align:center">Taxable Net</th>
        <th colspan="2" style="text-align:center">Net Contributory</th>
        <th colspan="2" style="text-align:center">Salary Charges</th>
        <th style="text-align:center">Net to Pay</th>
    </tr>
    <tr>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->gross_salary)}}</td>
        <td style="text-align:center">{{number_format($employee_data->taxable_salary)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->capped_contributory_salary)}}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->irpp_calculated + $employee_data->cac_calculated + $employee_data->cfc_calculated + $employee_data->rav_calculated 
            + $employee_data->tdl_calculated + $employee_data->social ) }}</td>
        <td style="text-align:center"></td>
        <td style="text-align:center">{{number_format($employee_data->net_to_pay)}}</td>
    </tr>
</table>

 <!-- Add five empty rows -->
 <table class="pay-slip">
        @for ($i = 0; $i < 5; $i++)
            <tr class="no-border">
                <td style="border:none;" colspan="9">&nbsp;</td>
            </tr>
        @endfor
    </table>

@endforeach