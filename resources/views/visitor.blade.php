{{ dd( $visitor) }}
<form action="/admin/visitors/update/{{ $visitor->id }}" method="post">
    @csrf
    <input type="text" name="name" value="{{ $visitor->name }}">
    @error('name')
        <p>{{ $message }}</p>
    @enderror
    <input type="text" name="phone_number" value="{{ $visitor->phone_number }}">
    @error('phone_number')
        <p>{{ $message }}</p>
    @enderror
    <input type="text" name="staff" value="{{ $visitor->user->name }}">
    @error('staff')
        <p>{{ $message }}</p>
    @enderror
    <input type="text" name="purpose_of_visit" value="{{ $visitor->purpose_of_visit }}">
    @error('purpose_of_visit')
        <p>{{ $message }}</p>
    @enderror
    <button>create visitor</button>
    
    </form>