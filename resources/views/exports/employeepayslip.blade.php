    <table border="0">
      <tr>
        <td colspan="1">
        <!-- <img src="assets/img/redianlogo.jpeg" class="container-img" alt="Logo"> -->
        </td>
        <td colspan="2" style="text-align: center">
          <h3><?php echo trans('lang.payslip'); ?></h3>
          <p>Month : {{ \Carbon\Carbon::create()->month($employee_data->current_month)->format('F') }}</p>
        </td>
        <td colspan="5" style="height: 150px;">
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px; display: inline-block;"><?php echo trans('lang.registration_number'); ?>:</span> <span style="width: 300px; display: inline-block;">{{$employee_data->employee->registration_no}}</span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;"><?php echo trans('lang.cat_ech'); ?>: </span> <span style="width: 300px;  display: inline-block;">{{$employee_data->employee->employee_payslip_category->category_name}}</span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;"><?php echo trans('lang.cnps_no'); ?>: {{$employee_data->employee->cnps_no}}</span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;"><?php echo trans('lang.niu'); ?>: {{$employee_data->employee->niu}}</span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;"><?php echo trans('lang.function'); ?>:</span> <span style="width: 300px;  display: inline-block;"><b>{{$employee_data->employee->department_name->department}}:</b></span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;"><?php echo trans('lang.hire_date'); ?>:</span> <span style="width: 300px;  display: inline-block;">{{$employee_data->employee->confirmation_date}}</span></p>
            <p style="margin: 0px; padding: 0px;"><span style="width: 150px;  display: inline-block;"><?php echo trans('lang.salary_month'); ?>: </span> <span style="width: 300px;  display: inline-block;">{{ \Carbon\Carbon::create()->month($employee_data->current_month)->format('F') }}</span></p>
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
        <th><?php echo trans('lang.designation'); ?></th>
        <th><?php echo trans('lang.number'); ?></th>
        <th><?php echo trans('lang.base'); ?></th>
        <th colspan="3"><?php echo trans('lang.salary_share'); ?></th>
        <th colspan="2"><?php echo trans('lang.employer_share'); ?></th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th><?php echo trans('lang.rate'); ?></th>
        <th><?php echo trans('lang.gain'); ?></th>
        <th><?php echo trans('lang.retention'); ?></th>
        <th><?php echo trans('lang.rate'); ?></th>
        <th><?php echo trans('lang.retention'); ?></th>
      </tr>
      <tr>
        <td><p>1001</p></td>
        <td><span><?php echo trans('lang.basic_salary'); ?></span></td>
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
        <td><span><?php echo trans('lang.responsbility_bonus'); ?></span></td>
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
        <td><span><?php echo trans('lang.extra_salary'); ?></span></td>
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
        <td><span><?php echo trans('lang.representation_ind'); ?></span></td>
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
        <td><span><?php echo trans('lang.transport_ind'); ?></span></td>
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
        <td><span><?php echo trans('lang.seniority_bonus'); ?></span></td>
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
        <td><span><?php echo trans('lang.assurance_bonus'); ?></span></td>
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
        <td><span><?php echo trans('lang.milk_bonus'); ?></span></td>
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
        <td><span><?php echo trans('lang.dirt_premium'); ?></span></td>
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
        <td><span><?php echo trans('lang.performance_premium'); ?></span></td>
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
        <td><span><?php echo trans('lang.separation_allowance_for_school_age_child'); ?></span></td>
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
        <td><span><?php echo trans('lang.housing'); ?></span></td>
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
        <td><span><?php echo trans('lang.domesticity'); ?></span></td>
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
        <td><span><?php echo trans('lang.electricity'); ?></span></td>
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
        <td><span><?php echo trans('lang.water'); ?></span></td>
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
        <td><span><?php echo trans('lang.13th_m_premium'); ?><span></td>
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
        <span><b><?php echo trans('lang.gross_total'); ?></b></span>
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
        <td><span><?php echo trans('lang.irpp'); ?></span></td>
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
        <td><span><?php echo trans('lang.cac_irpp'); ?></span></td>
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
        <td><span><?php echo trans('lang.cfc'); ?></span></td>
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
        <td><span><?php echo trans('lang.rav'); ?></span></td>
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
        <td><span><?php echo trans('lang.local_development_tax'); ?></span></td>
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
        <td><span><?php echo trans('lang.old_age_pension'); ?></span></td>
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
        <td><p><?php echo trans('lang.total_contributions'); ?></p></td>
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
        <td><span><?php echo trans('lang.mutual_deduction'); ?></span></td>
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
        <td><span><?php echo trans('lang.other_deductions'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><p> </p></td>
        <td style="text-align: right"><p>-</p></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><span><?php echo trans('lang.cumul'); ?></span></td>
        <td><span><?php echo trans('lang.gross_salary'); ?></span></td>
        <td style="text-align: center" colspan="2"><span><?php echo trans('lang.taxable_net'); ?></span></td>
        <td style="text-align: center" colspan="2"><span><?php echo trans('lang.net_contributory'); ?></span></td>
        <td style="text-align: center" colspan="2"><span><?php echo trans('lang.salary_charge'); ?></span></td>
        <td> <span><?php echo trans('lang.net_to_pay'); ?></span></td>
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

  