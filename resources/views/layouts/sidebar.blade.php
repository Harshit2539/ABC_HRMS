<!-- Sidebar -->
 <style>

/* #sidebar {
        background-image: url({{asset('low-poly-grid-haikei.png')}});
    } */


</style>
<div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>Welcome {{Auth::user()->name}}</span>
                    </li>
                    @can('admin-management')

                  <li class="submenu">
                        <a href="#" class="">
                            <i class="la la-dashboard"></i>
                            <span> Admin</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->routeIs('home') ? 'active' : ''}}" href="{{ route('home') }}">Dashboard</a></li>
                            <li><a class="{{ request()->routeIs('skills.list') || 
                            request()->routeIs('languages.list') || 
                            request()->routeIs('certifications.list') || 
                            request()->routeIs('educations.list') 
                            ? 'active' : '' }} ? 'active' : '' }}" href="{{ route('skills.list') }}">Qualifications Setup</a></li>
                            <li><a class="{{ request()->routeIs('admin.job.details.setup') ? 'active' : '' }}" href="{{ route('admin.job.details.setup') }}">Job Details Setup</a></li>
                            <li><a class="{{ request()->routeIs('company-structure.setup') ? 'active' : '' }}" href="{{ route('company-structure.setup') }}">Company Structure</a></li>
                            <li><a  class="{{ request()->routeIs('projects.list') || request()->routeIs('emp_projects.list') ? 'active' : '' }}" href="{{ route('projects.list') }}">Projects</a></li>
                            <li><a class="{{ request()->routeIs('clients.list') ? 'active' : '' }}" href="{{ route('clients.list') }}">Clients</a></li>
                            <li><a class="{{ request()->routeIs('salary.component.list') ? 'active' : '' }}" href="{{ route('salary.component.list') }}">PayRollSettings</a></li>
 

                        </ul>
                    </li>
                @endcan   
                


                    

                    @can('travel-request')
                    <li class="submenuu">
                        <a id="{{ request()->routeIs('travel.request.listing') ? 'activeee' : '' }}" href="{{ route('travel.request.listing') }}" >
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        <span>Travel Request</span> 
                        </a>
                    </li>
                    @endcan

                    @can('leave-request')
                    <li class="submenuu">
                        <a id="{{ request()->routeIs('leave.request.listing') ? 'activeee' : '' }}" href="{{ route('leave.request.listing') }}" >
                            <i class="la la-dashboard"></i>
                            <span>Leave Request</span> 
                        </a>
                      
                    </li>
                    @endcan

                    @can('loan-request')
                    <li class="submenuu">
                        <a id="{{ request()->routeIs('loan.request.listing') ? 'activeee' : '' }}" href="{{ route('loan.request.listing') }}">
                            <i class="la la-dashboard"></i>
                            <span>Loan Request</span> 
                        </a>
                    </li>
                    @endcan

                    @can('manage-division')
                        <li class="submenuu">
                        <a id="{{ request()->routeIs('divisions.list') ? 'activeee' : '' }}" href="{{ route('divisions.list') }}">
                            <i class="fa fa-deviantart" aria-hidden="true"></i>
                            <span>Manage Division</span> 
                            </a>
                        </li>
                    @endcan

                   
                    @can('manage-travel-categories')
                        <li class="submenuu">
                        <a id="{{ request()->routeIs('travelcategories.list') ? 'activeee' : '' }}" href="{{ route('travelcategories.list') }}">                    <i class="fa fa-globe" aria-hidden="true"></i>
                        <span>Travel Alowance</span> 
                            </a>
                        </li>
                    @endcan

                    @can('employee-management')
                    <li class="submenuu">
                        <a id="{{ request()->routeIs('employees.list') ? 'activeee' : '' }}" href="{{ route('employees.list') }}">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span>Employees</span> 
                            </a>
                    </li>
                    @endcan


                

                    <li class="submenu">
                        <a href="#">
                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                        <span>Leave Manage</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('leave.index.new') ? 'active' : '' }}" href="{{route('leave.index.new')}}">Leave</a></li>        
                        <li><a class="{{ request()->routeIs('leave.balance') ? 'active' : '' }}" href="{{route('leave.balance')}}">Leave Balance</a></li>        
                        @can('annual-leaves')
                        <li><a class="{{ request()->routeIs('annualleave.list') ? 'active' : '' }}" href="{{ route('annualleave.list') }}">Annual Leaves</a></li>
                        @endcan
                    </ul>
                    </li>
                    

                    @can('system-management')
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-user"></i> <span>Manage</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('attendance.list') ? 'active' : '' }}" href="{{route('attendance.list')}}">Attendance</a></li>
                            <li><a class="{{ request()->routeIs('overtime_categories.list') || 
                            request()->routeIs('overtime_requests.list') ? 'active' : '' }}" href="{{route('overtime_categories.list')}}" href="#">Overtime</a></li>
                            <li><a class="{{ request()->routeIs('loan_types.list') || 
                            request()->routeIs('employee_loans.list') ? 'active' : '' }}" href="{{route('loan_types.list')}}">Loans</a></li>  
                            <li ><a class="{{ request()->routeIs('role.listing') ? 'active' : '' }}" href="{{ route( 'role.listing') }}">Role</a></li>                  
                        </ul>
                    </li>
                    @endcan

                  
                    <li class="submenu">
                        <a href="#">
                        <i class="fa fa-plane" aria-hidden="true"></i>
                        <span>Travel Management</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('travel_records.list') || 
                            request()->routeIs('subordinate_travel_requests.list')
                             ? 'active' : '' }}" href="{{route('travel_records.list')}}"> Travel </a>
                        </li>  


                        @can('travel-category')
                        <li><a class="{{ request()->routeIs('categories.list') ? 'active' : '' }}" href="{{ route('categories.list') }}">Travel Categories</a></li>
                        @endcan
                        </ul>
                    </li>


                    <li class="submenuu">
                        <a id="{{ request()->routeIs('people.everyone') ? 'activeee' : '' }}" href="{{route('people.everyone')}}">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            <span>People</span> 
                        </a>
                    </li>

                
                    <li class="submenu"> <a href="#"><i class="la la-tachometer" aria-hidden="true"></i>
                        <span> Performance </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">

                            <!-- <li><a class="{{ request()->routeIs('goal.tracking.list') ? 'active' : '' }}" href="{{route('goal.tracking.list')}}">Goal Tracking</a></li> -->

                            <li><a class="{{ request()->routeIs('indicator.list') ? 'active' : '' }}" href="{{route('indicator.list')}}">Indicator</a></li>

                            <li><a class="{{ request()->routeIs('appraisal.list') ? 'active' : '' }}" href="{{route('appraisal.list')}}">Appraisal</a></li>
                            
                        <li><a class="{{ request()->routeIs('indicator.form') ? 'active' : '' }}" href="{{route('indicator.form')}}">KPI forms</a></li>
                        </ul>
                    </li>


                    <!-- @if (Auth::user()->role_name=='Admin')
                        <li class="menu-title"> <span>Authentication</span> </li>
                        <li class="submenu">
                            <a href="#">
                                <i class="la la-user-secret"></i> <span> User Controller</span> <span class="menu-arrow"></span>
                            </a>
                            <ul style="display: none;">
                                <li><a href="{{ route('userManagement') }}">All User</a></li>
                                <li><a href="{{ route('activity/log') }}">Activity Log</a></li>
                                <li><a href="{{ route('activity/login/logout') }}">Activity User</a></li>
                            </ul>
                        </li>
                    @endif -->

                    @can('system-management')
                    <li class="submenu"> <a href="#"><i class="la la-cogs"></i>
                        <span> System </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->routeIs('countries.list') || 
                            request()->routeIs('provinces.list') || 
                            request()->routeIs('currency_types.list') || 
                            request()->routeIs('nationalities.list') ||  
                            request()->routeIs('immigration_status.list') 
                             ? 'active' : '' }}" href="{{route('countries.list')}}"> Manage Metadata </a></li>
                        </ul>
                    </li> 
                    @endcan

                    @can('holiday-manage')
                        <li class="submenuu">
                        <a id="{{ request()->routeIs('holiday.index') ? 'activeee' : '' }}" href="{{ route('holiday.index') }}">
                            <i class="la la-user"></i>
                            <span>Holidays</span> 
                        </a>
                        </li>
                    @endcan


        
                    <li class="submenu"> <a href="#"><i class="fa fa-money" aria-hidden="true"></i>

                        <span> Salary </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                        @can('payroll-manage')
                            <li><a class="{{ request()->routeIs('payroll.list') ? 'active' : '' }}" href="{{route('payroll.list')}}">Manage Payroll</a></li>
                        @endcan    
                            <li><a class="{{ request()->routeIs('individual.payroll.information') ? 'active' : '' }}" href="{{route('individual.payroll.information')}}">Your Payslip</a></li>
                       

                        </ul>
                    </li> 
                    

                    @can('user-report')
                    <li class="submenu"> <a href="#"><i class="fa fa-files-o" aria-hidden="true"></i>

                        <span> User Report </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->routeIs('userReports.list') ? 'active' : '' }}" href="{{route('userReports.list')}}"> Report </a></li>
                        </ul>
                    </li>
                    @endcan


                    
                    <li class="submenuu">
                        <a id="{{ request()->routeIs('manage.event') ? 'activeee' : '' }}" href="{{route('manage.event')}}">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span>Event</span> 
                        </a>
                    </li>


                    <li class="submenu">
                            <a href="#">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span>Training</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul style="display: none;">
                                <li>
                                    <a class="{{ request()->routeIs('trainer.index') ? 'active' : '' }}"
                                        href="{{ route('trainer.index') }}">
                                        Trainer
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('traininglist.index') ? 'active' : '' }}"
                                        href="{{ route('traininglist.index') }}">
                                        Training List
                                    </a>
                                </li>
                            </ul>
                    </li>

                    <li class="submenuu">
                        <a  href="{{route('employee-training')}}">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span>Training</span> 
                        </a>
                    </li>

                    @canany('contract-manage')
                    <li class="submenuu">
                        <a id="{{ request()->routeIs('contracts.index') ? 'activeee' : '' }}" href="{{ route('contracts.index') }}"> 
                        <i class="fa fa-file" aria-hidden="true"></i>
                            <span>Contracts</span> 
                        </a>
                    </li>
                    @endcan


                    
                    @canany('timesheet-manage')
                    <li class="submenu"> <a href="#"><i class="fa fa-calendar-o" aria-hidden="true"></i>

                        <span>Timesheet </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->routeIs('manage.timesheet') ? 'active' : '' }}" href="{{route('manage.timesheet')}}">Monthly Timesheet</a></li>
                        </ul>
                    </li>
                    @endcan

                    @canany('user-helpdesk')
                    <li class="submenu"> <a href="#"><i class="fa fa-files-o" aria-hidden="true"></i>
                        <span> Help Desk </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a class="{{ request()->routeIs('active.help_request') ? 'active' : '' }}" href="{{route('active.help_request')}}"> Help Requests </a></li>
                        </ul>
                    </li>
                    @endcan


                    @canany(['policy-manage', 'view-policies'])

                    <li class="submenu">
                    <a href="#">
                      <i class="fa fa-folder-open" aria-hidden="true"></i>
                         <span> Document Center </span>
                           <span class="menu-arrow"></span>
                             </a>
                        <ul style="display: none;">
                            @can( 'view-policies')
                            <li>
                                <a class="{{ request()->routeIs('Document.index') ? 'active' : '' }}" href="{{ route('Document.index') }}">
                                    Documents
                                </a>
                                </li>
                            @endcan  
                            @can( 'policy-manage')

                                <li>
                                    <a class="{{ request()->routeIs('policies.index') ? 'active' : '' }}" href="{{ route('policies.index') }}">
                                    Policies
                                </a>
                                </li>
                            @endcan 
                        </ul>
                    </li>
                    @endcan

                    @canany('asset-manage')
                        <li class="submenu">
                            <a href="#">
                            <i class="fa fa-laptop" aria-hidden="true"></i>
                                <span> Assets </span>
                                <span class="menu-arrow"></span>
                                    </a>
                                <ul style="display: none;">
                                <li>
                                    <a class="{{ request()->routeIs('assettypes.index') ? 'active' : '' }}" href="{{ route('assettypes.index') }}">
                                        Asset Types
                                    </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('asset.index') ? 'active' : '' }}" href="{{ route('asset.index') }}">
                                            Assets
                                    </a>
                                    </li>
                                </ul>
                        </li>
                    @endcan 


              
                    <li class="submenuu">
                        <a id="{{ request()->routeIs('engage.index') ? 'activeee' : '' }}" href="{{ route('engage.index') }}"> 
                        <i class="fa fa-signal"aria-hidden="true"></i>
                            <span>Engage</span> 
                        </a>
                    </li>

                    <li class="submenu">
                        <a href="#">
                            <i class="fa fa-exchange" aria-hidden="true"></i>
                            <span> Reimbursement </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                        <li>
                            <a class="{{ request()->routeIs('reimburs.index') ? 'active' : '' }}"
                                href="{{ route('reimburs.index') }}">
                                Reimburs Form
                            </a>
                        </li>
                         <li>
                            <a class="{{ request()->routeIs('reimburs.details') ? 'active' : '' }}"
                                href="{{ route('reimburs.details') }}">
                                Reimburs Details
                            </a>
                        </li>
                        </ul>
                    </li>


                    <!-- <li class="submenu">
                     <a href="#">
                       <i class="fa fa-calendar" aria-hidden="true"></i>
                          <span> Attendance </span>
                            <span class="menu-arrow"></span>
                              </a>
                         <ul style="display: none;">
                            <li>
                                <a class="{{ request()->routeIs('attendances.index') ? 'active' : '' }}" href="{{ route('attendances.index') }}">
                                 Attendance
                               </a>
                             </li>
                         <li>
                        <a class="{{ request()->routeIs('attendances.details') ? 'active' : '' }}" href="{{ route('attendances.details') }}">
                         Attendance Details
                          </a>
                          </li>
                        <li>
                        <a class="{{ request()->routeIs('attendances.summary') ? 'active' : '' }}" href="{{ route('attendances.summary') }}">
                         Attendance Summary
                       </a>
                     </li>
                   </ul>
                  </li>
                    
                    <!-- <li class="menu-title"> <span>HR</span> </li>
                    <li class="submenu">
                        <a href="#">
                            <i class="la la-files-o"></i>
                            <span> Sales </span> 
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/invoice/view/page') }}">Invoices</a></li>
                          
                        </ul>
                    </li> -->
                    <!-- <li class="submenu"> <a href="#"><i class="la la-money"></i>
                        <span> Payroll </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/salary/page') }}"> Employee Salary </a></li>
                            <li><a href="{{ url('form/salary/view') }}"> Payslip </a></li>
                            <li><a href="{{ route('form/payroll/items') }}"> Payroll Items </a></li>
                        </ul>
                    </li>
                    <li class="submenu"> <a href="#"><i class="la la-pie-chart"></i>
                        <span> Reports </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/expense/reports/page') }}"> Expense Report </a></li>
                            <li><a href="{{ route('form/invoice/reports/page') }}"> Invoice Report </a></li>
                            <li><a href="payments-reports.html"> Payments Report </a></li>
                            <li><a href="employee-reports.html"> Employee Report </a></li>
                            <li><a href="payslip-reports.html"> Payslip Report </a></li>
                            <li><a href="attendance-reports.html"> Attendance Report </a></li>
                            <li><a href="{{ route('form/leave/reports/page') }}"> Leave Report </a></li>
                            <li><a href="{{ route('form/daily/reports/page') }}"> Daily Report </a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="menu-title"> <span>Performance</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-graduation-cap"></i>
                        <span> Performance </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/performance/indicator/page') }}"> Performance Indicator </a></li>
                            <li><a href="{{ route('form/performance/page') }}"> Performance Review </a></li>
                            <li><a href="{{ route('form/performance/appraisal/page') }}"> Performance Appraisal </a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="submenu"> <a href="#"><i class="la la-edit"></i>
                        <span> Training </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('form/training/list/page') }}"> Training List </a></li>
                            <li><a href="{{ route('form/trainers/list/page') }}"> Trainers</a></li>
                            <li><a href="{{ route('form/training/type/list/page') }}"> Training Type </a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="menu-title"> <span>Administration</span> </li>
                    <li> <a href="assets.html"><i class="la la-object-ungroup">
                        </i> <span>Assets</span></a>
                    </li> -->
                    <!-- <li class="submenu"> <a href="#"><i class="la la-briefcase"></i>
                        <span> Jobs </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="user-dashboard.html"> User Dasboard </a></li>
                            <li><a href="jobs-dashboard.html"> Jobs Dasboard </a></li>
                            <li><a href="jobs.html"> Manage Jobs </a></li>
                            <li><a href="manage-resumes.html"> Manage Resumes </a></li>
                            <li><a href="shortlist-candidates.html"> Shortlist Candidates </a></li>
                            <li><a href="interview-questions.html"> Interview Questions </a></li>
                            <li><a href="offer_approvals.html"> Offer Approvals </a></li>
                            <li><a href="experiance-level.html"> Experience Level </a></li>
                            <li><a href="candidates.html"> Candidates List </a></li>
                            <li><a href="schedule-timing.html"> Schedule timing </a></li>
                            <li><a href="apptitude-result.html"> Aptitude Results </a></li>
                        </ul>
                    </li>
                    <li class="menu-title"> <span>Pages</span> </li>
                    <li class="submenu"> <a href="#"><i class="la la-user"></i>
                        <span> Profile </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="profile.html"> Employee Profile </a></li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
	<!-- /Sidebar -->     
     <script>


            document.addEventListener('DOMContentLoaded', function() {
                // Function to scroll to active menu item
                function scrollToActiveMenuItem() {
                    // Find active menu items
                    const activeItems = document.querySelectorAll('#sidebar-menu a.active, #sidebar-menu a#activeee');
                    
                    if (activeItems.length > 0) {
                        // Get the last active item (in case there are multiple)
                        const activeItem = activeItems[activeItems.length - 1];
                        
                        // Check if this active item is inside a submenu
                        const parentSubmenu = activeItem.closest('.submenu');
                        
                        // If it's in a submenu, make sure the submenu is expanded
                        if (parentSubmenu) {
                            const submenuUl = parentSubmenu.querySelector('ul');
                            if (submenuUl && submenuUl.style.display === 'none') {
                                submenuUl.style.display = 'block';
                            }
                        }
                        
                        // Scroll the sidebar to bring the active item into view
                        setTimeout(() => {
                            activeItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }, 200);
                    }
                }
                
                // Run when page loads
                scrollToActiveMenuItem();
                
                // Also run when any sidebar link is clicked
                const sidebarLinks = document.querySelectorAll('#sidebar-menu a');
                sidebarLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        // Give a small delay to allow for any route changes or DOM updates
                        setTimeout(scrollToActiveMenuItem, 300);
                    });
                });
            });



     </script>