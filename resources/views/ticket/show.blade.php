<x-app-layout>
    <div class="d-flex justify-content-center">
        <div class="col-md-5 border-3 rounded-3 p-4 pb-1 m-4">
            <h1 class="h2 text-center mb-3">{{ $ticket->title }}</h1>
            <div class="d-flex justify-content-between">
                <div class="col-sm-6 p-1">
                    <p class="h6">{{ $ticket->description }}</p>
                </div>
                <div class="col-sm-3 p-1">
                    <p>{{ $ticket->created_at->diffForHumans() }}</p>
                </div>
                <div class="col-sm-3">
                    {{-- @if ($ticket->attachments->isNotEmpty())
                        @foreach ($ticket->attachments as $attachment)
                            @if (file_exists(public_path($attachment->file_path)))
                                <a href="{{ asset($attachment->file_path) }}" target="_blank">
                                    View Attachment: {{ $attachment->file_name }}
                                </a><br>
                            @endif
                        @endforeach
                    @else
                        <p>No attachments found for this ticket.</p>
                    @endif --}}
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <div class="d-flex mt-2">
                    <a class="me-1" href="{{ route('ticket.edit', $ticket->id) }}">
                        <x-primary-button>Edit</x-primary-button>
                    </a>

                    <form action="{{ route('ticket.destroy', $ticket->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <x-primary-button>Delete</x-primary-button>
                    </form>
                </div>

                @if (auth()->user()->isAdmin)
                    <div class="d-flex mt-2">
                        <form class="me-1" action="{{ route('ticket.update', $ticket->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <input type="hidden" id="status" name="status" value="approved" />
                            <x-primary-button>Approve</x-primary-button>
                        </form>
                        <form class="me-1" action="{{ route('ticket.update', $ticket->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <input type="hidden" id="status" name="status" value="rejected" />
                            <x-primary-button>Reject</x-primary-button>
                        </form>
                    </div>
                @else
                    <p class="lead mt-2">Status: {{ $ticket->status }}</p>
                @endif
            </div>

            {{-- @if (auth()->user()->isAdmin || auth()->user()->id === $ticket->user_id)
                <div class="mt-5">
                    <h3 class="h3 text-center mb-4">Replies</h3>
                    <ul class="replies">
                        @foreach ($ticket->replies as $reply)
                            @if ($reply->user_id === auth()->user()->id)
                                <div class="clearfix d-flex justify-content-end w-100">
                                    <div class="d-flex text-white bg-success mx-4 my-2 p-2 rounded-lg inline-block"
                                        style="max-width: 70%;">
                                        <p class="lead"><b class="me-2">{{ $reply->message }}</b> - <em
                                                class="fs-6">{{ $reply->user->name }}</em></p>
                                    </div>
                                </div>
                            @else
                                <div class="bg-light mx-4 my-2 p-2 rounded-lg"
                                    style="max-width: 70%; width: fit-content; word-wrap: break-word; display: inline-flex;">
                                    <p class="lead mb-0">
                                        <em class="fs-6 me-3">{{ $reply->user->name }} - </em>
                                        {{ $reply->message }}
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    </ul>
                    <form class="mt-2" action="{{ route('replies.store', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between align-items-center p-2">
                            <textarea class="form-control m-2" rows="2" name="message" id="message" placeholder="Message..."></textarea>
                            <button class="m-2" type="submit" style="outline: none;">
                                <svg class="svg-inline--fa text-green-400 fa-paper-plane fa-w-16 w-12 h-12 py-2 mr-2"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                        d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            @endif --}}
        </div>
    </div>
</x-app-layout>