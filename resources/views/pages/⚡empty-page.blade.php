<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard')] class extends Component {
    //
};
?>

@section('page-header')
    <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">Empty page</h2>
        </div>
    </div>
@endsection

<div>
    {{-- ... --}}
</div>
