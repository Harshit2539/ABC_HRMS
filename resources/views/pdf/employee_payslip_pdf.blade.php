<!DOCTYPE html>
<html>
  <head>
    <title>Hello World!</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payslip</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #000;
        }
 
        h2, h4 {
            text-align: center;
            margin: 5px 0;
        }
 
        .header, .footer {
            text-align: center;
            margin-bottom: 10px;
        }
 
        .section {
            margin-bottom: 15px;
        }
 
        .two-column {
            width: 100%;
            border-collapse: collapse;
        }
 
        .two-column td {
            width: 50%;
            vertical-align: top;
            padding: 4px 0;
        }
 
        .payslip-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
 
        .payslip-table th, .payslip-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
 
        .payslip-table th {
            background-color: white;
        }
 
        .summary {
            margin-top: 10px;
        }
 
        .summary p {
            margin: 4px 0;
        }
 
          .two-column tr, td, th{
            border:1px solid black;
          }
 
        .footer-note {
            margin-top: 30px;
            font-style: italic;
            text-align: center;
        }
 
        .signature {
            margin-top: 30px;
            text-align: right;
            padding-right: 40px;
        }
       
        td>p{
              margin-left: 6px;
}
       
    </style>
</head>
<body>

<?php
function numberToWords($number) {
    $words = [
        0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four',
        5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen',
        15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen',
        20 => 'twenty', 30 => 'thirty', 40 => 'forty', 50 => 'fifty',
        60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
    ];

    if ($number < 21) return $words[$number];
    if ($number < 100) return $words[10 * floor($number / 10)] . ($number % 10 ? '-' . $words[$number % 10] : '');
    if ($number < 1000) return $words[floor($number / 100)] . ' hundred' . ($number % 100 ? ' and ' . numberToWords($number % 100) : '');
    if ($number < 1000000) return numberToWords(floor($number / 1000)) . ' thousand' . ($number % 1000 ? ' ' . numberToWords($number % 1000) : '');
    return $number; // For larger numbers, extend as needed
}
?>


 
    <div class="header">
        <div>
              <img src="assets/img/redianlogo.jpeg" alt="redian logo">
   
           </div>
    <div>
    <h3><strong>REDIAN SOFTWARE PRIVATE LIMITED(static)</strong></h3>
    </div>
        1st Floor, B-49, SECTOR-63, NOIDA, Gautam Buddha Nagar, Uttar Pradesh, 201301(static)
    </div>
 
    <h4>Payslip for the month of {{ $monthName }} {{ $year }}</h4>
 
    <div class="section">
        <table class="two-column">
            <tr>
                <td>
                  <p><span><strong>Name:</strong> {{ $employee_object->first_name  }} {{ $employee_object->last_name == 'null' ? '' : $employee_object->last_name  }}</span></p>
               
                <p><span><strong>Joining Date:</strong> {{ $employee_object->joined_date == 'null' ? 'NIL' : $employee_object->joined_date  }}</span></p>
                <p><span><strong>Designation</strong> {{ $employee_object->job_title_details == 'null' ? 'NIL' : $employee_object->job_title_details->name }}</span></p>
                <p><span><strong>Department:</strong>  {{ $employee_object->department_name  == 'null' ? 'NIL' : $employee_object->department_name->department }}</span></p>
                <p><span><strong>Location:</strong> {{ $employee_object->city == 'null' ? 'NIL' : $employee_object->city  }}</span></p>
                <p><span><strong>Effective Work Days:</strong> 360(static)</span></p>
                <p><span><strong>LOP:</strong> 0(static)</span></p>
               
                </td>
                <td>
                  <p><span><strong>Employee No: </strong>{{ $employee_object->employee_number == 'null' ? 'NIL' : $employee_object->employee_number }}</span></p>
                 
                  <p><span><strong>Bank Name: </strong> ICICI Bank(static)</span></p>
                  <p><span><strong>Bank Account No: </strong>1234567890(static)</span></p>
                  <p><span><strong>PAN Number: </strong>ABC12345(static)</span></p>
                  <p><span><strong>PF No: </strong>MR/NOI/1661834/000/0010214(static)</span></p>
                  <p><span><strong>PF UAN </strong>1234567(static)</span></p>
                </td>
            </tr>
       
        </table>
    </div>
 
    <table class="payslip-table">
        <thead>
            <tr>
                <th colspan="2"><span>Earnings</span> <span>Amount</span>
               
                </th>
                <th colspan="2">Deductions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>BASIC</td><td>{{ $basic }}</td>
                <td>PF</td><td>{{ $pf_employee }}</td>
            </tr>
            <tr>
                <td>HRA</td><td>{{ $hra }}</td>
                <td>MEDICAL INSURANCE</td><td>{{ $medical_insurance }}</td>
            </tr>
            <tr>
                <td>CONVEYANCE</td><td>{{ $convience }}</td>
                <td>EMPLOYER PF CONTRIBUTION</td><td>{{ $pf_employer }}</td>
            </tr>
            <tr>
                <td>SPECIAL ALLOWANCE</td><td>{{ $fixed_allowance }}</td>
                <td></td><td></td>
            </tr>
            <tr>
                <td>BONUS</td><td>{{ $bonus }}</td>
                <td></td><td></td>
            </tr>
             <tr>
                <td colspan="2"><strong>Total Earnings:  INR {{  $gross_salary  }}</strong></td>
                <td  colspan="2"> <strong> Total Deductions:INR {{ $total_deduction }} </strong></td>
            </tr>
        </tbody>
    </table>
 
    <div class="summary">
        <!--<p><strong>Total Earnings:</strong> INR 34,56,345.00</p>-->
        <!--<p><strong>Total Deductions:</strong> INR 24000.00</p>-->
        <p><strong>Net Pay for the month:</strong> INR {{ $gross_salary - $total_deduction  }}</p>
 
             
<p>{{ numberToWords($gross_salary - $total_deduction) }}</p>    </div>
 
    <div class="footer-note">
        This is a system generated payslip and does not require signature.
    </div>
 
    <div class="signature">
        <strong> {{ $employee_object->first_name  }}</strong>
    </div>
 
</body>
</html>
 
     
   