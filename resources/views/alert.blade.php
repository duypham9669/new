@if(session('alert'))
    <script>
        window.onload = function(){
            alert('{{session('alert')}}');
        };
    </script>
@endif