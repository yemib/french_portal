<div class="left-side-menu left-side-menu-dark">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                
                
                @switch(auth()->user()->account_type)
                    @case("super_admin")
                       
                        <li>
                            <a href="{{ route("dashboard") }}">
                                <i class="mdi mdi-view-dashboard text-success"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route("admin.applications.index") }}">
                                <i class="mdi mdi-arrow-expand text-warning"></i> <span>Applications</span>
                            </a>
                        </li>
                        
                        
                        
                        <!---
                        <li>
                            <a href="{{ route("admin.hostel.index") }}">
                                <i class="mdi mdi-home text-primary"></i> <span>Hostels</span>
                            </a>
                        </li>
                        
                        ---->
                        
                        
                        
                        <li>
                            <a href="{{ route("admin.school.index") }}">
                                <i class="mdi mdi-home text-info"></i> <span>Schools</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("admin.program.index") }}">
                                <i class="mdi mdi-chart-bar text-info"></i> <span>Programs</span>
                            </a>
                        </li>
                        
                        <?php 
                        /*
                        <li>
                            <a href="{{ route("admin.department.index") }}">
                                <i class="mdi mdi-bandcamp text-white"></i> <span>Departments</span>
                            </a>
                        </li>  */
                        
							?>
                         
                        
                        <li>
                            <a href="{{ route("admin.course.index") }}">
                                <i class="mdi mdi-book-multiple text-success"></i> <span>Courses</span>
                            </a>
                        </li>
                        
                        
                          <li>
                         
                           
                              <a   href="/upload_result">  <i class="mdi mdi-account-multiple text-info"></i>   <span>Upload Result  </span>   </a>
                               
                               
                          </li>
                            
                             <li>
                         
                           
                              <a   href="/result_list_form">  <i class="mdi mdi-account-multiple text-info"></i>   <span>Result List  </span>   </a>
                               
                               
                          </li>
                        
                        
                        
                        
                       
                        <?php
                       /*
                        
                        <li>
                            <a href="javascript: void();">
                                <i class="mdi mdi-library-books text-info"></i> <span>Results</span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                @foreach (\App\Http\Models\Department::all() as $department)
                                    <li>
                                        <a href="{{ route('admin.results', ['department_id' => $department->id]) }}">{{ ucwords($department->title) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                       
								*/			?>
                          
                            
                              <li>
                            <a href="{{ route("admin.lecturer.index") }}">
                                <i class="mdi mdi-account-switch text-primary"></i> <span>Result Uploaders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("admin.student.index") }}">
                                <i class="mdi mdi-account-group text-info"></i> <span>Students</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("admin.supervisor.index") }}">
                                <i class="mdi mdi-account-multiple-outline text-white"></i> <span>Supervisors</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("admin.bursar.index") }}">
                                <i class="mdi mdi-account-multiple-outline text-warning"></i> <span>Bursary</span>
                            </a>
                        </li>
                        <li class="d-none">
                            <a href="{{ route("admin.voucher.index") }}">
                                <i class="mdi mdi-barcode text-white"></i> <span>Vouchers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("admin.payment.index") }}">
                                <i class="mdi mdi-paypal text-white"></i> <span>Payments</span>
                            </a>
                        </li>    
                           
                           <li>
                            <a href="{{ route("admin.payment.register") }}">
                                <i class="mdi mdi-paypal text-white"></i> <span>Register</span>
                            </a>
                        </li>
                        <li class="d-none">
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-atom"></i> <span>UI Elements </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li>
                                    <a href="ui-buttons.html">Buttons</a>
                                </li>
                            </ul>
                        </li>
                    @break
                    @case("student")
                        <li>
                            <a href="{{ route("dashboard") }}">
                                <i class="mdi mdi-view-dashboard text-success"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        @for($session = 1; $session <= auth()->user()->student->current_session; $session++)
                           
                           
                            <li>
                                <a href="{{ route("student.session", ["count" => $session]) }}">
                                    <i class="mdi mdi-clipboard-text text-white"></i> <span>Level {{ $session }} Courses</span>
                                </a>
                            </li>
                            
                            
                        @endfor
                        
                        
                        <li>
                            <a href="{{ route("student.bio") }}">
                                <i class="mdi mdi-account text-success"></i> <span>Student Biodata</span>
                            </a>
                        </li>
                        
                        
                        
                    @break
                    @case("senior_lecturer")
                        <li>
                            <a href="{{ route("dashboard") }}">
                                <i class="mdi mdi-view-dashboard text-success"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        
                       
                        
                         <li>
                         
                           
                              <a   href="/upload_result">  <i class="mdi mdi-account-multiple text-info"></i>   <span>Upload Result  </span>   </a>
                               
                               
                          </li>
                            
                            
                            
                            
                            
                            
                             <li>
                         
                           
                              <a   href="/result_list_form">  <i class="mdi mdi-account-multiple text-info"></i>   <span>Result List  </span>   </a>
                               
                               
                          </li>
                        
                        
                         
                              <li>
                            <a href="{{ route("lecturer.student.index") }}">
                                <i class="mdi mdi-account-group text-info"></i> <span>Students</span>
                            </a>
                        </li>
                        
                        
                        
                    @break
                    @case("lecturer")
                        <li>
                            <a href="{{ route("dashboard") }}">
                                <i class="mdi mdi-view-dashboard text-success"></i> <span>Dashboard</span>
                            </a>
                        </li>
                    @break
                    @case("supervisor")
                        <li class="d-none">
                            <a href="{{ route("dashboard") }}">
                                <i class="mdi mdi-view-dashboard text-success"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route("supervisor.student.index") }}">
                                <i class="mdi mdi-account-multiple text-info"></i> <span>Students</span>
                            </a>
                        </li>
                        
                      
                                      <li>
                         
                           
                              <a   href="/result_list_form">  <i class="mdi mdi-account-multiple text-info"></i>   <span>Result </span>   </a>
                               
                               
                          </li>
                        
                        
                        
                    @break
                    @case("bursar")
                        <li>
                            <a href="{{ route("bursar.payments") }}">
                                <i class="mdi mdi-paypal text-white"></i> <span>Payments</span>
                            </a>re
                        </li>
                    @break
                @endswitch

                <li class="">
                    <a href="{{ route("user.manage-settings") }}">
                        <i class="mdi mdi-settings text-danger"></i> <span>Manage Settings</span>
                    </a>
                </li>
                
                
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
