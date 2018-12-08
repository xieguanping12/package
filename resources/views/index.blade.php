@if($users)
    @foreach($users as $user)
        <p>id: {{ $user['id'] }} name: {{ $user['name'] }} email: {{ $user['email'] }}</p>
    @endforeach
@endif