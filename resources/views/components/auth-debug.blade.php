<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    Authorization Debug Tool
                </div>

                <div class="panel-body">
                    {{-- Check if Logged In --}}
                    @if (Auth::guest() && !Auth::guard('web')->check() && !Auth::guard('admin')->check())
                        {{-- Guest --}}
                        <p class="text-danger">
                        You are not logged in.
                        </p>
                    @elseif (Auth::guard('web')->check())
                        {{-- Normal User --}}
                        <p class="text-success">
                        You are logged in as a <strong>USER</strong>.
                        </p>      
                    @elseif (Auth::guard('admin')->check())
                        {{-- Admin User --}}
                        <p class="text-success">
                        You are logged in as a <strong>ADMIN</strong>.
                        </p>
                    @endif
                </div>  <!-- /.panel-body -->

            </div>  <!-- /.panel -->
        </div>  <!-- /.col-md-8 with Offeset 2 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->



