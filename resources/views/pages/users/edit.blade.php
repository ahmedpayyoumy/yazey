{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Thống kê')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    @toastr_css
@endsection
{{-- Content --}}
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile Account Information-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                    @include('pages.users.card')
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <form enctype="multipart/form-data" action="{{ route('users.update', $user->id ) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="card card-custom">
                            <!--begin::Header-->
                            <div class="card-header py-3">
                                <div class="card-title align-items-start flex-column">
                                    <h3 class="card-label font-weight-bolder text-dark">Account Information</h3>
                                    <span class="text-muted font-weight-bold font-size-sm mt-1">Change account settings</span>
                                </div>
                                <div class="card-toolbar">
                                    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->
                            <div class="card-body">
                                <!--begin::Heading-->
                                <div class="row">
                                    <label class="col-xl-3"></label>
                                    <div class="col-lg-9 col-xl-6">
                                        <h5 class="font-weight-bold mb-6">Account:</h5>
                                    </div>
                                </div>
                                <!--begin::Form Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                    <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-lg form-control-solid" name="name" type="text" value="{{ $user->name }}" />
                                    </div>
                                </div>
                                <!--begin::Form Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <input type="email" class="form-control form-control-lg form-control-solid" value="{{ $user->email }}" placeholder="Email" name="email" />
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Form Group-->
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Phone Number</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <input type="text" class="form-control form-control-lg form-control-solid" value="{{ $user->phone_number }}" placeholder="Phone number" name="phone_number" />
                                        </div>
                                    </div>
                                </div>
                                   <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Marketing Type</label>
                                    <div class="col-lg-9 col-xl-6">
                                        
                                      <select class="form-control form-control-lg form-control-solid" name="marketing_type">
                                        <option value="">Select Marketing Type</option>    
                                        <option value="AGENCY" <?php if($user->marketing_type=='AGENCY'){ echo "selected";} ?>>AGENCY</option> 
                                        <option value="IN-HOUSE" <?php if($user->marketing_type=='IN-HOUSE'){ echo "selected";} ?>>IN-HOUSE
</option> 
                                        </select>
                                        
                                        
                                        
                                        
                                        </div>
                                    </div>
                              
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Is Active</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <input type="checkbox" 
                                        @if($user->is_active == 1)
                                        checked="checked"
                                        @endif
                                        name="is_active" value="1" />
                                    </div>
                                </div>
                                
                                
                                  <div class="form-group row">
                                   <label class="col-xl-3 col-lg-3 col-form-label">Permissions</label>
                                    <div class="col-lg-3 col-xl-3">
                                     <?php
                                     
                                     if($user->permission){
                                     $str = $user->permission;
                                     $check_permission=explode(",",$str);
                                     }else{
                                    $check_permission=[];
                                     }
                                     
                                      ?>
                                    <input type="checkbox" value="dashboard_roas" name="permission[]" <?php if(in_array("dashboard_roas",$check_permission)){ echo "checked"; }  ?>> Dashboard ROAS <br>
                                    <input type="checkbox" value="dashboard_sales" name="permission[]" <?php if(in_array("dashboard_sales",$check_permission)){ echo "checked"; }  ?>> Dashboard Sales <br>
                                    <input type="checkbox" value="dashboard_traffic" name="permission[]" <?php if(in_array("dashboard_traffic",$check_permission)){ echo "checked"; }  ?>> Dashboard Traffic <br>
                                    <input type="checkbox" value="dashboard_past_year_sales" name="permission[]" <?php if(in_array("dashboard_past_year_sales",$check_permission)){ echo "checked"; }  ?>> Past Year Sales <br>
                                    <input type="checkbox" value="agency_spy" name="permission[]" <?php if(in_array("agency_spy",$check_permission)){ echo "checked"; }  ?>> Agency Spy <br>
                                    <input type="checkbox" value="roas_performenance" name="permission[]" <?php if(in_array("roas_performenance",$check_permission)){ echo "checked"; }  ?>> ROAS Performenance <br>
                                    <input type="checkbox" value="industry_average" name="permission[]" <?php if(in_array("industry_average",$check_permission)){ echo "checked"; }  ?>> Industry Average <br>
                                    <input type="checkbox" value="roas_ranking_table" name="permission[]" <?php if(in_array("roas_ranking_table",$check_permission)){ echo "checked"; }  ?>> ROAS Ranking Table <br>
                                    
                                    </div>
                                   <div class="col-lg-3 col-xl-3">
                                    <input type="checkbox" value="rank_no" name="permission[]" <?php if(in_array("rank_no",$check_permission)){ echo "checked"; }  ?>> Rank No <br>
                                    <input type="checkbox" value="monthly_traffic" name="permission[]" <?php if(in_array("monthly_traffic",$check_permission)){ echo "checked"; }  ?>> Monthly Traffic <br>
                                    <input type="checkbox" value="monthly_sale" name="permission[]" <?php if(in_array("monthly_sale",$check_permission)){ echo "checked"; }  ?>> Monthly Sale <br>
                                    <input type="checkbox" value="marketing_spend" name="permission[]" <?php if(in_array("marketing_spend",$check_permission)){ echo "checked"; }  ?>> Marketing Spend <br>	
                                    <input type="checkbox" value="marketing_roas" name="permission[]" <?php if(in_array("marketing_roas",$check_permission)){ echo "checked"; }  ?>> Marketing ROAS	<br>	

                                   </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Account Information-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection
@section('scripts')
@jquery
@toastr_js
@toastr_render
<script src="{{ asset('js/pages/custom/profile/profile.js') }} "></script>
@endsection
