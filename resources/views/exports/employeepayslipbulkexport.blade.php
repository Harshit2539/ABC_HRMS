
   @foreach ($employee_data as $employee_data)
    <table border="0">
      <tr>
        <td colspan="1">
        <!-- <img src="assets/img/redianlogo.jpeg" class="container-img" alt="Logo"> -->
        </td>
        <td colspan="2" style="text-align: center">
          <h3>PAY SLIP</h3>
          <p>Month : {{ \Carbon\Carbon::create()->month($employee_data->current_month)->format('F') }}</p>
        </td>
        <td colspan="5" style="height: 150px;">
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px; display: inline-block;"><?php echo trans('lang.registration_number'); ?>:</span> <span style="width: 300px; display: inline-block;">{{$employee_data->employee->registration_no}}</span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;">Cat / ECh: </span> <span style="width: 300px;  display: inline-block;">{{$employee_data->employee->employee_payslip_category->category_name}}</span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;">CNPS No.: {{$employee_data->employee->cnps_no}}</span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;">NIU : {{$employee_data->employee->niu}}</span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;">Function:</span> <span style="width: 300px;  display: inline-block;"><b>{{$employee_data->employee->department_name->department}}:</b></span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;">Hire Date:</span> <span style="width: 300px;  display: inline-block;">{{$employee_data->employee->confirmation_date}}</span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;">Salary Month: </span> <span style="width: 300px;  display: inline-block;">{{ \Carbon\Carbon::create()->month($employee_data->current_month)->format('F') }}</span></p>
        </td>
      </tr>
      <tr>
        <td style="border-right: 1px solid transparent;"></td>
        <td colspan="8" style="height: 50px; font-size: 24px; font-weight: bold; border:  solid 2px;">
          <h3 >{{$employee_data->employee->first_name}} &nbsp; {{$employee_data->employee->last_name}}</h3>
        </td>
      </tr>
      <tr>
        <th>N°</th>
        <th>Désignation</th>
        <th>Number</th>
        <th>Base</th>
        <th colspan="3">Salary Share</th>
        <th colspan="2">Employer Share</th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Rate</th>
        <th>Gain</th>
        <th>Retention</th>
        <th>Rate</th>
        <th>Retention</th>
      </tr>
      <tr>
        <td><p>1001</p></td>
        <td><p>Basic salary</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->basic_salary)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1002</p></td>
        <td><p>Responsbility bonus</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->responsibility_bonus)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1003</p></td>
        <td><p>Extra salary</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->overpayment)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1004</p></td>
        <td><p>Representation Ind</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->cost_of_representation)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p>1016</p></td>
        <td><p>Transport Ind</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->transport_allowance)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1010</p></td>
        <td><p>Seniority bonus</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->seniority_bonus)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1011</p></td>
        <td><p>Assurance bonus </p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->milk_bonus)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1012</p></td>
        <td><p>Milk bonus</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->milk_bonus)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1013</p></td>
        <td><p>Dirt premium</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->dirt_premium)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1014</p></td>
        <td><p>Performance premium</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->performace_bonus)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1015</p></td>
        <td><p>Separation allowance for school-age child</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>Not Defined Yet</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1005</p></td>
        <td><p>Housing</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->housing_allowance)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><p>1006</p></td>
        <td><p>Domesticity</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->domestic)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p>1008</p></td>
        <td><p>Electricity</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->electricity)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p>1009</p></td>
        <td><p>Water</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p>{{number_format($employee_data->water)}}</p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p></p></td>
        <td><p>13th m premium</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p> - </p></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p></p></td>
        <td><span><b>Gross total</b></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span><b>{{number_format($employee_data->gross_salary)}}</b></span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p>2000</p></td>
        <td><p>IRPP</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p> </p></td>
        <td style="text-align: right"><p>{{number_format($employee_data->irpp_calculated)}}</p></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p>2001</p></td>
        <td><p>CAC / IRPP</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p> </p></td>
        <td style="text-align: right"><p>{{number_format($employee_data->cac_calculated)}}</p></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p>2002</p></td>
        <td><p>CFC</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p> </p></td>
        <td style="text-align: right"><p>{{number_format($employee_data->cfc_calculated)}}</p></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p>2003</p></td>
        <td><p>RAV</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p> </p></td>
        <td style="text-align: right"><p>{{number_format($employee_data->rav_calculated)}}</p></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p>2004</p></td>
        <td><p>LOCAL DEVELOPMENT TAX</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p> </p></td>
        <td style="text-align: right"><p>{{number_format($employee_data->tdl_calculated)}}</p></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p>2005</p></td>
        <td><p>OLD AGE PENSION</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p> </p></td>
        <td style="text-align: right"><p>{{number_format($employee_data->social)}}</p></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p></p></td>
        <td><span><b>total contributions</b></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span><b>{{number_format($employee_data->irpp_calculated + $employee_data->cac_calculated + $employee_data->cfc_calculated + $employee_data->rav_calculated 
            + $employee_data->tdl_calculated + $employee_data->social ) }}</b></span></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p></p></td>
        <td><p>Mutual Deduction</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p> </p></td>
        <td style="text-align: right"><p>-</p></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p></p></td>
        <td><p>Other Deductions</p></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p> </p></td>
        <td style="text-align: right"><p>-</p></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p>Cumul</p></td>
        <td><p>Gross salary</p></td>
        <td style="text-align: center" colspan="2"><p>Taxable net</p></td>
        <td style="text-align: center" colspan="2"><p>Net contributory</p></td>
        <td style="text-align: center" colspan="2"><p>Salary charge</p></td>
        <th>Net to pay</th>
      </tr>
      <tr>
        <td colspan="2" style="text-align: right"><p>{{number_format($employee_data->gross_salary)}}</p></td>
        <td colspan="2" style="text-align: right"><p>{{number_format($employee_data->taxable_salary)}}</p></td>
        <td colspan="2" style="text-align: right"><p>{{number_format($employee_data->capped_contributory_salary)}}</p></td>
        <td colspan="2" style="text-align: right"><p>{{number_format($employee_data->irpp_calculated + $employee_data->cac_calculated + $employee_data->cfc_calculated + $employee_data->rav_calculated 
            + $employee_data->tdl_calculated + $employee_data->social ) }}</p></td>
        <th>{{number_format($employee_data->net_to_pay)}}</th>
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
  