@extends('layouts/contentLayoutMaster')

@section('title', 'Profile')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<div id="user-profile">
  <!-- profile info section -->
  <section id="profile-info">
    <div class="row">
      <!-- left profile info section -->
      <div class="col-lg-3 col-12 order-2 order-lg-1">
        <!-- about -->
        <div class="card">
          <div class="card-body">
            <h5 class="mb-75">Rank</h5>
            <p class="card-text">
              {{ auth()->user()->rank ?? 'N/A' }}
            </p>
            <div class="mt-2">
              <h5 class="mb-75">Joined:</h5>
              <p class="card-text">{{ auth()->user()->created_at->format('M d Y') }}</p>
            </div>
            <div class="mt-2">
              <h5 class="mb-75">Lives:</h5>
              <p class="card-text">{{ auth()->user()->address ?? 'N/A' }}</p>
            </div>
            <div class="mt-2">
              <h5 class="mb-75">Email:</h5>
              <p class="card-text">{{ auth()->user()->email }}</p>
            </div>
            <div class="mt-2">
              <h5 class="mb-50">Qualification:</h5>
              <p class="card-text mb-0">{{ auth()->user()->qualification ?? 'N/A' }}</p>
            </div>
          </div>
        </div>
        <!--/ about -->
      </div>
      <!--/ left profile info section -->

      <!-- center profile info section -->
      <div class="col-lg-9 col-12 order-1 order-lg-2">
        <!-- post 1 -->
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-start align-items-center mb-1">
              <!-- avatar -->
              <div class="avatar mr-1">
                <img
                  src="{{asset('images/profile/user-uploads/'.auth()->user()->profile)}}"
                  alt="avatar img"
                  height="50"
                  width="50"
                />
              </div>
              <!--/ avatar -->
              <div class="profile-user-info">
                <h6 class="mb-0">{{auth()->user()->first_name.' '.auth()->user()->last_name}}</h6>
                <small class="text-muted">{{ auth()->user()->created_at->format('d M Y') .' at '.auth()->user()->created_at->format('h:m A') }}</small>
              </div>
            </div>
            <p class="card-text"></p>
            <form id="update-profile" action="{{ route('update-profile') }}" method="post">
              @csrf
               <div class="row">
                 <div class="col-md-12">
                   <div class="row">
                     <div class="col-md-4">
                       <div class="form-group">
                         <label>First name</label>
                         <input type="text" class="form-control" readonly name="first_name" id="first_name" value="{{ auth()->user()->first_name }}">
                       </div>
                     </div>
                     <div class="col-md-4">
                       <div class="form-group">
                         <label>Other name</label>
                         <input type="text" class="form-control" name="other_name" id="other_name" value="{{ auth()->user()->other_name }}">
                       </div>
                     </div>
                     <div class="col-md-4">
                       <div class="form-group">
                         <label>Last name</label>
                         <input type="text" class="form-control" readonly name="last_name" id="last_name" value="{{ auth()->user()->last_name }}">
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Profile Picture</label>
                    <input type="file" class="form-control-file" name="profile" id="profile">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>E-mail</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" autocomplete="false">
                  </div>
                  <p class="text-danger">Keep password field empty if you don't want to change your password</p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" autocomplete="false">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
          </div>
        </div>
        <!--/ post 1 -->
      </div>
      <!--/ center profile info section -->
    </div>
  </section>
  <!--/ profile info section -->
</div>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/page-profile.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>
  <script>
    $(document).ready(function () {
      let update_profile = $('#update-profile')
      update_profile.submit(function (e) {
        e.preventDefault()
        $.ajax({
          url: update_profile.attr('action'),
          type: 'post',
          contentType: false,
          cache: false,
          processData: false,
          data: new FormData(this),
          success: function (res) {
            if (res.status === 'fail') {
              let msg
              $.each(res.error, function (a, b) {
                msg = b
                message('error', msg)
              })
            } else {
              message('success', res.message)
            }
          }
        })
      })
    })
  </script>
@endsection