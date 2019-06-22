<ul class="list-group w-100 widget-scroll" style="max-height: 250px; overflow: hidden; outline: currentcolor none medium;" tabindex="2">
	@forelse ($recipients as $user)
    <li class="list-group-item">
        <div class="media">
            <!-- <div class="media-left align-self-center mr-3">
                <img src="assets/img/avatar/avatar-02.jpg" alt="..." class="img-fluid rounded-circle" style="width: 35px;">
            </div> -->
            <div class="media-body align-self-center">
                <div class="people-name">{{$user->company_name}}</div>
            </div>
            <div class="media-right align-self-center set_recipient">
                <div class="checkbox check" id="{{$user->id}}"></div>
                <input type="radio" class="d-none" id="check_{{$user->id}}" name="recipient_id" value="{{$user->id}}">
            </div>
        </div>
    </li>
    @empty
    <li class="list-group-item">
        <div class="media">
            <div class="media-body align-self-center">
                <div class="people-name">No recipient found</div>
            </div>
        </div>
    </li>
    @endforelse
</ul>