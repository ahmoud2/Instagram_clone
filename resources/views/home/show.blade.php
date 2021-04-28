Iam you account
<form action="{{ url('/logout') }}" method="POST">
        @csrf
        @method('POST')
    <input type="submit" value="Logout">
</form>
