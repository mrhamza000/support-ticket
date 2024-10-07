<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets =Ticket::all();
        return view('ticket.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        if($request->file('attachment')){
            $ext =  $request->file('attachment')->extension();
            $content = file_get_contents($request->file('attachment'));
            $filename = Str::random(25);
            $path = "attachment/$filename.$ext";
            Storage::disk('public')->put("attachments/$filename.$ext ",$content);
            $ticket->update(['attachmenet'=>$path]);
        }
       
        

        return redirect()->route('ticket.index');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        // $ticket->load('attachments');
        return view('ticket.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit',compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'));
    }
}
