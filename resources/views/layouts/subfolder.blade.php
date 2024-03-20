@foreach ($folders as $subfolder)
    <li>
    <h5 class="card-title">
        <a href="{{ route('folder.getHierarchy', ['folder' => $subfolder->name]) }}">    
        {{'>>'. $subfolder->name }}</h5>
        @if ($subfolder->subfolders->count() > 0)
            <ul>
                @include('layouts.subfolder', ['folders' => $subfolder->subfolders])
            </ul>
        @endif
    </li>
@endforeach
