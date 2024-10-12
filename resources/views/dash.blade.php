<div>
welcome to dash {{ auth()->user()->name }}

<form action="/logout" method="post">
@csrf
<button>logout</button>
</form>
</div>