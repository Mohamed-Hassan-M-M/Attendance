<div class="row d-flex flex-column">
    <div class="form-group d-flex flex-row col-md-8 m-auto">
        <label for="user_name" class="col-md-4 p-2">{{__('messages.Username')}}</label>
        <p class="form-control col-md-8 text-center text-truncate" id="user_name" name="user_name">{{auth()->user()->name}}</p>
    </div>
    <div class="form-group d-flex flex-row col-md-8 m-auto">
        <label for="email" class="col-md-4 p-2">{{__('messages.Email')}}</label>
        <p class="form-control col-md-8 text-center text-truncate" id="email" name="email">{{auth()->user()->email}}</p>
    </div>
</div>
