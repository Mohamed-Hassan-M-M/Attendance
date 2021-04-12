<form class="form" id="passwordform" action="{{route('admin.profile.password.reset')}}" method="POST">
    @csrf
    <div class="row d-flex">
        <div class="form-group d-flex flex-row col-md-8 m-auto">
            <label for="old_password" class="col-md-5 p-2">{{__('messages.Old Password')}}</label>
            <div class="col-md-7 p-0">
                <input type="password" class="form-control text-center" id="old_password" name="old_password" required>
                <span class="invalid-feedback d-block font-weight-bold" id="old_password_error" style="display:none" role="alert"></span>
            </div>
        </div>
        <div class="form-group d-flex flex-row col-md-8 m-auto">
            <label for="new_password" class="col-md-5 p-2">{{__('messages.New Password')}}</label>
            <div class="col-md-7 p-0">
                <input type="password" class="form-control text-center" id="new_password" name="password" required>
                <span class="invalid-feedback d-block font-weight-bold" id="password_error" style="display:none" role="alert"></span>
            </div>
        </div>
        <div class="form-group d-flex flex-row col-md-8 m-auto">
            <label for="password_confirmation" class="col-md-5 p-2">{{__('messages.Password Confirmation')}}</label>
            <input type="password" class="form-control col-md-7 text-center" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="form-group col-md-8 m-auto pt-3 pl-3">
            <button id="updatePassword" type="submit" class="btn b btn-primary col-md-3">{{__('messages.Change')}}</button>
        </div>
    </div>
</form>
