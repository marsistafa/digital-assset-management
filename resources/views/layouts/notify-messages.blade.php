<div>
    @forelse (session('notify_messages', collect()) as $message)
        <div class="notify-messages notify-messages-{{ $message}}" role="alert">
            {{ $message }}
        </div>
    @empty
        <p>No messages</p>
    @endforelse
</div>