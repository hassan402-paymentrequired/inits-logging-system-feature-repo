<div>
welcome to dash {{ auth()->user()->name }}

<form action="/logout" method="post">
@csrf
<button>logout</button>
</form>

<form action="/v1/dashboard/create" method="post">
@csrf
<input type="text" name="name">
@error('name')
    <p>{{ $message }}</p>
@enderror
<input type="text" name="phone_number">
@error('phone_number')
    <p>{{ $message }}</p>
@enderror
<input type="text" name="staff">
@error('staff')
    <p>{{ $message }}</p>
@enderror
<input type="text" name="purpose_of_visit">
@error('purpose_of_visit')
    <p>{{ $message }}</p>
@enderror
<input type="text" name="admin_id" value="{{ auth()->user()->id }}">
<button>create visitor</button>

</form>
</div>