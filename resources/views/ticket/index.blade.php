<x-app-layout>
    <div class="d-flex justify-content-center">
        <div class="col-md-6 border-3 rounded-3 p-4">
            <div class="d-flex justify-content-between">
                <div class="mx-4">
                    <h1 class="h1 text-center">Support Tickets</h1>
                </div>
                <div class="mt-2 mx-4">
                    <a href="{{ route('ticket.create') }}" class="lead border-1 rounded-3 p-1">Create Ticket</a>
                </div>
            </div>
            <div class="mt-3">
                @forelse ($tickets as $ticket)
                    @if (auth()->user()->isAdmin || auth()->user()->id === $ticket->user_id)
                        <div class="list border rounded-3 p-2 m-4">
                            <div class="d-flex justify-content-between">
                                <a class="lead" href="{{ route('ticket.show', $ticket->id) }}">{{ $ticket->title }}</a>
                                <p>{{ $ticket->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="lead">You don't have any tickets.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>