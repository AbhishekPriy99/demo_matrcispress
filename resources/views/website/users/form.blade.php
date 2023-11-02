@php
        $res=$response?$response->DATA:'';
    @endphp

<form action="{{!empty($res)?Route('wordpress.users.update',[$res->id,generateSecureHash($website->id)]):Route('wordpress.users.save',generateSecureHash($website->id))}}" class="maticpress-ajax-form" method="POST" data-modal-form="#maticpress-modal" reload-content="true">
    @csrf
    @if($res) 
    @method('PUT')
    @endif
   
    <div class="form-body">
        <div class="row">
            <div class="col-md-4">
                <label for="first_name">First Name</label>
            </div>
            <div class="col-md-8 form-group">
                <input type="text" id="first_name" class="form-control" name="first_name" placeholder="First Name" value="{{!empty($res->first_name)?$res->first_name:''}}">
            </div>
            <div class="col-md-4">
                <label for="last_name">Last Name</label>
            </div>
            <div class="col-md-8 form-group">
                <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last Name" value="{{!empty($res->last_name)?$res->last_name:''}}">
            </div>
            <div class="col-md-4">
                <label for="password">Password</label>
            </div>
            <div class="col-md-8 form-group">
                <input type="password" id="password" class="form-control" name="password" placeholder="password" value="">
            </div>
            @if (!empty($res))
            <div class="col-md-4">
                <label for="conf_password">Confirm Password</label>
            </div>
            <div class="col-md-8 form-group">
                <input type="password" id="conf_password" class="form-control" name="password_confirm" placeholder="confirm_password" value="">
            </div>
            @else
            <div class="col-md-4">
                <label for="conf_password">Username</label>
            </div>
            <div class="col-md-8 form-group">
                <input type="password" id="user_name" class="form-control" name="user_name" placeholder="User Name" value="">
            </div>
            <div class="col-md-4">
                <label for="user_email">User Email</label>
            </div>
            <div class="col-md-8 form-group">
                <input type="password" id="user_email" class="form-control" name="user_email" placeholder="User Email" value="">
            </div>
            @endif
            <div class="col-md-4">
                <label for="user_role">Roles</label>
            </div>
            <div class="col-md-8 form-group">
                <select class="form-select" id="user_role" name="user_role">  
                    <option value="">Select Roles</option> 
                    @foreach ($roles->DATA as $data) 
                      <option value="{{$data}}" <?php if(!empty($res) && in_array(lcfirst($data),$res->user_role)){echo "selected";}?> >{{ucfirst($data)}}</option>
                  @endforeach
                </select>
            </div> 
            <input type="hidden" name="company" value="{{!empty($website->id)?$website->id:''}}">
            <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            </div>
        </div>
    </div>
</form>