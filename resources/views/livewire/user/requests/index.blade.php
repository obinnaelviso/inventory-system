<div>
    @if ($step == RequestStep::LIST_REQUESTS)
        <livewire:user.requests.list-requests />
    @elseif ($step == RequestStep::LIST_REQUEST_ITEMS && $r)
        <livewire:user.requests.list-request-items :request="$r" :units="$units" />
    @endif
</div>
