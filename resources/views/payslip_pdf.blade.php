<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payroll Manage</title>
 
    <style>
      .main {
        width: 100%;
      }
 
      .main,
      tr,
      td {
        border: none;
      }
 
      .first-column-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #dee2e6;
      }
 
      .first-column-table tr {
        border: 1px solid #dee2e6;
      }
 
      .first-column-table td {
        border: 1px solid #dee2e6;
      }
 
      .first-column-table .table-header {
        text-align: center;
      }
 
      .first-column-table .table-header h2 {
        font-size: 17px;
        font-weight: 600;
        margin: 0px;
        padding: 0px;
      }
 
      .first-column-table .table-header h3 span {
        background-color: rgba(255, 152, 0, 0.12) !important;
        color: #f39c12 !important;
        padding: 3px 5px;
        font-size: 14px;
      }
 
      td {
        padding: 5px;
      }
 
      .first-column-table td .span1 {
        font-size: 13px;
        margin-bottom: 7px;
        font-weight: 600;
        width: 150px;
        display: inline-block;
      }
 
      .first-column-table td .span2 {
        font-size: 13px;
        display: inline-block;
        margin-left: 10px;
        margin-bottom: 7px;
      }
 
      .first-column-table td h3 {
        padding: 0px;
        margin: 0px;
      }
 
      .third-column{
        vertical-align: top;
      }
    </style>
  </head>
  <body>
 
          <table class="first-column-table">
            <tr>
              <td colspan="2" class="table-header">
                <h2>Employee Salary Information</h2>
                <h3><span>Main Salary</span></h3>
              </td>
            </tr>
 
            <tr>
              <td style="width: 50%">
                <div>
                  <span class="span1">Basic Salary</span>
                  <span class="span2">{{$data->basic_salary}}</span>
                </div>
 
                <div>
                  <span class="span1">Overpayment</span>
                  <span class="span2">{{$data->overpayment}}</span>
                </div>
 
                <div>
                  <span class="span1">Good separation bonus</span>
                  <span class="span2">{{$data->good_seperation_bonus}}</span>
                </div>
              </td>
              <td style="width: 50%">
                <div>
                  <span class="span1">Absence</span>
                  <span class="span2">{{$data->absence}}</span>
                </div>
 
                <div>
                  <span class="span1">PES separation allowance</span>
                  <span class="span2">{{$data->	pes_seperation_allowance}}</span>
                </div>
              </td>
            </tr>
          </table>
 
          <table class="first-column-table" style="margin-top: 10px">
            <tr>
              <td colspan="3" class="table-header">
                <h3><span>BONUSES AND OTHER CASH BENEFITS</span></h3>
              </td>
            </tr>
 
            <tr>
              <td style="width: 30%">
                <div>
                  <span class="span1">responsibility bonus</span>
                  <span class="span2">{{$data->responsibility_bonus}}</span>
                </div>
 
                <div>
                  <span class="span1">seniority bonus</span>
                  <span class="span2">{{$data->	seniority_bonus}}</span>
                </div>
 
                <div>
                  <span class="span1">Attendance bonus</span>
                  <span class="span2">{{$data->attendance_bonus}}</span>
                </div>
              </td>
 
              <td style="width: 40%">
                <div>
                  <span class="span1"
                    >Performance bonus/Function compensation</span
                  >
                  <span class="span2">{{$data->performance_bonus}}</span>
                </div>
 
                <div>
                  <span class="span1">cash bonus</span>
                  <span class="span2">{{$data->cash_bonus}}</span>
                </div>
 
                <div>
                  <span class="span1">Housing allowance</span>
                  <span class="span2">{{$data->housing_allowance}}</span>
                </div>
              </td>
 
              <td style="width: 30%">
                <div>
                  <span class="span1">Transport allowance</span>
                  <span class="span2">{{$data->transport_allowance}}</span>
                </div>
 
                <div>
                  <span class="span1">Electricity</span>
                  <span class="span2">{{$data->electricity}}</span>
                </div>
 
                <div>
                  <span class="span1">Water</span>
                  <span class="span2">{{$data->water}}</span>
                </div>
              </td>
            </tr>
          </table>
 
          <table class="first-column-table" style="margin-top: 10px">
            <tr>
              <td colspan="2" class="table-header">
                <h3><span>BENEFITS IN KIND</span></h3>
              </td>
            </tr>
 
            <tr>
              <td style="width: 50%">
                <div>
                  <span class="span1">Costs of representation</span>
                  <span class="span2">{{$data->cost_of_representation}}</span>
                </div>
 
                <div>
                  <span class="span1">Milk bonuses</span>
                  <span class="span2">{{$data->milk_bonus}}</span>
                </div>
 
                <div>
                  <span class="span1">Dirt premium</span>
                  <span class="span2">{{$data->dirt_premium}}</span>
                </div>
              </td>
              <td style="width: 50%">
                <div>
                  <span class="span1">Domestic</span>
                  <span class="span2">{{$data->domestic}}</span>
                </div>
 
                <div>
                  <span class="span1">Water</span>
                  <span class="span2">{{$data->benefit_water}}</span>
                </div>
 
                <div>
                  <span class="span1">Food</span>
                  <span class="span2">{{$data->food}}</span>
                </div>
              </td>
            </tr>
          </table>
 
          <table class="first-column-table" style="margin-top: 10px">
            <tr>
              <td colspan="2" class="table-header">
                <h3><span>Others</span></h3>
              </td>
            </tr>
 
            <tr>
              <td style="width: 50%">
                <div>
                  <span class="span1">13th month</span>
                  <span class="span2">{{$data->month}}</span>
                </div>
              </td>
 
              <td style="width: 50%">
                <div>
                  <span class="span1">Leave</span>
                  <span class="span2">{{$data->hrms_leave}}</span>
                </div>
              </td>
            </tr>
          </table>
 
          <table class="first-column-table" style="margin-top: 10px">
            <tr>
              <td colspan="3" class="table-header">
                <h3><span>Deductions</span></h3>
              </td>
            </tr>
 
            <tr>
              <td style="width: 33.3%">
                <div>
                  <span class="span1">Mutual</span>
                  <span class="span2">{{$data->mutual}}</span>
                </div>
 
                <div>
                  <span class="span1">Salary Advance</span>
                  <span class="span2">{{$data->salary_advance	}}</span>
                </div>
 
                <div>
                  <span class="span1">School Credit</span>
                  <span class="span2">{{$data->school_credit}}</span>
                </div>
 
                <div>
                  <span class="span1">Emergency Loan</span>
                  <span class="span2">{{$data->emergency_loan}}</span>
                </div>
              </td>
 
              <td style="width: 33.3%">
                <div>
                  <span class="span1">Ordinary P Loan</span>
                  <span class="span2">{{$data->ordinary_p_loan}}</span>
                </div>
 
                <div>
                  <span class="span1">car_loan</span>
                  <span class="span2">{{$data->car_loan}}</span>
                </div>
 
                <div>
                  <span class="span1">Ascoma</span>
                  <span class="span2">{{$data->ascoma}}</span>
                </div>
 
                <div>
                  <span class="span1">Rolling Equipment Credit</span>
                  <span class="span2">{{$data->rolling_equipment_credit	}}</span>
                </div>
              </td>
 
              <td style="width: 33.3%">
                <div>
                  <span class="span1">Salary Deduction</span>
                  <span class="span2">{{$data->salary_deduction}}</span>
                </div>
 
                <div>
                  <span class="span1">Notice due by the employee</span>
                  <span class="span2">{{$data->notice_due_by_the_employee	}}</span>
                </div>
 
                <div>
                  <span class="span1">Regul IRPP 2017</span>
                  <span class="span2">{{$data->regul_irpp_2017	}}</span>
                </div>
 
                <div>
                  <span class="span1">Regul CAC 2017</span>
                  <span class="span2">{{$data->regul_cac_2017}}</span>
                </div>
              </td>
            </tr>
          </table>
       
 
          <table class="first-column-table" style="margin-top: 10px">
            <tr>
              <td colspan="3" class="table-header">
                <h3><span>Calculations</span></h3>
              </td>
            </tr>
 
            <tr>
              <td style="width: 50%">
                <div>
                  <span class="span1">Gross Salary</span>
                  <span class="span2">{{$data->gross_salary}}</span>
                </div>
 
                <div>
                  <span class="span1">Contributable Salary NP</span>
                  <span class="span2">{{$data->contributable_salary_np}}</span>
                </div>
 
                <div>
                  <span class="span1">Extra1</span>
                  <span class="span2">{{$data->extra1}}</span>
                </div>
 
                <div>
                  <span class="span1">CAC CALCULATED</span>
                  <span class="span2">{{$data->cac_calculated}}</span>
                </div>
 
                <div>
                  <span class="span1">CFC CALCULATED</span>
                  <span class="span2">{{$data->cfc_calculated}}</span>
                </div>
 
                <div>
                  <span class="span1">Social</span>
                  <span class="span2">{{$data->social}}</span>
                </div>
 
                <div>
                  <span class="span1">FNE</span>
                  <span class="span2">{{$data->fne}}</span>
                </div>
 
                <div>
                  <span class="span1">ALLOC</span>
                  <span class="span2">{{$data->alloc}}</span>
                </div>
 
                <div>
                  <span class="span1">Extra2</span>
                  <span class="span2">{{$data->extra2}}</span>
                </div>
              </td>
 
              <td style="width: 50%">
                <div>
                  <span class="span1">Taxable Salary</span>
                  <span class="span2">{{$data->taxable_salary}}</span>
                </div>
 
                <div>
                  <span class="span1">Capped Contributory Salary</span>
                  <span class="span2">{{$data->capped_contributory_salary	}}</span>
                </div>
 
                <div>
                  <span class="span1">IRPP CALCULATED</span>
                  <span class="span2">{{$data->irpp_calculated}}</span>
                </div>
 
                <div>
                  <span class="span1">TDL CALCULATED</span>
                  <span class="span2">{{$data->tdl_calculated}}</span>
                </div>
 
                <div>
                  <span class="span1">RAV CALCULATED</span>
                  <span class="span2">{{$data->rav_calculated}}</span>
                </div>
 
                <div>
                  <span class="span1">CFC</span>
                  <span class="span2">{{$data->cfc}}</span>
                </div>
 
                <div>
                  <span class="span1">PVI</span>
                  <span class="span2">{{$data->pvi}}</span>
                </div>
 
                <div>
                  <span class="span1">AT</span>
                  <span class="span2">{{$data->at}}</span>
                </div>
 
                <div>
                  <span class="span1">Net To Pay</span>
                  <span class="span2">{{$data->net_to_pay}}</span>
                </div>
              </td>
            </tr>
          </table>
   
   
  </body>
</html>