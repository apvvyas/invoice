@foreach($todos as $todo)
<div class="messenger-message messenger-message-sender">
    <div class="messenger-message-wrapper">
        <div class="messenger-message-content">
            <p>
                {!! $todo->message !!}
            </p>
        </div>
    </div>
</div>