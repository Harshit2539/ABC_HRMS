<!DOCTYPE html>
<html>
  <head>
    <title>Payslip</title>
    <style>
      tr,
      td,
      th {
        border: 1px solid black;
      }
 
      table {
        width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px; /* Adjust spacing between tables */
      }
 
      td p {
        padding: 0px;
        margin: 0px;
        font-size: 14px;
        font-weight: bold;
      }
 
      td span{
        font-size: 14px;
      }
 
      td {
        padding-right: 5px;
      }

      table{
        width: 100%;
      }
    </style>
  </head>
  <body>
  @foreach($employee_data as $employee_data)
    <div style="margin-bottom: 30px;">
    <table border="0">
      <tr>
        <td>
        <center>
        <img src="{{ public_path('abc_finance.jpg') }}" alt="" srcset="" style="width: 80px !important; height: 80px !important; display: block; margin: auto;">
        </center>

        </td>
        <td colspan="2" style="text-align: center;">
            <p><?php echo trans('lang.payslip'); ?> <br>
            <?php echo trans('lang.month'); ?> : March</p>
        </td>
       
        <td colspan="6">
            <p><?php echo trans('lang.registration_number'); ?>:{{$employee_data->employee->registration_no}}</p>
            <p><?php echo trans('lang.cat_ech'); ?>: {{$employee_data->employee->employee_payslip_category->category_name}}</p>
            <p><?php echo trans('lang.cnps_no'); ?>: {{$employee_data->employee->cnps_no}}</p>
            <p><?php echo trans('lang.niu'); ?>:  {{$employee_data->employee->niu}}</p>
            <p><?php echo trans('lang.function'); ?>: {{$employee_data->employee->department_name->department}}:</p>
            <p><?php echo trans('lang.hire_date'); ?>: {{$employee_data->employee->confirmation_date}}</p>
            <p><?php echo trans('lang.salary_month'); ?>: {{ \Carbon\Carbon::create()->month($employee_data->current_month)->format('F') }}</p>
        </td>
      </tr>


    </table>


      <table border="0">
      <tr>
        <td style="border-right: 1px solid transparent"></td>
        <td colspan="8">
          <h3>{{$employee_data->employee->first_name}} &nbsp; {{$employee_data->employee->last_name}}</h3>
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
        <td><span>1001</span></td>
        <td><span><?php echo trans('lang.basic_salary'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->basic_salary)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1002</span></td>
        <td><span><?php echo trans('lang.responsbility_bonus'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->responsibility_bonus)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1003</span></td>
        <td><span><?php echo trans('lang.extra_salary'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->overpayment)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1004</span></td>
        <td><span><?php echo trans('lang.representation_ind'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->cost_of_representation)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><span>1016</span></td>
        <td><span><?php echo trans('lang.transport_ind'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->transport_allowance)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1010</span></td>
        <td><span><?php echo trans('lang.seniority_bonus'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->seniority_bonus)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1011</span></td>
        <td><span><?php echo trans('lang.assurance_bonus'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->milk_bonus)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1012</span></td>
        <td><span><?php echo trans('lang.milk_bonus'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->milk_bonus)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1013</span></td>
        <td><span><?php echo trans('lang.dirt_premium'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->dirt_premium)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1014</span></td>
        <td><span><?php echo trans('lang.performance_premium'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->performace_bonus)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1015</span></td>
        <td><span><?php echo trans('lang.separation_allowance_for_school_age_child'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>Not Defined Yet</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1005</span></td>
        <td><span><?php echo trans('lang.housing'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->housing_allowance)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><span>1006</span></td>
        <td><span><?php echo trans('lang.domesticity'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->domestic)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><span>1008</span></td>
        <td><span><?php echo trans('lang.electricity'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->electricity)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><span>1009</span></td>
        <td><span><?php echo trans('lang.water'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>{{number_format($employee_data->water)}}</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td></td>
        <td><span><?php echo trans('lang.13th_m_premium'); ?><span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"><span>-</span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><p></p></td>
        <td>
        <span><b><?php echo trans('lang.gross_total'); ?></b></span>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right">
        <p>{{number_format($employee_data->gross_salary)}}</p>
        </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
 
     
      <tr>
        <td><span>2000</span></td>
        <td><span><?php echo trans('lang.irpp'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"></td>
        <td style="text-align: right"><span>{{number_format($employee_data->irpp_calculated)}}</span></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><span>2001</span></td>
        <td><span><?php echo trans('lang.cac_irpp'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"></td>
        <td style="text-align: right"><span>{{number_format($employee_data->cac_calculated)}}</span></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><span>2002</span></td>
        <td><span><?php echo trans('lang.cfc'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"></td>
        <td style="text-align: right"><span>{{number_format($employee_data->cfc_calculated)}}</span></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><span>2003</span></td>
        <td><span><?php echo trans('lang.rav'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"></td>
        <td style="text-align: right"><span>{{number_format($employee_data->rav_calculated)}}</span></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><span>2004</span></td>
        <td><span><?php echo trans('lang.local_development_tax'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"></td>
        <td style="text-align: right"><span>{{number_format($employee_data->tdl_calculated)}}</span></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td><span>2005</span></td>
        <td><span><?php echo trans('lang.old_age_pension'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"></td>
        <td style="text-align: right"><span>{{number_format($employee_data->social)}}</span></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td></td>
        <td>
        <p><?php echo trans('lang.total_contributions'); ?></p>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right">
        <p>{{number_format($employee_data->irpp_calculated + $employee_data->cac_calculated + $employee_data->cfc_calculated + $employee_data->rav_calculated 
            + $employee_data->tdl_calculated + $employee_data->social ) }}</p>
        </td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td></td>
        <td><span><?php echo trans('lang.mutual_deduction'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"></td>
        <td style="text-align: right"><span>-</span></td>
        <td></td>
        <td></td>
      </tr>
 
      <tr>
        <td></td>
        <td><span><?php echo trans('lang.other_deductions'); ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: right"></td>
        <td style="text-align: right"><span>-</span></td>
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
        <td colspan="2" style="text-align: right"><span>{{number_format($employee_data->gross_salary)}}</span></td>
        <td colspan="2" style="text-align: right"><span>{{number_format($employee_data->taxable_salary)}}</span></td>
        <td colspan="2" style="text-align: right"><span>{{number_format($employee_data->capped_contributory_salary)}}</span></td>
        <td colspan="2" style="text-align: right"><span>{{number_format($employee_data->irpp_calculated + $employee_data->cac_calculated + $employee_data->cfc_calculated + $employee_data->rav_calculated 
            + $employee_data->tdl_calculated + $employee_data->social ) }}</span></td>
        <td> <span>{{number_format($employee_data->net_to_pay)}}</span></td>
      </tr>
    </table>
        </div>  
        <br> <!-- Adds space after each payslip -->
    <hr> <!-- Optional separator -->
    @endforeach
   
  </body>
</html>
 