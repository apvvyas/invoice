@forelse($todos as $todo)
<div class="messenger-message messenger-message-sender" data-todo-entry ="{{$todo->id}}">
    <div class="messenger-message-wrapper">
        <div class="messenger-message-content">
            <p>
                @if($todo->status == 1)
                <strong>
                    <del>{!! $todo->message !!}</del>
                </strong>
                @else
                <strong>
                    {!! $todo->message !!}
                </strong>
                <a href="#" class="text-primary ml-5 checkoff"><i class="la la-check la-1-5x"></i></a>
                @endif
                <a class="text-danger ml-2 delete"><i class="la la-trash la-1-5x"></i></a>
            </p>
        </div>
    </div>
</div>
@empty
<div class="messenger-message messenger-message-sender">
    <div class="messenger-message-wrapper">
        <div class="messenger-message-content">
            <p>
               <strong> No todos Available</strong>
            </p>
        </div>
    </div>
</div>
@endforelse