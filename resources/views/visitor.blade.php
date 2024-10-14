{{-- {{ dd($visitor) }} --}}
<form action="/v1/admin/visitors/check-out/{{ $visitor->id }}" method="post">
    @csrf
    @method('PATCH')
    <input type="text" name="name" value="{{ $visitor->name }}">
    @error('name')
        <p>{{ $message }}</p>
    @enderror
    <input type="text" name="phone_number" value="{{ $visitor->phone_number }}">
    @error('phone_number')
        <p>{{ $message }}</p>
    @enderror
    <input type="text" name="staff" value="{{ $visitor->user->email }}">
    <input type="hidden" name="staff_id" value="{{ $visitor->user->id }}">
    @error('staff')
        <p>{{ $message }}</p>
    @enderror
    <input type="text" name="purpose_of_visit" value="{{ $visitor->purpose_of_visit }}">
    @error('purpose_of_visit')
        <p>{{ $message }}</p>
    @enderror
    <button>create visitor</button>
    
    </form>

    <form action="/v1/admin/visitors/check-out/{{ $visitor->id }}" method="post">
    @csrf
    @method('PATCH')
    <button type="submit">check out</button>

</form>

<div>
    <p> name: {{ $visitor->name }}</p>
    <p> purpose: {{ $visitor->purpose_of_visit }}</p>
    <p>check in: {{ $visitor->visitorhistories[0]->check_in_time }}</p>
    <p> check out: {{ $visitor->visitorhistories[0]->check_out_time == 'null' ? 'still in the office': $visitor->visitorhistories[0]->check_out_time }} </p>
    <p>staff: {{ $visitor->user->name }}</p>
    <p>Tel: {{ $visitor->phone_number }}</p>
</div>