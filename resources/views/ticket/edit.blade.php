<x-app-layout>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-md-5">
                <form class="border border-3 rounded-3 p-4" action="{{ route('ticket.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                    <h1 class="h2 text-center mb-4">Update Ticket</h1>
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" value="{{ $ticket->title }}" class="form-control rounded-2 border-1" id="title" name="title">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control rounded-2" cols="30" rows="3" id="description" name="description">{{ $ticket->description }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        @if ($ticket->attachments && file_exists(public_path($ticket->attachments)))
                            <a class="border rounded-3 p-1" href="{{ asset($ticket->attachments) }}" target="_blank">View Attachment<br></a>
                        @endif
                        <label for="file" class="form-label">Attachment(if any)</label>
                        <input type="file" class="form-control border border-1 rounded-2 p-2 bg-white" name="attachment" id="attachment">
                        <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <x-primary-button>Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>