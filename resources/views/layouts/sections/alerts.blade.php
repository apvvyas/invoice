
@if(empty($no_check_complete_alert) && !$complete_profile && (request()->route()->getName() != 'user.profile'))
    @component('layouts.alerts.warning-gradient')
    <div class="clearfix v-middle">
        <span class="pull-left pt-2">
        <strong>Hello !</strong>
        Please complete your profile to access all the basic features of kento.
        </span>
        <a href="{{route('user.profile')}}?step=2" class="btn btn-secondary pull-right">
        	Edit profile
    	</a>
	</div>
    @endcomponent
@endif


@if($errors->any())

@component('layouts.alerts.warning-gradient')
    {{$errors->first()}}
@endcomponent

@endif