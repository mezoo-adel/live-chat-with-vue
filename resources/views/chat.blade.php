 <!-- resources/views/chat.blade.php -->
 @extends('layouts.app')
 @section('content')
     <div class="container">
         <chat-form v-if="{{ Auth::user() }}" :user="{{ Auth::user() }}"></chat-form>
     </div>
 @endsection
