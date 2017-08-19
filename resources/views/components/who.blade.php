@if (Auth::guard('web')->check())
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            Logged In Component
          </div>
          <div class="panel-body">
            <p class="text-success">
              You are logged in as a <strong>USER</strong>.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif


@if (Auth::guard('admin')->check())
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            Logged In Component
          </div>
          <div class="panel-body">
            <p class="text-success">
              You are logged in as a <strong>ADMIN</strong>.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
