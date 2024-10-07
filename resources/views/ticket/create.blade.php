<x-app-layout>

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-md-5">
            <form method="POST" action="{{route('ticket.store')}}"enctype="multipart/form-data">
                @csrf
                <h1 class="text-lg font-bold" >Create new Support Ticket</h1>
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                  
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <x-textarea />
                </div>
                

                <div class="mb-3">
                  <label for="attachment" class="form-label">Attachment</label>
                  <input type="file" class="form-control" id="attachment" name="attachment">
                </div>
                
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
        </div>
    </div>
</div>

</x-app-layout>

