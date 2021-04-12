<form class="form" id="updateform" action="{{route('admin.profile.doEditProfile')}}" method="POST">
    @csrf
    <div class="d-flex flex-column">
        <div class="form-group d-flex flex-row col-md-8 m-auto">
            <label for="user_name" class="col-md-4 p-2">{{__('messages.Username')}}</label>
            <div class="col-md-8 p-0">
                <input type="text" class="form-control text-center" value="{{auth()->user()->name}}" id="user_name" name="user_name">
                <span class="invalid-feedback d-block font-weight-bold" id="user_name_error" style="display:none" role="alert"></span>
            </div>
        </div>
        <div class="form-group d-flex flex-row col-md-8 m-auto">
            <label for="email" class="col-md-4 p-2">{{__('messages.Email')}}</label>
            <div class="col-md-8 p-0">
                <input type="email" class="form-control text-center" value="{{auth()->user()->email}}" id="email" name="email">
                <span class="invalid-feedback d-block font-weight-bold" id="email_error" style="display: none" role="alert"></span>
            </div>
        </div>
    </div>
    <div class="form-group col-md-8 m-auto pt-3 pl-3">
        <button type="submit" id="updateProfile" class="btn b btn-primary col-md-3">{{__('messages.Update')}}</button>
    </div>
</form>
